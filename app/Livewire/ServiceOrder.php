<?php

namespace App\Livewire;

use App\Models\OrderService;
use Livewire\Component;

class ServiceOrder extends Component
{
    public $searchTerm = '';
    public $serviceOrders;

    public function render()
    {
        $this->serviceOrders = OrderService::where('id', 'like', '%'. $this->searchTerm . '%')
            ->orWhere('condominium', 'like', '%'. $this->searchTerm . '%')
            ->orWhere('technical', 'like', '%'. $this->searchTerm . '%')
            ->orWhere('responsible', 'like', '%'. $this->searchTerm . '%')
            ->get();
        return view('livewire.service-order');
    }
}
