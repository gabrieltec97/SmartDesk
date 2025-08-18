<?php

namespace App\Livewire;

use App\Models\Estoque;
use Livewire\Component;

class Take extends Component
{
    public $searchTerm = '';
    public $take;

    public function render()
    {
        $this->take = Estoque::where('name', 'like', '%'.$this->searchTerm.'%')->get();
        
        return view('livewire.take');
    }
}
