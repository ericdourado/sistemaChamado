<style>
    .truncate-description {
        max-width: 150px;
        /* Defina a largura máxima desejada */
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .botao-laranja {
        display: inline-block;
        padding: 10px 20px;
        background-color: #FF8C00;
        color: #fff;
        text-decoration: none;
        border: 1px solid #FF8C00;
        border-radius: 5px;
        margin-top: 5px;
    }

    .botao-laranja:hover {
        background-color: #ff7f00;
    }

    .novo {
        text-align: center;
    }
    .div-paginacao {
        display: flex;
        justify-content: center;
        
    }
    body > div > main > div > div > div.div-paginacao > div > ul > nav > div.hidden.sm\:flex-1.sm\:flex.sm\:items-center.sm\:justify-between {
        flex-direction: column-reverse; 
    }
    
    .edit-id {
        color: #42b0f5;
    }

    .edit-id:hover {
        font-size: 1rem;
    }
</style>


<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lista de tickets') }}
        </h2>
    </x-slot>

    <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-2">
            
                @if(session('mensagem_sucesso'))
                    <div class="novo bg-green-400 text-white p-4">
                        {!! session('mensagem_sucesso') !!}
                    </div>
                @endif
            
            <div class="flex items-center justify-between pb-4">
                <div>
                    <form>
                        <select id="filtro" name="filtro_status" onchange="form.submit()"
                            class="block w-48 mt-4 px-4 py-2 rounded-full border border-gray-300 bg-white text-gray-800 appearance-none hover:border-gray-400 focus:outline-none focus:ring focus:border-blue-300">
                            <option value="">Status</option>
                            @foreach ($status as $item)
                                <option value="{{ $item->id }}"
                                    {{ $statusSelecionado == $item->id ? 'selected' : '' }}>
                                    {{ $item->description }}
                                </option>
                            @endforeach

                        </select>
                    </form>

                </div>
                <div class="novo">
                    <a href="{{ route('ticket.create') }}" class="botao-laranja">Novo</a>
                </div>
                <label for="table-search" class="sr-only">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor"
                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <form style="margin: 0">
                        <input type="text" id="table-search" name="filtro"
                            class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Search for items">
                        <input type="submit" id="table-search" style="display: none">
                    </form>
                </div>
            </div>

            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 bg-white border border-gray-200">
                <thead class="text-xs text-gray-700 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3"> ID</th>
                        <th scope="col" class="px-6 py-3"> Título</th>
                        <th scope="col" class="px-6 py-3"> Descrição</th>
                        <th scope="col" class="px-6 py-3"> Status</th>
                        <th scope="col" class="px-6 py-3"> Criador</th>
                        <th scope="col" class="px-6 py-3"> Técnico</th>
                        <th scope="col" class="px-6 py-3"> Criado em</th>
                        <th scope="col" class="px-6 py-3"> Última atualização</th>
                        <th scope="col" class="px-6 py-3"> Editar </th>
                        <th scope="col" class="px-6 py-3"> Deletar </th>
                    </tr>
                </thead>
                <tbody>
                    @if (!empty($tickets))
                        @foreach ($tickets as $ticket)
                            @php $ticket->ticket_criado_em = date('d/m/Y', strtotime($ticket->ticket_criado_em)); @endphp
                            @php $ticket->ticket_atualizado_em = date('d/m/Y', strtotime($ticket->ticket_atualizado_em)); @endphp
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <a class="edit-id" href="/editar-ticket/{{ $ticket->ticket_id }}">{{ $ticket->ticket_id }}</a></td>
                                <td scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $ticket->ticket_nome }}</td>
                                <td scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <div class="truncate-description" title="{{ $ticket->ticket_descricao }}">
                                        {{ $ticket->ticket_descricao }}</div>
                                </td>

                                @if (auth()->user()->role_id == 1)
                                    {{-- <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"> {{ $ticket->status }}</td> --}}
                                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <form action="/editar-ticket/atribuir/suport/{{$ticket->ticket_id}}" method="POST">
                                            @csrf
                                            <select id="status" name="status" onchange="form.submit()"
                                                class="block w-48 mt-4 px-4 py-2 rounded-full border border-gray-300 bg-white text-gray-800 appearance-none hover:border-gray-400 focus:outline-none focus:ring focus:border-blue-300">
                                                
                                                {{-- <option value="">{{$ticket->status}}</option> --}}

                                                @foreach ($status as $value)
                                                <option value="{{ $value->id }}" @if ($ticket->situacao_id == $value->id) selected @endif >
                                                        {{ $value->description }}
                                                    </option>
                                                @endforeach

                                            </select>
                                        </form>
                                    </td>

                                @else
                                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"> 
                                        <form action="/editar-ticket/atribuir/suport/{{$ticket->ticket_id}}" method="POST">
                                            @csrf
                                            <select id="status" name="status" onchange="form.submit()"
                                                class="block w-48 mt-4 px-4 py-2 rounded-full border border-gray-300 bg-white text-gray-800 appearance-none hover:border-gray-400 focus:outline-none focus:ring focus:border-blue-300">
      

                                                @foreach ($status as $value)
                                                
                                                    {{-- @if ($value->id == 4) --}}
                                                        <option value="{{ $value->id }}" @if ($ticket->situacao_id == $value->id) selected @endif >
                                                            {{ $value->description }}
                                                        </option>
                                                    {{-- @endif --}}
                                                @endforeach

                                            </select>
                                        </form>    
                                    
                                    </td>
                                @endif




                                <td scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $ticket->cliente_nome }}</td>


                                @if (auth()->user()->role_id == 1)
                                   
                                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"> 
                                        <form action="/editar-ticket/atribuir/suport/{{$ticket->ticket_id}}" method="POST">
                                            @csrf

                                            <select id="tecnico" name="tecnico" onchange="form.submit()"
                                                class="block w-48 mt-4 px-4 py-2 rounded-full border border-gray-300 bg-white text-gray-800 appearance-none hover:border-gray-400 focus:outline-none focus:ring focus:border-blue-300">
                                                
                                                @if (empty($ticket->tecnico_nome))
                                                    <option value="">{{$ticket->tecnico_nome}}</option>
                                                @endif
                                                
                                                @foreach ($tecnicos as $tecnico)
                                                    <option value="{{ $tecnico->id }}" @if ($ticket->tecnico_id == $tecnico->id) selected @endif>
                                                        {{ $tecnico->name }} 
                                                    </option>
                                                @endforeach
                                            </select>

                                            

                                        </form>
                                    </td>
                                @else
                                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"> {{ $ticket->tecnico_nome }}</td>
                                @endif


                                <td scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $ticket->ticket_criado_em }}</td>
                                <td scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $ticket->ticket_atualizado_em }}</td>

                                <td>
                                    <a href="/editar-ticket/{{ $ticket->ticket_id }}"
                                        class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-3 rounded inline-flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50" width="30px"
                                            height="20px">
                                            <path
                                                d="M 43.125 2 C 41.878906 2 40.636719 2.488281 39.6875 3.4375 L 38.875 4.25 L 45.75 11.125 C 45.746094 11.128906 46.5625 10.3125 46.5625 10.3125 C 48.464844 8.410156 48.460938 5.335938 46.5625 3.4375 C 45.609375 2.488281 44.371094 2 43.125 2 Z M 37.34375 6.03125 C 37.117188 6.0625 36.90625 6.175781 36.75 6.34375 L 4.3125 38.8125 C 4.183594 38.929688 4.085938 39.082031 4.03125 39.25 L 2.03125 46.75 C 1.941406 47.09375 2.042969 47.457031 2.292969 47.707031 C 2.542969 47.957031 2.90625 48.058594 3.25 47.96875 L 10.75 45.96875 C 10.917969 45.914063 11.070313 45.816406 11.1875 45.6875 L 43.65625 13.25 C 44.054688 12.863281 44.058594 12.226563 43.671875 11.828125 C 43.285156 11.429688 42.648438 11.425781 42.25 11.8125 L 9.96875 44.09375 L 5.90625 40.03125 L 38.1875 7.75 C 38.488281 7.460938 38.578125 7.011719 38.410156 6.628906 C 38.242188 6.246094 37.855469 6.007813 37.4375 6.03125 C 37.40625 6.03125 37.375 6.03125 37.34375 6.03125 Z" />
                                        </svg>
                                        Editar
                                    </a>
                                </td>
                                <td>
                                    <a href="/excluir-ticket/{{ $ticket->ticket_id }}"
                                        class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded inline-flex items-center">
                                        <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                        Excluir
                                    </a>
                                </td>

                            </tr>
                        @endforeach

                    @endif

                </tbody>
            </table>
            <div class="div-paginacao">
                <div class="pagination-container">
                    <ul class=" pagination pagination-sm justify-content-center">
                        {{ $tickets->links() }}
                    </ul>
                </div> 
            </div>
        </div>
</x-app-layout>


