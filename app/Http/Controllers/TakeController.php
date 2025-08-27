<?php

namespace App\Http\Controllers;

use App\Models\Condominios;
use App\Models\take;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TakeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view ('takes.takes-management');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $condos = Condominios::all();
        return view('takes.new-take', [
            'condos' => $condos
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function addItem(Request $request)
    {
        // No seu controlador
        $validatedData = $request->validate([
            'take_id' => 'required',
            'item' => 'required|string',
            'quantity' => 'required', // Remova a regra 'integer'
            'condominium' => 'required|string',
        ]);

        try {
            $count = DB::table('take_items')->where('item', $validatedData['item'])->count();
            $quantity = DB::table('take_items')->where('item', $validatedData['item'])->get();

            if ($count == 0){
                DB::table('take_items')->insert([
                    'take_id' => $validatedData['take_id'],
                    'item' => $validatedData['item'],
                    'quantity' => '1', // Use a variável convertida
                    'condominium' => $validatedData['condominium'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }else{
                DB::table('take_items')->where('item', $validatedData['item'])
                    ->update(['quantity' => $quantity[0]->quantity + 1]);
            }

            // Retorna uma resposta de sucesso
            return response()->json(['message' => 'Item adicionado com sucesso!'], 201);
        } catch (\Exception $e) {
            // Loga o erro para depuração
            \Log::error('Erro ao adicionar item à lista de retirada: ' . $e->getMessage());
            // Retorna uma resposta de erro
            return response()->json(['error' => 'Erro interno do servidor.'], 500);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(take $take)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(take $take)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, take $take)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(take $take)
    {
        //
    }
}
