<?php

namespace App\Http\Controllers;

use App\Models\Condominios;
use App\Models\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderServiceController extends Controller
{
    public function index()
    {
        return view('serviceOrders.serviceOrder-management');
    }

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

    public function show($id)
    {
        $OS = OrderService::find($id);
        $date_format = $OS->created_at->format('d/m/Y H:i');
        $items = DB::table('take_items')
            ->where('os_id', $id)
            ->get();

        $items = $items
            ->groupBy('item')
            ->map(function ($grupo) {
                return (object) [
                    'item' => $grupo->first()->item,
                    'quantity' => $grupo->sum('quantity'),
                    'condominium' => $grupo->first()->condominium,
                ];
            })
            ->values();

        return view('serviceOrders.serviceOrder', [
            'os' => $OS,
            'items' => $items,
            'date' => $date_format
        ]);
    }
}
