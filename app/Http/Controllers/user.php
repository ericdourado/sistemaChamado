<?php

namespace App\Http\Controllers;

use App\Models\role;
use App\Models\User as ModelsUser;
use Illuminate\Http\Request;

class user extends Controller
{
    public function index(Request $request)
    {
        $users = new ModelsUser();
        $users = $users
                    ->leftjoin('roles', 'roles.id', '=', 'users.role_id')
                    ->select('users.id', 'users.name', 'roles.role', 'roles.id as role_id')
                    ->where('users.id', '<>', auth()->user()->id)
                    ->get();
        $roles = new role();
        $roles = $roles->get();

        return view('menu.alterarUser')
                    ->with('users', $users)
                    ->with('roles', $roles);
    }
    public function update(Request $request)
    {
        $editar_cargo = [
            'role_id' => $request->cargo
        ];
        $user = ModelsUser::find($request->user_id);
        if ($user) {
            $user->update($editar_cargo);
            return redirect()->route('users.index');
        } else {
            return redirect()->route('users.index')->with('mensagem', 'Usuário não encontrado');
        }
    }

}
