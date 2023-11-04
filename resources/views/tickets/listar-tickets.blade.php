<style>
    .truncate-description {
        max-width: 300px;
        /* Defina a largura máxima desejada */
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>


<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lista de tickets') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-2">
            <div class="flex items-center justify-between pb-4">
                <div>
                    <form>
                        <select id="filtro" name="filtro_status" onchange="form.submit()"
                            class="block w-48 mt-4 px-4 py-2 rounded-full border border-gray-300 bg-white text-gray-800 appearance-none hover:border-gray-400 focus:outline-none focus:ring focus:border-blue-300">
                            <option value="">Status</option>
                            @foreach ($status as $item)
                                <option value="{{ $item->id }}" {{ $statusSelecionado == $item->id ? 'selected' : '' }}>
                                    {{ $item->description }}
                                </option>
                            @endforeach

                        </select>
                    </form>

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
                                    {{ $ticket->ticket_id }}</td>
                                <td scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $ticket->ticket_nome }}</td>
                                <td scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <div class="truncate-description" title="{{ $ticket->ticket_descricao }}">
                                        {{ $ticket->ticket_descricao }}</div>
                                </td>
                                <td scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $ticket->status }}</td>
                                <td scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $ticket->cliente_nome }}</td>
                                <td scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $ticket->tecnico_nome }}</td>
                                <td scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $ticket->ticket_criado_em }}</td>
                                <td scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $ticket->ticket_atualizado_em }}</td>
                                
                                <td>
                                    <a href="/excluir-ticket/{{$ticket->ticket_id}}" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded inline-flex items-center">
                                        <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                        Excluir
                                    </a>
                                </td>

                            </tr>
                        @endforeach


                    @endif

                </tbody>
            </table>
        </div>
</x-app-layout>
