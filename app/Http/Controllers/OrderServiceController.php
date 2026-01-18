<?php

namespace App\Http\Controllers;

use App\Models\Condominios;
use App\Models\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('serviceOrders.serviceOrder-management');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        $condos = Condominios::all();
        $techs = DB::table('funcionarios')
            ->where('sector', 'Área Técnica')
            ->get();

        return view('serviceOrders.new-serviceOrder', [
            'condos' => $condos,
            'techs' => $techs,
            'user' => $user
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $responsible = Auth::user();
        $serviceOrder = new OrderService();
        $serviceOrder->condominium = $request->condominium;
        $serviceOrder->technical = $request->technical;
        $serviceOrder->responsible = $responsible-> name . ' ' . $responsible->surname;
        $serviceOrder->description = $request->description;
        $serviceOrder->save();

        return redirect()->route('ordens-servico.index')->with('msg-success', 'Ordem de serviço cadastrada com sucesso! Se necessário adicione itens do estoque para esta OS.');
    }

    /**
     * Display the specified resource.
     */
    public function show(OrderService $orderService)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OrderService $orderService)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OrderService $orderService)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OrderService $orderService)
    {
        //
    }
}
