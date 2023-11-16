<?php

namespace App\Http\Controllers;

use App\Models\suportfollowup;
use App\Http\Requests\StoresuportfollowupRequest;
use App\Http\Requests\UpdatesuportfollowupRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class SuportfollowupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(int $ticket_id , Request $request)
    {
        
        $suportefollowups = DB::table('suportfollowup')
                                ->join('users', 'users.id', '=', 'suportfollowup.user_id')
                                ->select(
                                    'users.id',
                                    'users.name',
                                    'suportfollowup.created_at',
                                    'suportfollowup.description'
                                )->where('suportfollowup.ticket_id','=', $ticket_id)
                                ->orderBy('created_at', 'desc')
                                ->get();

        return view('tickets.feedback')
                ->with('ticket_id', $ticket_id)
                ->with('suportefollowups', $suportefollowups);

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
        date_default_timezone_set('UTC');
        $suportfollowup = new suportfollowup();

        $adicionar_suportfollowup = [
            'ticket_id' => $request->ticket_id,
            'user_id' => auth()->user()->id,
            'description' => $request->descricao,
            'created_at' => date('Y-m-d H:i:s', strtotime('-3 hours')),
            'updated_at' => date('Y-m-d H:i:s', strtotime('-3 hours')),
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
