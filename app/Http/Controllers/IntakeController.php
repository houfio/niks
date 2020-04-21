<?php

namespace App\Http\Controllers;

use App\Http\Requests\IntakeRequest;
use App\Intake;
use App\Mail\IntakeAcceptedMail;
use App\Mail\IntakeMail;
use App\Mail\IntakeRejectedMail;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class IntakeController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Intake::class, 'intake');
    }

    public function index()
    {
        return view('intake.index', [
            'intakes' => Intake::with('inviter', 'invitee')->orderBy('created_at', 'desc')->orderBy('accepted')->get()
        ]);
    }

    public function create()
    {
        return view('intake.create', [
            'invitees' => User::where('is_approved', 0)->whereHas('intakes', function (Builder $query) {
                $query->where('accepted', '=', 0);
            })->get()
        ]);
    }

    public function store(IntakeRequest $request)
    {
        $data = $request->validated();

        $intake = new Intake();

        $invitee = User::find($data['invitee']);

        $intake->inviter()->associate($request->user());
        $intake->invitee()->associate($invitee);
        $intake->date = $data['date'];

        $token = Str::random(64);
        $intake->token = Hash::make($token);

        $intake->save();

        Mail::to($invitee->email)->send(new IntakeMail($intake, $token));

        $request->session()->flash('message', __('messages/intake.sent'));

        return redirect()->action('IntakeController@index');
    }

    public function show(Intake $intake)
    {
        return view('intake.show', [
            'intake' => $intake
        ]);
    }

    public function destroy(Request $request, Intake $intake)
    {
        $intake->delete();
        $request->session()->flash('message', __('messages/intake.deleted'));

        return redirect()->action('IntakeController@index');
    }

    public function accept(Request $request, Intake $intake, string $token)
    {
        $accepted = (bool)$request->query('accepted');

        if (!Hash::check($token, $intake->token)) {
            return redirect()
                ->route('home')
                ->withErrors([
                    'views/intakes.invalid_token'
                ]);
        }

        $inviter = User::find($intake->inviter_id);
        $invitee = User::find($intake->invitee_id);

        if ($accepted) {
            $intake->accepted = $accepted;
            $intake->save();

            Mail::to($inviter->email)->send(new IntakeAcceptedMail($intake, $inviter));
            Mail::to($invitee->email)->send(new IntakeAcceptedMail($intake, $invitee));
        } else {
            Mail::to($inviter->email)->send(new IntakeRejectedMail($intake, $inviter));
            Mail::to($invitee->email)->send(new IntakeRejectedMail($intake, $invitee));

            $intake->delete();
        }

        $request->session()->flash('message', $accepted ? __('messages/intake.accepted') : __('messages/intake.rejected'));

        return redirect()->route('home');
    }
}
