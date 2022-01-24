<?php

namespace App\Http\Livewire\Checkout;

use App\Models\City;
use Livewire\Component;

class AreaSelect extends Component
{

    public $areas = [];

    protected $listeners = ['citySelected' => 'getCityAreas'];

    public function getCityAreas(City $city) {
        $this->areas = $city->areas;
    }
    public function render()
    {
        return view('livewire.checkout.area-select');
    }
}
