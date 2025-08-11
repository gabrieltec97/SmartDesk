<?php

namespace App\Http\Controllers;

use App\Models\Funcionarios;
use Exception;
use Illuminate\Http\Request;

class FuncionariosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Funcionarios::all();
        return view('Employees.employee-management', [
            'employees' => $employees
        ]);
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
        $employee = new Funcionarios();
        $employee->name = $request->name;
        $employee->sector = $request->sector;
        $employee->save();

        return redirect()->back()->with('msg-success', 'Funcionário cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Funcionarios $funcionarios)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Funcionarios $funcionarios)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Funcionarios $funcionarios)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Funcionarios $funcionario)
    {
        try {
        $funcionario->delete();

        return redirect()
            ->back()
            ->with('msg-success', 'Funcionário excluído com sucesso!');
        }catch (Exception $e) {
        
        return redirect()->back()->with('msg-error', 'Falha ao excluir funcionário. Contate o suporte do sistema.');
        }  
    }
}
