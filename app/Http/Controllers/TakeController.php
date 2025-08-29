<?php

namespace App\Http\Controllers;

use App\Models\Condominios;
use App\Models\Funcionarios;
use App\Models\take;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $user = Auth::user()->id;
        $checkOs = DB::table('takes')
            ->where('status', 'Em separação')
            ->where('responsible', $user)
            ->count();

        if ($checkOs == 0){
            $take = new take();
            $take->os_id = null;
            $take->status = 'Em separação';
            $take->condominium = ' ';
            $take->responsible = $user;
            $take->technical = 'ryan';
            $take->comments = 'teste ';
            $take->photo = 'sss';
            $take->save();
        }

        $validatedData = $request->validate([
            'take_id' => 'required',
            'item' => 'required|string',
        ]);

        try {
            $count = DB::table('take_items')->where('item', $validatedData['item'])->count();
            $quantity = DB::table('take_items')->where('item', $validatedData['item'])->get();
            $takeNumber = DB::table('takes')->where('status', 'Em separação')->get();

            if ($count == 0){
                DB::table('take_items')->insert([
                    'take_id' => $takeNumber[0]->id,
                    'item' => $validatedData['item'],
                    'quantity' => '1',
                    'condominium' => 'teste',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }else{
                DB::table('take_items')->where('item', $validatedData['item'])
                    ->update(['quantity' => $quantity[0]->quantity + 1]);
            }

            return response()->json(['message' => 'Item adicionado com sucesso!'], 201);
        } catch (\Exception $e) {

            Log::error('Erro ao adicionar item à lista de retirada: ' . $e->getMessage());
            return response()->json(['error' => 'Erro interno do servidor.'], 500);
        }
    }

    public function finish()
    {
        $user = Auth::user()->id;
        $condos = Condominios::all();
        $technicals = Funcionarios::all();
        $take = DB::table('takes')
            ->select('id')
            ->where('status', 'Em separação')
            ->where('responsible', $user)->get();

        $items = DB::table('take_items')
            ->where('take_id', $take[0]->id)->get();

       return view('takes.take-finish', [
           'condos' => $condos,
           'items' => $items,
           'technicals' => $technicals
       ]);
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
