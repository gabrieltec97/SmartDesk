<?php

namespace App\Http\Controllers;

use App\Models\Condominios;
use Illuminate\Http\Request;

class CondominiosController extends Controller
{
    public function index()
    {
        return view('condominium.condos');
    }

    public function store(Request $request)
    {
        $condominium = new Condominios();
        $condominium->name = $request->name;
        $condominium->location = $request->city;
        $condominium->save();

        return redirect()
            ->back()
            ->with('msg-success', 'Condomínio cadastrado com sucesso!');
    }

    public function update(Request $request, Condominios $condominio)
    {
        $condominio->name = $request->name;
        $condominio->location = $request->city;
        $condominio->save();

        return redirect()
            ->back()
            ->with('msg-success', 'Alterações realizadas com sucesso!');
    }

    public function destroy(Condominios $condominio)
    {
        $condominio->delete();
        return redirect()
            ->back()
            ->with('msg-success', 'Condomínio deletado com sucesso!');
    }
}
