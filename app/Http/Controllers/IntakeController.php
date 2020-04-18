<?php

namespace App\Http\Controllers;

use App\Intake;
use Illuminate\Http\Request;

class IntakeController extends Controller
{
    public function index()
    {

    }

    public function create()
    {

    }

    public function store(Request $request)
    {

    }

    public function show(Intake $intake)
    {

    }

    public function destroy(Request $request, Intake $intake)
    {
        $intake->delete();
        $request->session()->flash('message', __('messages/intake.deleted'));

        return redirect()->action('IntakeController@index');
    }
}
