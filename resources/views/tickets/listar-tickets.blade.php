<style>
    .fundo-laranja {
        background-color: #FF8C00;
    }
</style>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lista de tickets') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="fundo-laranja overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <table class="table w-full">
                        <thead>
                            <tr>
                                <th class="text-left px-4 py-2">ID</th>
                                <th class="text-left px-4 py-2">Título</th>
                                <th class="text-left px-4 py-2">Descrição</th>
                                <th class="text-left px-4 py-2">Criador</th>
                                <th class="text-left px-4 py-2">Técnico</th>
                                <th class="text-left px-4 py-2">Criado em</th>
                                <th class="text-left px-4 py-2">Última atualização</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tickets as $ticket)
                                @php $ticket->ticket_criado_em = date('d/m/Y', strtotime($ticket->ticket_criado_em)); @endphp
                                @php $ticket->ticket_atualizado_em = date('d/m/Y', strtotime($ticket->ticket_atualizado_em)); @endphp
                                <tr>
                                    <td class="px-4 py-2 text-white">{{ $ticket->ticket_id }}</td>
                                    <td class="px-4 py-2 text-white">{{ $ticket->ticket_nome }}</td>
                                    <td class="px-4 py-2 text-white" style="width: 20px; white-space: nowrap; text-overflow: ellipsis;">{{ $ticket->ticket_descricao }}</td>
                                    <td class="px-4 py-2 text-white">{{ $ticket->cliente_nome }}</td>
                                    <td class="px-4 py-2 text-white">{{ $ticket->tecnico_nome }}</td>
                                    <td class="px-4 py-2 text-white">{{ $ticket->ticket_criado_em }}</td>
                                    <td class="px-4 py-2 text-white">{{ $ticket->ticket_atualizado_em }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
