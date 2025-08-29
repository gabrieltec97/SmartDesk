<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TakeItemsList extends Component
{
    public $takeItems;

    // O componente vai ouvir o evento 'itemAdded'
    protected $listeners = ['itemAdded' => 'loadTakeItems'];

    public function mount()
    {
        // Opcional: Carregar os itens logo na inicialização
        $this->loadTakeItems();
    }

    public function render()
    {
        return view('livewire.take-items-list');
    }

    public function loadTakeItems()
    {
        $user = Auth::user()->id;
        $checkOs = DB::table('takes')
            ->select('id')
            ->where('status', 'Em separação')
            ->where('responsible', $user)
            ->get();

        $id = 0;

        if (isset($checkOs[0])){
            $id = $checkOs[0]->id;
        }

        $this->takeItems = DB::table('take_items')
            ->where('take_id', $id)->get();
    }
}
