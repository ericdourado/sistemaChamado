<?php

namespace App\Http\Controllers;

use App\Models\ticket;
use App\Http\Requests\StoreticketRequest;
use App\Http\Requests\UpdateticketRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request )
    {
        // $tickets = new ticket();
        // $tickets = $tickets->get();

        $tickets = DB::table('tickets')
                        ->join('users as cliente', 'cliente.id', '=', 'tickets.user_id' )
                        ->join('users as tecnico', 'tecnico.id', '=', 'tickets.suport_id')
                        ->select('cliente.id as id_cliente', 'cliente.name as nome_cliente', 'tecnico.id as tecnico_id', 
                                'tecnico.name as tecnico.name', 'tickets.*')
                        ->get();

        return view('tickets.listar-tickets')->with('tickets', $tickets);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request )
    {
        return view('tickets.criar-novo-ticket');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        echo 'request';
    }

    /**
     * Display the specified resource.
     */
    public function show(ticket $ticket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateticketRequest $request, ticket $ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ticket $ticket)
    {
        //
    }
}
