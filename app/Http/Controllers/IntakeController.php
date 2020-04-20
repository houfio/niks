<?php

namespace App\Http\Controllers;

use App\Http\Requests\IntakeAcceptRequest;
use App\Http\Requests\IntakeRequest;
use App\Intake;
use App\Mail\IntakeAcceptedMail;
use App\Mail\IntakeMail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class IntakeController extends Controller
{
    public function index()
    {
        return view('intake.index', [
            'intakes' => Intake::with('inviter', 'invitee')->orderBy('created_at', 'desc')->orderBy('accepted')->get()
        ]);
    }

    public function create()
    {
        return view('intake.create', [
            'invitees' => User::where('is_approved', 0)->get()
        ]);
    }

    public function store(IntakeRequest $request)
    {
        $data = $request->validated();

        $intake = new Intake();

        $invitee = User::find($data['invitee']);

        $intake->inviter_id = Auth::id();
        $intake->invitee_id = $invitee->id;
        $intake->date = $data['date'];

        $intake->save();

        Mail::to($invitee->email)->send(new IntakeMail($intake));

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

    public function accept(IntakeAcceptRequest $request) {
        $data = $request->validated();

        $intake = $data['intake'];
        $intake->accepted = $data['accepted'];

        $intake->save();

        $inviter = User::find($intake->inviter_id);
        $invitee = User::find($intake->invitee_id);

        foreach ([$inviter, $invitee] as $user) {
            Mail::to($user->email)->send(new IntakeAcceptedMail($invitee));
        }
    }
}
