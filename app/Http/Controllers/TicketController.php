<?php

namespace App\Http\Controllers;

use App\Models\ticket;
use App\Http\Requests\StoreticketRequest;
use App\Http\Requests\UpdateticketRequest;
use App\Models\situation;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // dd(auth()->user()->id);
        //se for tecnico visualiza todos tickets, se for usuario visualiza somente os tickets criados pelo usuario logado
        if (auth()->user()->role_id == 1){
            $tickets = DB::table('tickets')
            ->join('users as cliente', 'cliente.id', '=', 'tickets.user_id')
            ->join('situation as situacao', 'situacao.id', '=', 'tickets.situation')
            ->leftjoin('users as tecnico', 'tecnico.id', '=', 'tickets.suport_id')
            ->select(
                'cliente.id as id_cliente',
                'cliente.name as cliente_nome',
                'tecnico.id as tecnico_id',
                'tecnico.name as tecnico_nome',
                'tickets.id as ticket_id',
                'tickets.ticket_name as ticket_nome',
                'tickets.description as ticket_descricao',
                'tickets.created_at as ticket_criado_em',
                'tickets.updated_at as ticket_atualizado_em',
                'situacao.description as status',
                'situacao.id as situacao_id'
            );
        }else{
            $tickets = DB::table('tickets')
            ->join('users as cliente', 'cliente.id', '=', 'tickets.user_id')
            ->join('situation as situacao', 'situacao.id', '=', 'tickets.situation')
            ->leftjoin('users as tecnico', 'tecnico.id', '=', 'tickets.suport_id')
            ->select(
                'cliente.id as id_cliente',
                'cliente.name as cliente_nome',
                'tecnico.id as tecnico_id',
                'tecnico.name as tecnico_nome',
                'tickets.id as ticket_id',
                'tickets.ticket_name as ticket_nome',
                'tickets.description as ticket_descricao',
                'tickets.created_at as ticket_criado_em',
                'tickets.updated_at as ticket_atualizado_em',
                'situacao.description as status',
                'situacao.id as situacao_id'
            )->where('tickets.user_id', '=', auth()->user()->id);
        }
        

        if (!empty($request->input('filtro'))) {
            $filtro = $request->input('filtro');
            $tickets = $tickets->where('tickets.ticket_name', 'like', "%$filtro%")
                ->orWhere('tecnico.name', 'like', "%$filtro%")
                ->orWhere('tickets.description', 'like', "%$filtro%")
                ->orWhere('tecnico.name', 'like', "%$filtro%")
                ->orWhere('situacao.description', 'like', "%$filtro%");
        }

        $statusSelecionado = '';
        if (!empty($request->input('filtro_status'))) {
            $statusSelecionado = $request->input('filtro_status');
            $tickets = $tickets->where('situacao.id', '=', "$statusSelecionado");
        }

        $tickets = $tickets->get();
        
        $tecnicos = new User();
        $tecnicos = $tecnicos->where('role_id', '=', 1)->get();
        

        $status = new situation();
        $status = $status->get();

        return view('tickets.listar-tickets')
                    ->with('tickets', $tickets)
                    ->with('status', $status)
                    ->with('statusSelecionado', $statusSelecionado)
                    ->with('tecnicos', $tecnicos);
    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return view('tickets.criar-novo-ticket');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $adicionar_ticket = [
            'user_id' => auth()->user()->id,
            'suport_id' => null,
            'situation' => 1,
            'ticket_name' => $request->titulo,
            'anydesk' => $request->anydesk,
            'description' => $request->descricao,
            'suport_started' => null
        ];

        $ticket = Ticket::create($adicionar_ticket);
        return to_route('ticket.index')
            ->with('mensagem.sucesso', "Criado com sucesso");
    }

    /**
     * Display the specified resource.
     */
    public function show(ticket $ticket)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ticket $ticket)
    {
        return view('tickets.editar-ticket');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateticketRequest $request, ticket $ticket)
    {

        if(!empty($ticket)) {
            return redirect()->back();
        }

        return Redirect::route('ticket.edit')->with('ticket', $ticket)->with('status', 'ticket-updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $ticket)
    {
        ticket::destroy($ticket);
        return redirect()->route('ticket.index');
    }
    public function atribuir(int $ticketid, Request $request)
    {
        if (!empty($request->tecnico)){
            $dados_atualizados = [
                'suport_id' => $request->tecnico,
                'situation' => 2,
                'suport_started' => 1
            ];
    
            $ticket = Ticket::find($ticketid);
    
            if ($ticket) {
                $ticket->update($dados_atualizados);
                return redirect()->route('ticket.index');
            } else {
                return redirect()->route('ticket.index')->with('mensagem.erro', 'Ticket não encontrado');
            }

        }
        if (!empty($request->status)){
            $dados_atualizados = [
                'situation' => $request->status,
            ];

            $ticket = Ticket::find($ticketid);

            if ($ticket) {
                $ticket->update($dados_atualizados);
                return redirect()->route('ticket.index');
            } else {
                return redirect()->route('ticket.index')->with('mensagem.erro', 'Ticket não encontrado');
            }


        }
        



        
    }
}
