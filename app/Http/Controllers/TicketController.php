<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketRequest;
use App\Http\Requests\TicketResponseRequest;
use App\Mail\TicketMail;
use App\Ticket;
use App\TicketResponse;
use App\TicketType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Faker\Generator as Faker;

class TicketController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Ticket::class, 'ticket');
    }

    public function index(Request $request)
    {
        $user = $request->user();

        return view('ticket.index', [
            'tickets' => Ticket::with('user')
                ->orderBy('created_at', 'desc')
                ->where('is_resolved', '=', 'false')
                ->where(function ($query) use ($user) {
                    $query->where('user_id', 'is', 'null')->orWhere('user_id', '=', $user->id);
                })->get()
        ]);
    }

    public function create()
    {
        return view('ticket.create', [
            'types' => TicketType::all()
        ]);
    }

    public function store(TicketRequest $request)
    {
        $data = $request->validated();

        $type = TicketType::where('type', $data['type'])->first();

        $ticket = new Ticket();

        $ticket->first_name = $data['first_name'];
        $ticket->last_name = $data['last_name'];
        $ticket->email = $data['email'];
        $ticket->subject = $data['subject'];
        $ticket->description = $data['description'];

        $ticket->type()->associate($type);

        $ticket->save();
        $request->session()->flash('message', __('messages/ticket.sent'));

        return redirect()->action('TicketController@index');
    }

    public function show(Ticket $ticket)
    {
        return view('ticket.show', [
            'ticket' => $ticket
        ]);
    }

    public function edit(Ticket $ticket)
    {
        return view('ticket.update', [
            'ticket' => $ticket
        ]);
    }

    public function update(TicketResponseRequest $request, Ticket $ticket, Faker $faker)
    {
        $data = $request->validated();

        $response = new TicketResponse();
        $token = $faker->regexify('[A-Za-z0-9]{80}');
        $ticket->token = Hash::make($token);

        $response->response = $data['response'];
        $response->ticket()->associate($ticket);
        $response->user()->associate($request->user());

        $response->save();

        Mail::to($ticket->email)->send(new TicketMail($ticket, $response, $token));

        $request->session()->flash('message', __('messages/ticket.sent'));

        return redirect()->route('ticket.show', $ticket);
    }

    public function destroy(Request $request, Ticket $ticket)
    {
        $ticket->is_resolved = true;
        $ticket->save();

        $request->session()->flash('message', __('messages/ticket.deleted'));

        return redirect()->action('TicketController@index');
    }

    public function respond(Ticket $ticket, string $token)
    {
        $valid = Hash::check($token, $ticket->token);

        return $valid ? view('ticket.respond', [
            'ticket' => $ticket,
            'token' => $token
        ]) : abort(403);
    }

    public function reply(TicketResponseRequest $request, Ticket $ticket, string $token)
    {
        if(!Hash::check($token, $ticket->token)) return abort(403);

        $data = $request->validated();

        $response = new TicketResponse();
        $response->response = $data['response'];
        $response->ticket()->associate($ticket);

        if ($request->user()) {
            $response->user()->associate($request->user());
        }

        $response->save();

        $request->session()->flash('message', __('messages/ticket.sent'));

        return redirect()->route('ticket.show', $ticket);
    }
}
