<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Unit;

class HomeController extends Controller
{
    //public function __construct()
    //{
    //    $this->middleware('auth');
    //}

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

     public function index()
    {
        $month = array(
            'Janeiro',
            'Fevereiro',
            'Marco',
            'Abril',
            'Maio',
            'Junho',
            'Julho',
            'Agosto',
            'Novembro',
            'Setembro',
            'Outubro',
            'Dezembro'
        );

        //Dados do segundo card
        $totalThisMonth = DB::table('takes')
                ->where('status', 'Entregue ao técnico')
                ->where('month', $this->monthConverter())
                ->count();

        $dataTotal = [];
        foreach($month as $m) {
            $takes = DB::table('takes')
                ->where('status', 'Entregue ao técnico')
                ->where('month', $m)
                ->count();

            array_push($dataTotal, $takes);
        }

        return view('dashboard', [
            'dataTotal' => $dataTotal,
            'totalThisMonth' => $totalThisMonth
        ]);
    }
}
