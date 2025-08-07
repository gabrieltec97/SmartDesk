<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;


class UserController extends Controller
{
    public function index(): View
    {
        $users = User::all();
        return view('Users.users-management', [
            'users' => $users
        ]);
    }

    public function checkEmail(Request $request)
    {
        $email = $request->email;
        $exists = User::where('email', $email)->exists();

        return response()->json(['exists' => $exists]);
    }

    public function store(StoreUserRequest $request)
    {
        $user = User::create([
            'profile' => $request->profile,
            'name' => $request->name,
            'surname' => $request->secondName,
            'email' => $request->email,
            'password' => Hash::make($request->password),

        ]);

        $user->assignRole($request->profile);
        return redirect()->back()->with('msg-success', 'Usuário cadastrado com sucesso!');
    }

    public function show(string $id)
    {
        $user = User::find($id);
        return view('Users.user-edit', [
            'user' => $user
        ]);
    }

    public function update(Request $request, User $user)
    {
        $user->name = $request->name;
        $user->surname = $request->secondName;
        $user->email = $request->email;
        $user->profile = $request->profile;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }else{
            $user->password = Hash::make($user->password);
        }

        $user->syncRoles([$request->profile]);
        $user->save();

        return redirect()->route('usuarios.index')->with('msg-success', 'Alterações salvas com sucesso!');
    }

    public function destroy(string $id)
    {
        if ($id == 1) {
            return redirect()->back()->with('msg-error', 'Não é permitido excluir o usuário de administrador master.');
        }

        if (Auth::user()->id == $id) {
            return redirect()->back()->with('msg-error', 'Não é permitido excluir o próprio usuário. Contate o administrador.');
        }else{
            $user = User::find($id);
            $user->delete();
            return redirect()->back()->with('msg-success', 'Usuário deletado com sucesso!');
        }
    }
}
