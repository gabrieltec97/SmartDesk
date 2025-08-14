<?php

namespace App\Http\Controllers;

use App\Models\Estoque;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EstoqueController extends Controller
{
    public function index()
    {
        return view('stock.stock-management');
    }

    public function store(Request $request)
    {
        $item = new Estoque();
        $item->name = $request->name;
        $item->quantity = $request->quantity;

        if ($request->serialNumber){
            $item->serialNumber = $request->serialNumber;
        }else{
            $item->serialNumber = 'Não se aplica';
        }

        $request->validate([
            'image' => 'required|image|max:2048',
        ]);

        $file = $request->file('image');
        $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('img'), $filename);

        $item->image = 'img/'. $filename;
        $item->save();

        return redirect()
            ->back()
            ->with('msg-success', 'Item cadastrado com sucesso!');
    }

    public function update(Request $request, Estoque $estoque)
    {
        $estoque->name = $request->name;
        $estoque->quantity = $request->quantity;

        if ($request->serialNumber){
            $estoque->serialNumber = $request->serialNumber;
        }else{
            $estoque->serialNumber = 'Não se aplica';
        }

        if ($request->image){
            $filePath = public_path($estoque->image);
            if (file_exists($filePath)) {
                unlink($filePath);
            }

            $request->validate([
                'image' => 'required|image|max:2048', // 2MB
            ]);

            $file = $request->file('image');
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('img'), $filename);

            $estoque->image = 'img/'. $filename;
        }

        $estoque->save();
        return redirect()->back()->with('msg-success', 'Item atualizado com sucesso!');
    }

    public function destroy(Estoque $estoque)
    {
        if ($estoque->image) {
            $filePath = public_path($estoque->image);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        $estoque->delete();
        return redirect()->back()->with('msg-success', 'Item deletado com sucesso!');
    }
}
