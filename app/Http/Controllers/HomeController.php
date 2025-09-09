<?php

namespace App\Http\Controllers;

use App\Models\Condominios;
use App\Models\Estoque;
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

        //Pegando os 5 condomínios com mais ocorrências.
        $condos = Condominios::all();
        $totalCondos = [];

        foreach ($condos as $condo){
            $total = DB::table('takes')
                ->where('condominium', $condo->name)
                ->where('status', 'Entregue ao técnico')
                ->where('month', $this->monthConverter())
                ->count();

            array_push($totalCondos, ['condo' => $condo->name, 'total' => $total]);
        }

        usort($totalCondos, function ($a, $b) {
            return $b['total'] <=> $a['total'];
        });

        $totalCondos = array_slice($totalCondos, 0, 5);

        //Pegando os 5 condomínios com mais ocorrências.
        $items = Estoque::all();
        $totalItems = [];

        foreach ($items as $item){
            $totalCount = DB::table('take_items')
                ->where('item', $item->name)
                ->count();

            array_push($totalItems, ['item' => $item->name, 'total' => $totalCount]);
        }

        usort($totalItems, function ($a, $b) {
            return $b['total'] <=> $a['total'];
        });

        $totalItems = array_slice($totalItems, 0, 5);

        //Dados do primeiro card
        $totalToday = DB::table('takes')
                ->where('status', 'Entregue ao técnico')
                ->where('month', $this->monthConverter())
                ->where('day', date("j"))
                ->where('year', date("Y"))
                ->count();

        //Dados do segundo card
        $totalThisMonth = DB::table('takes')
                ->where('status', 'Entregue ao técnico')
                ->where('month', $this->monthConverter())
                ->count();

        //Dados do gráfico
        $dataTotal = [];
        foreach($month as $m) {
            $takes = DB::table('takes')
                ->where('status', 'Entregue ao técnico')
                ->where('month', $m)
                ->where('year', date("Y"))
                ->count();

            array_push($dataTotal, $takes);
        }

        return view('dashboard', [
            'dataTotal' => $dataTotal,
            'totalThisMonth' => $totalThisMonth,
            'totalToday' => $totalToday,
            'totalCondos' => $totalCondos,
            'totalItems' => $totalItems,
        ]);
    }
}
