<?php

namespace App\Livewire;

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
        // Use o Query Builder para buscar os itens da tabela take_items
        $this->takeItems = DB::table('take_items')->get();
    }
}
