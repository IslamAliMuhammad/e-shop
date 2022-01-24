<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
    <div class="wrap-num-product flex-w m-l-auto m-r-0">
        <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m" data-price="{{ $price }}" wire:click="subtractQty">
            <i class="fs-16 zmdi zmdi-minus"></i>
        </div>

        <input class="mtext-104 cl3 txt-center num-product" type="number"
            name="qty[]" value="{{ $qty }}" >

        <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m" data-stock="{{ $stock }}" data-price="{{ $price }}" wire:click="addQty">
            <i class="fs-16 zmdi zmdi-plus"></i>
        </div>
    </div>
</div>
