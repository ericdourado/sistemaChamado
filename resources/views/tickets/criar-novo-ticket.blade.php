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
</style>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Criar Novo Ticket') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="fundo-laranja overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('ticket.store') }}">
                        @csrf
                        <div class="mb-4">
                            <label for="titulo" class="block text-sm font-medium text-white">Titulo do ticket:</label>
                            <input type="text" name="titulo" id="titulo" class="form-input rounded-md shadow-sm mt-1 block w-full" />
                        </div>
                        <div class="mb-4">
                            <label for="descricao" class="block text-sm font-medium text-white">Descricao:</label>
                            <textarea id="descricao" name="descricao" class="form-input rounded-md shadow-sm mt-1 block w-full"></textarea>
                        </div>
                        <div class="mb-4">
                            <label for="anydesk" class="block text-sm font-medium text-white">AnyDesk</label>
                            <input type="text" name="anydesk" id="anydesk" class="form-input rounded-md shadow-sm mt-1 block w-full" />
                        </div>
                        
                        <div class="mb-4 button-submite">
                            <button type="submit" class="bg-orange-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                                Criar Ticket
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
