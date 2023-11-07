<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Atualizar Usuário') }}
        </h2>
    </x-slot>
    <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-2">
            <div class="flex items-center justify-between pb-4">

                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 bg-white border border-gray-200">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3"> ID</th>
                            <th scope="col" class="px-6 py-3"> Nome</th>
                            <th scope="col" class="px-6 py-3"> Cargo</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)

                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{$user->id}}
                            </td>
                            <td scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{$user->name}}
                            </td>
                            <td scope="row" value="{{$user->role_id}}"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">

                                    <form action="/user-cargo/{{$user->role_id}}" method="POST">
                                        @csrf
                                        <input type="hidden" value="{{$user->id}}" name="user_id" id="user_id"/>
                                        <select id="cargo" name="cargo" onchange="form.submit()" class="block w-48 mt-4 px-4 py-2 rounded-full border border-gray-300 bg-white text-gray-800 appearance-none hover:border-gray-400 focus:outline-none focus:ring focus:border-blue-300">
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}" @if ($role->id == $user->role_id) selected @endif>
                                                {{ $role->role }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </form>
                             
                            </td>
                        </tr>
                        @endforeach
                    </tbody>


            </div>
        </div>
    </div>
</x-app-layout>