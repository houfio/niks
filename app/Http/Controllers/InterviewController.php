<?php

namespace App\Http\Controllers;

use App\Http\Requests\InterviewRequest;
use App\Interview;
use App\Mail\InterviewAcceptedMail;
use App\Mail\InterviewMail;
use App\Mail\InterviewRejectedMail;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class InterviewController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Interview::class, 'interview');
    }

    public function index()
    {
        return view('interview.index', [
            'interviews' => Interview::with('inviter', 'invitee')->orderBy('created_at', 'desc')->orderBy('accepted')->get()
        ]);
    }

    public function create()
    {
        $invitees = User::where('is_approved', 0)->whereDoesntHave('interviews', function (Builder $query) {
            $query->where('accepted', '=', 1);
        });

        return view('interview.create', [
            'invitees' => $invitees->get()
        ]);
    }

    public function store(InterviewRequest $request)
    {
        $data = $request->validated();

        $interview = new Interview();

        $invitee = User::find($data['invitee']);

        $interview->inviter()->associate($request->user());
        $interview->invitee()->associate($invitee);
        $interview->date = $data['date'];

        $token = Str::random(64);
        $interview->token = Hash::make($token);

        $interview->save();

        Mail::to($invitee->email)->send(new InterviewMail($interview, $token));

        $request->session()->flash('message', __('messages/interview.sent'));

        return redirect()->action('InterviewController@index');
    }

    public function show(Interview $interview)
    {
        return view('interview.show', [
            'interview' => $interview
        ]);
    }

    public function destroy(Request $request, Interview $interview)
    {
        $interview->delete();
        $request->session()->flash('message', __('messages/interview.deleted'));

        return redirect()->action('InterviewController@index');
    }

    public function accept(Request $request, Interview $interview, string $token)
    {
        $accepted = (bool)$request->query('accepted');

        if (!Hash::check($token, $interview->token)) {
            return redirect()
                ->route('home')
                ->withErrors([
                    'views/interviews.invalid_token'
                ]);
        }

        $inviter = User::find($interview->inviter_id);
        $invitee = User::find($interview->invitee_id);

        if ($accepted) {
            $interview->accepted = $accepted;
            $interview->save();

            Mail::to($inviter->email)->send(new InterviewAcceptedMail($interview, $inviter));
            Mail::to($invitee->email)->send(new InterviewAcceptedMail($interview, $invitee));
        } else {
            Mail::to($inviter->email)->send(new InterviewRejectedMail($interview, $inviter));
            Mail::to($invitee->email)->send(new InterviewRejectedMail($interview, $invitee));

            $interview->delete();
        }

        $request->session()->flash('message', $accepted ? __('messages/interview.accepted') : __('messages/interview.rejected'));

        return redirect()->route('home');
    }
}
