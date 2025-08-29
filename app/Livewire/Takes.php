<?php

namespace App\Livewire;

use App\Models\take;
use Livewire\Component;

class Takes extends Component
{
    public $searchTerm = '';
    public $take;

    public function render()
    {
        $this->take = take::where('id', 'like', '%'.$this->searchTerm.'%')
            ->orWhere('condominium', 'like', '%'.$this->searchTerm.'%')->get();

        return view('livewire.takes');
    }
}
