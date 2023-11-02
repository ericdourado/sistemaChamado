
    
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
    
    
                        <div>
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                    
                                <!-- Name -->
                                <div>
                                    <x-input-label for="name" :value="__('Nome')" />
                                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>
                    
                                <!-- Email Address -->
                                <div class="mt-4">
                                    <x-input-label for="email" :value="__('E-mail')" />
                                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>
                                <!--Sexo -->
                                <div class="mt-4">
                                    <x-input-label for="sexo" :value="__('Sexo')" />
                                        <input type="radio" name="gender" value="Masculino" > <span class="text-white">Masculino</span> 
                                        <input type="radio" name="gender" value="Feminino" > <span class="text-white">Feminino</span>
                                </div>
                    
                                <div class="mt-4">
                                    <x-input-label for="sexo" :value="__('Cargo')" />
                                        <select  name="role_id">
                                            @foreach ($roles as $role)
                                                @if ($role->id != 1)
                                                    <option value="{{$role->id}}">{{$role->role}}</option>
                                                @endif
                    
                                                @auth
                                                    @if ($role->id == 1)
                                                        <option value="{{$role->id}}">{{$role->role}}</option>
                                                    @endif
                                                @endauth
                                            @endforeach
                                        </select>
                                </div>
                    
                    
                                <!-- Password -->
                                <div class="mt-4">
                                    <x-input-label for="password" :value="__('Senha')" />
                    
                                    <x-text-input id="password" class="block mt-1 w-full"
                                                    type="password"
                                                    name="password"
                                                    required autocomplete="new-password" />
                    
                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                </div>
                    
                                <!-- Confirm Password -->
                                <div class="mt-4">
                                    <x-input-label for="password_confirmation" :value="__('Confirmar Senha')" />
                    
                                    <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                                    type="password"
                                                    name="password_confirmation" required autocomplete="new-password" />
                    
                                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                </div>
                    
                                <div class="flex items-center justify-end mt-4">
                                    <a class="underline text-sm text-white hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                                        {{ __('Ja possui conta?') }}
                                    </a>
                    
                                    <x-primary-button class="ml-4">
                                        {{ __('Criar Conta') }}
                                    </x-primary-button>
                                </div>
                            </form>
                        </div>
    
                        
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
    