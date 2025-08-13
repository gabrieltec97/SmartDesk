<?php

namespace App\Livewire;

use App\Models\Estoque;
use Livewire\Component;

class Stock extends Component
{
    public $searchTerm = '';
    public $stock;

    public function render()
    {
        $this->stock = Estoque::where('name', 'like', '%'.$this->searchTerm.'%')->get();
        return view('livewire.stock');
    }
}
