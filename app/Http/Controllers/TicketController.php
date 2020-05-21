<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketRequest;
use App\Mail\IntakeAcceptedMail;
use App\Mail\TicketMail;
use App\Ticket;
use App\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class TicketController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Ticket::class, 'ticket');
    }

    public function index() {
        $user = auth()->user();

        return view('ticket.index', [
            'tickets' => Ticket::with('user')->orderBy('created_at', 'desc')->whereRaw('!is_resolved AND (user_id IS NULL OR user_id = ' . $user->id . ')')->get()
        ]);
    }

    public function create()
    {
        return view('ticket.create', [
            'types' => Type::all()
        ]);
    }

    public function store(TicketRequest $request) {
        $data = $request->validated();

        $type = Type::where('type', $data['type'])->first();

        $ticket = new Ticket();
        $ticket['first_name'] = $data['first_name'];
        $ticket['last_name'] = $data['last_name'];
        $ticket['email'] = $data['email'];
        $ticket['subject'] = $data['subject'];
        $ticket['description'] = $data['description'];
        $ticket['phone_number'] = isset($data['phone_number']) ? $data['phone_number'] : null;
        $ticket->type()->associate($type);

        $ticket->save();
        $request->session()->flash('message', __('messages/ticket.sent'));

        return redirect()->action('TicketController@index');
    }

    public function show(Request $request, Ticket $ticket) {
        return view('ticket.show', [
            'ticket' => $ticket
        ]);
    }

    public function edit(Ticket $ticket) {
        return view('ticket.update', [
            'ticket' => $ticket
        ]);
    }

    public function update(TicketRequest $request, Ticket $ticket) {
        $data = $request->validated();

        $user = auth()->user();

        $ticket['user_id'] = $user->id;
        Mail::to($ticket->email)->send(new TicketMail($ticket));

        $request->session()->flash('message', __('messages/ticket.updated'));

        return redirect()->route('ticket.show', $ticket);
    }

    public function destroy(Request $request, Ticket $ticket) {
        $ticket['is_resolved'] = true;
        $ticket->save();

        $request->session()->flash('message', __('messages/ticket.deleted'));

        return redirect()->action('TicketController@index');
    }
}
