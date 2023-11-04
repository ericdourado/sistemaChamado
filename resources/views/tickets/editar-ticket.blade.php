<style>
    .fundo-laranja {
        background-color: #FF8C00;
    }
    
</style>
<x-app-layout>
    @dd($_POST)
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Tickets') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="fundo-laranja overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">


                    editar ticket

                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
