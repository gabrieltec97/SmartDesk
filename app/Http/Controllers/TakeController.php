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
        $userId = Auth::id();

        // 1️⃣ Busca retirada existente
        $take = DB::table('takes')
            ->where('responsible', $userId)
            ->where('status', 'Em separação')
            ->first();

        // 2️⃣ Se não existe, cria uma nova
        if (!$take) {
            $takeId = DB::table('takes')->insertGetId([
                'status' => 'Em separação',
                'condominium' => 'À inserir',
                'responsible' => $userId,
                'technical' => 'À inserir',
                'photo' => 'sss',
                'year' => date("Y"),
                'month' => $this->monthConverter(),
                'day' => date("j"),
                'created_at' => now(),
                'updated_at' => now()
            ]);

            $take = DB::table('takes')->where('id', $takeId)->first();
        }

        // 3️⃣ Valida entrada
        $validatedData = $request->validate([
            'item' => 'required|string',
            'action' => 'required|in:add,remove',
        ]);

        // 4️⃣ Busca item existente na retirada
        $takeItem = DB::table('take_items')
            ->where('take_id', $take->id)
            ->where('item', $validatedData['item'])
            ->first();

        // 5️⃣ Adicionar ou remover
        if ($validatedData['action'] === 'add') {

            if (!$takeItem) {
                DB::table('take_items')->insert([
                    'take_id' => $take->id,
                    'item' => $validatedData['item'],
                    'quantity' => 1,
                    'month' => $this->monthConverter(),
                    'year' => date('Y'),
                    'condominium' => 'teste',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            } else {
                DB::table('take_items')
                    ->where('id', $takeItem->id)
                    ->update([
                        'quantity' => $takeItem->quantity + 1,
                        'updated_at' => now()
                    ]);
            }

            return response()->json(['message' => 'Item adicionado com sucesso!']);
        }

        if ($validatedData['action'] === 'remove') {

            if (!$takeItem) {
                return response()->json(['message' => 'Item não existe na retirada']);
            }

            if ($takeItem->quantity > 1) {
                DB::table('take_items')
                    ->where('id', $takeItem->id)
                    ->update([
                        'quantity' => $takeItem->quantity - 1,
                        'updated_at' => now()
                    ]);
            } else {
                DB::table('take_items')
                    ->where('id', $takeItem->id)
                    ->delete();
            }

            return response()->json(['message' => 'Item removido com sucesso!']);
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
