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
            {{ __('Interações do Ticket') }}
        </h2>
    </x-slot>
  

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="fundo-laranja overflow-hidden shadow-sm sm:rounded-lg">
                <form method="POST" action="/ticket/feedback">
                    @csrf
                    <div class="mb-4" style="display: none">
                        <label for="ticket_id" class="block text-sm font-medium text-white">Titulo do ticket:</label>
                        <input type="text" name="ticket_id" value="{{$ticket_id}}" id="ticket_id" class="form-input rounded-md shadow-sm mt-1 block w-full" />
                    </div>

                    <div class="mb-4 p-5">
                        <label for="descricao" class="block text-sm font-medium text-white">Descricao:</label>
                        <textarea id="descricao" name="descricao" class="form-input rounded-md shadow-sm mt-1 block w-full"></textarea>
                    </div>


                    
                    <div class="corpo_mensagens mr-auto">
                        @foreach ($suportefollowups as $suportefollowup)
                            {{-- @if (auth()->user()->id !=  $suportefollowup->id) --}}
                                <div class="bg-yellow-800 text-white rounded-lg p-2 m-4 max-w-xs @php
                                    echo auth()->user()->id != $suportefollowup->id ? '' : 'ml-auto'
                                @endphp ">
                                    <div class="font-semibold">{{ $suportefollowup->name }}</div>
                                    <div class="text-xs text-gray-400">{{$dataFormatada = date("d/m/Y H:i", strtotime($suportefollowup->created_at ))}}</div>
                                    <div class="mt-2">{{ $suportefollowup->description }}</div>
                                </div>
                        @endforeach
                    </div>
                    
                    

                    <div class="mb-4 button-submite">
                        <button type="submit" class="bg-orange-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                            Enviar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
