<?php

namespace App\Http\Livewire\ProductDetails;

use Livewire\Component;

class SelectVariation extends Component
{

    public $product;
    public $sizeSelectedId;
    public $colorSelectedId;

    public $variationsGroupedBySize = [];
    public $variationsForSelectedSize = [];


    public $variationSelectedStock;


    public function mount() {
        if($this->product->variations->isNotEmpty()){
            $this->variationsGroupedBySize = $this->product->variations()->groupBy('size_id')->with('size')->get();
        }

    }

    public function updated() {
        $this->variationsForSelectedSize = $this->product->variations()->where('size_id', $this->sizeSelectedId)->get();

        if(isset($this->colorSelectedId)){
            $this->variationSelectedStock = $this->variationsForSelectedSize->where('color_id', $this->colorSelectedId)->first()->stock;
        }
    }

    public function render()
    {

        return view('livewire.product-details.select-variation');
    }
}
