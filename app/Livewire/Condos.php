<?php

namespace App\Livewire;

use App\Models\Condominios;
use Livewire\Component;

class Condos extends Component
{

    public $searchTerm = '';
    public $condos;

    public function render()
    {
        $this->condos = Condominios::where('name', 'like', '%'.$this->searchTerm.'%')
            ->orWhere('location', 'like', '%'.$this->searchTerm.'%')
            ->get();

        return view('livewire.condos');
    }
}
