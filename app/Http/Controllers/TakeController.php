<?php

namespace App\Http\Controllers;

use App\Livewire\Takes;
use App\Models\Condominios;
use App\Models\Estoque;
use App\Models\Funcionarios;
use App\Models\OrderService;
use App\Models\take;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TakeController extends Controller
{
    public function index()
    {
        return view ('takes.takes-management');
    }

    public function create()
    {
        $condos = Condominios::all();
        return view('takes.new-take', [
            'condos' => $condos
        ]);
    }
    public function show($id)
    {
        $take = take::find($id);
        $date_format = $take->created_at->format('d/m/Y H:i');
        $responsible = User::find($take->responsible);
        $take->responsible_name = $responsible->name . ' ' . $responsible->surname;
        $take->date = $date_format;

        $items = DB::table('take_items')->where('os_id', $id)->get();

        return view('takes.take', [
            'take' => $take,
            'items' =>$items
        ]);
    }

    public function monthConverter()
    {
        $mes = date('M');

        $mes_extenso = array(
            'Jan' => 'Janeiro',
            'Feb' => 'Fevereiro',
            'Mar' => 'Marco',
            'Apr' => 'Abril',
            'May' => 'Maio',
            'Jun' => 'Junho',
            'Jul' => 'Julho',
            'Aug' => 'Agosto',
            'Nov' => 'Novembro',
            'Sep' => 'Setembro',
            'Oct' => 'Outubro',
            'Dec' => 'Dezembro'
        );

        return $mes_extenso["$mes"];
    }

    public function addItem(Request $request)
    {
        $user = Auth::user()->id;
        $checkOs = DB::table('takes')
            ->where('status', 'Em separação')
            ->where('responsible', $user)
            ->count();

        if ($checkOs == 0){
            $take = new take();
            $take->status = 'Em separação';
            $take->condominium = 'À inserir';
            $take->responsible = $user;
            $take->technical = 'À inserir';
            $take->photo = 'sss';
            $take->year = date("Y");
            $take->month = $this->monthConverter();
            $take->day = date("j");
            $take->save();
        }

        $validatedData = $request->validate([
            'take_id' => 'required',
            'item' => 'required|string',
        ]);

        try {
            $takeNumber = DB::table('takes')
                ->where('responsible', $user)
                ->where('status', 'Em separação')->get();

            $count = DB::table('take_items')
                ->where('take_id', $takeNumber[0]->id)
                ->where('item', $validatedData['item'])
                ->count();

            $quantity = DB::table('take_items')
                ->where('take_id', $takeNumber[0]->id)
                ->where('item', $validatedData['item'])->get();

            if ($count == 0){
                DB::table('take_items')->insert([
                    'take_id' => $takeNumber[0]->id,
                    'item' => $validatedData['item'],
                    'quantity' => '1',
                    'month' => $this->monthConverter(),
                    'year' => date("Y"),
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

        if (!isset($take[0])){
            return redirect()->back()->with('msg-error', 'É necessária a inserção de itens no pedido.');
        }

        $items = DB::table('take_items')
            ->where('take_id', $take[0]->id)->get();

       return view('takes.take-finish', [
           'condos' => $condos,
           'items' => $items,
           'technicals' => $technicals,
           'id' => $take[0]->id
       ]);
    }

    public function update(Request $request, $id)
    {
        $take = take::find($id);
        $Os = OrderService::find($request->os_id);
        $request->validate([
            'photo' => 'image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $image = $request->file('photo');
        $imageName = time() . '_' . $image->getClientOriginalName();
        $image->move(public_path('img/takes'), $imageName);
        $path = 'img/takes/' . $imageName;

        $take->status = 'Entregue ao técnico';
        $take->condominium = $Os->condominium;
        $take->technical = $Os->technical;
        $take->os_id = $request->os_id;
        $take->photo = $path;
        $take->save();

        DB::table('take_items')
            ->where('take_id', $take->id)
            ->update([
                'os_id' => $request->os_id
            ]);

        $items = DB::table('take_items')
            ->where('take_id', $take->id)->get();

        foreach ($items as $item){
            $item_id = DB::table('estoques')
                ->select('id')
                ->where('name', '=', $item->item)->get();

            $product = Estoque::find($item_id[0]->id);
            $product->quantity -= $item->quantity;
            $product->save();
        }

        return redirect()->route('retiradas.index')->with('msg-success', 'Retirada registrada com sucesso!');
    }
}
