<?php

namespace App\Http\Controllers;

use App\Http\Requests\IntakeRequest;
use App\Intake;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        $intake->inviter_id = Auth::id();
        $intake->invitee_id = $data['invitee'];
        $intake->date = $data['date'];

        $intake->save();

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
}
