<?php

namespace App\Http\Controllers;

use App\Models\suportfollowup;
use App\Http\Requests\StoresuportfollowupRequest;
use App\Http\Requests\UpdatesuportfollowupRequest;
use Illuminate\Http\Request;

class SuportfollowupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(int $ticket_id , Request $request)
    {
        $suportefollowup = new suportfollowup();
        $suportefollowup = suportfollowup::orderBy('created_at', 'asc')
                                                ->get();

        return view('tickets.feedback')
                ->with('ticket_id', $ticket_id)
                ->with('suportefollowup', $suportefollowup);

    }

 
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $suportfollowup = new suportfollowup();

        $adicionar_suportfollowup = [
            'ticket_id' => $request->ticket_id,
            'user_id' => auth()->user()->id,
            'description' => $request->descricao
        ];
        $suportfollowup = $suportfollowup::create($adicionar_suportfollowup);
        return redirect()->route('ticket.feedback.index', ['id' => $request->ticket_id ]);
        

    }

    /**
     * Display the specified resource.
     */
    public function show(suportfollowup $suportfollowup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(suportfollowup $suportfollowup)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatesuportfollowupRequest $request, suportfollowup $suportfollowup)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(suportfollowup $suportfollowup)
    {
        //
    }
}
