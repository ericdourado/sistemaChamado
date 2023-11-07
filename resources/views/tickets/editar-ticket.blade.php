<style>
    .fundo-laranja {
        background-color: #FF8C00;
    }
    .text-sm {
        color: white;
    }
    .button-submite{
        text-align: center;
    }
    .botao_interacoes_chamado{
        text-align: center;
    }
    .div_botao_interacoes_chamado{
        text-align: center;
        margin-bottom: 3em
    }
</style>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Atualizar Ticket') }}
        </h2>
    </x-slot>
  

    <div class="py-12">
        
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="div_botao_interacoes_chamado">
                <a href="/ticket/feedback/{{$ticket_id}}" class="botao_interacoes_chamado bg-orange-500 hover:bg-yellow-500 text-white font-bold py-2 px-4 rounded"> Chat </a>
            </div>
            <div class="fundo-laranja overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="/editar-ticket/{{$ticket_id}}">
                        @csrf
                        <div class="mb-4">
                            <label for="id_ticket" class="block text-sm font-medium text-white">ID do ticket:  {{$ticket[0]->ticket_id}} </label>
                        </div>
                        <div class="mb-4">
                            <label for="titulo" class="block text-sm font-medium text-white">Titulo do ticket:</label>
                            <input type="text" name="titulo" value="{{$ticket[0]->ticket_nome}}" id="titulo" class="form-input rounded-md shadow-sm mt-1 block w-full" />
                        </div>
                        <div class="mb-4">
                            <label for="descricao" class="block text-sm font-medium text-white">Descricao:</label>
                            <textarea id="descricao" name="descricao" class="form-input rounded-md shadow-sm mt-1 block w-full">{{$ticket[0]->ticket_descricao}}</textarea>
                        </div>
                        <div class="mb-4">
                            <label for="anydesk" class="block text-sm font-medium text-white">AnyDesk</label>
                            <input type="text" name="anydesk" value="{{$ticket[0]->anydesk}}" id="anydesk" class="form-input rounded-md shadow-sm mt-1 block w-full" />
                        </div>

                        <div class="mb-4">
                            <label for="tecnico" class="block text-sm font-medium text-white">Técnico</label>
                            

                            <select id="tecnico" name="tecnico" 
                                class="block w-48 mt-4 px-4 py-2 rounded-full border border-gray-300 bg-white text-gray-800 appearance-none hover:border-gray-400 focus:outline-none focus:ring focus:border-blue-300">
                                
                                <option value="{{$ticket[0]->tecnico_id}}">{{$ticket[0]->tecnico_nome}}</option>
                                @if (auth()->user()->role_id == 1)
                                    @foreach ($tecnicos as $tecnico)
                                        <option value="{{ $tecnico->id }}" >
                                            {{ $tecnico->name }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>

                        </div>

                        <div class="mb-4">
                            <label for="status" class="block text-sm font-medium text-white">Status</label>
                            <select id="status" name="status" 
                                class="block w-48 mt-4 px-4 py-2 rounded-full border border-gray-300 bg-white text-gray-800 appearance-none hover:border-gray-400 focus:outline-none focus:ring focus:border-blue-300">
                                
                                <option value="{{$ticket[0]->situacao_id}}">{{$ticket[0]->status}}</option>
                                @if (auth()->user()->role_id == 1)
                                    @foreach ($status as $value)
                                        <option value="{{ $value->id }}" >
                                            {{ $value->description }}
                                        </option>
                                    @endforeach
                                @endif

                            </select>

                        </div>

                        
                        <div class="mb-4 button-submite">
                            <button type="submit" class="bg-orange-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                                Alterar Ticket
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
