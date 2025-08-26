<?php

namespace App\Http\Controllers;

use App\Models\Funcionarios;
use Exception;
use Illuminate\Http\Request;

class FuncionariosController extends Controller
{
    public function index()
    {
        $employees = Funcionarios::all();
        return view('employee-management', [
            'employees' => $employees
        ]);
    }

    public function store(Request $request)
    {
        try {
            $employee = new Funcionarios();
            $employee->name = $request->name;
            $employee->sector = $request->sector;
            $employee->save();

            return redirect()->back()->with('msg-success', 'Funcionário cadastrado com sucesso!');
        }catch (Exception $e) {

            return redirect()->back()->with('msg-error', 'Falha ao cadastrar funcionário. Contate o suporte do sistema.');
        }
    }

    public function update(Request $request, Funcionarios $funcionario)
    {
        try {
            $funcionario->name = $request->name;
            $funcionario->sector = $request->sector;
            $funcionario->save();

            return redirect()->back()->with('msg-success', 'Cadastro editado com sucesso!');
        }catch (Exception $e) {

            return redirect()->back()->with('msg-error', 'Falha ao editar cadastro de funcionário. Contate o suporte do sistema.');
        }
    }

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
