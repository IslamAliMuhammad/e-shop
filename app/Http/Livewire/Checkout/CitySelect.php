<?php

namespace App\Http\Livewire\Checkout;

use App\Models\City;
use Livewire\Component;

class CitySelect extends Component
{

    public $cities = [];
    public $citySelectedId;

    public function mount() {
        $this->cities = City::all();
    }

    public function updated() {
        $this->emit('citySelected', $this->citySelectedId);
    }
    public function render()
    {
        return view('livewire.checkout.city-select');
    }
}
