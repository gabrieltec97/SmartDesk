<?php

namespace App\Http\Controllers;

use App\Models\Condominios;
use Illuminate\Http\Request;

class CondominiosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('condominium.condos');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
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

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Condominios $condominio)
    {
        $condominio->name = $request->name;
        $condominio->location = $request->city;
        $condominio->save();

        return redirect()
            ->back()
            ->with('msg-success', 'Alterações realizadas com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Condominios $condominios)
    {
        $condominios->delete();
        return redirect()
            ->back()
            ->with('msg-success', 'Condomínio deletado com sucesso!');
    }
}
