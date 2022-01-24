<div>
    {{-- The Master doesn't talk, he acts. --}}
    <div class="flex-w flex-r-m p-b-10">
        <div class="size-203 flex-c-m respon6">
            {{ __('Size') }}
        </div>

        <div class="size-204 respon6-next">
            <div class="">
                <select class="mb-1 custom-select" name="size_id" wire:model="sizeSelectedId">
                    <option value="" selected>{{ __('Choose an option') }}</option>
                    @foreach ($variationsGroupedBySize as $variation)
                    <option value="{{ $variation->size_id }}">{{ $variation->size->name }}
                    </option>
                    @endforeach
                </select>
                @error('size_id')
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
    </div>

    <div class="flex-w flex-r-m p-b-10">
        <div class="size-203 flex-c-m respon6">
            {{ __('Color') }}
        </div>

        <div class="size-204 respon6-next">
            <div class="">
                <select class="mb-1 custom-select" name="color_id" wire:model="colorSelectedId">
                    <option value="" selected>{{ __('Choose an option') }}</option>
                    @foreach ($variationsForSelectedSize as $variation)
                    <option value="{{ $variation->color_id }}">{{ $variation->color->name }}
                    </option>
                    @endforeach
                </select>

                @error('color_id')
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
    </div>

    <div class="flex-w flex-r-m p-b-10">
        <div class="size-204 flex-w flex-m respon6-next">
            {{-- Quantity --}}
            <div class="wrap-num-product flex-w m-r-20 m-tb-10">
                <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                    <i class="fs-16 zmdi zmdi-minus"></i>
                </div>

                <input class="mtext-104 cl3 txt-center num-product" type="number" name="qty"
                    value="1">

                <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m" data-stock="{{ $variationSelectedStock }}">
                    <i class="fs-16 zmdi zmdi-plus"></i>
                </div>
            </div>

            @error('qty')
                <div class="alert alert-danger" role="alert">
                    {{ $message }}
                </div>
            @enderror

            <button
                class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail"
                type="submit">
                {{ __('Add to cart') }}
            </button>
        </div>
    </div>

</div>

