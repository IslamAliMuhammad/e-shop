@extends('client.layouts.app')

@section('style')
@livewireStyles
@endsection

@section('content')

<!-- breadcrumb -->
<div class="container">
    <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
        <a href="{{ route('home') }}" class="stext-109 cl8 hov-cl1 trans-04">
            {{ __('Home') }}
            <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
        </a>

        <span class="stext-109 cl4">
            {{ __('Shoping Cart') }}
        </span>
    </div>
</div>

<!-- Shoping Cart -->
<form class="bg0 p-t-75 p-b-85" method="get" action="{{ route('checkout.index') }}">

    @csrf

    <div class="container">
        <div class="row">
            {{-- Cart Items  --}}
            <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
                <div class="m-l-25 m-r--38 m-lr-0-xl">
                    {{-- Cart Items --}}
                    <div class="wrap-table-shopping-cart">
                        <table class="table-shopping-cart">
                            <tr class="table_head">
                                <th class="column-1">{{ __('Product') }}</th>
                                <th class="column-2"></th>
                                <th class="column-3">{{ __('Price') }}</th>
                                <th class="column-4">{{ __('Quantity') }}</th>
                                <th class="column-5">{{ __('Total') }}</th>
                            </tr>

                            @foreach ($cartItems as $index=>$cartItem)
                            <tr class="table_row">
                                <td class="column-1">
                                    <div class="how-itemcart1">
                                        <img src="{{ $cartItem->variation->product->media->isNotEmpty() ? $cartItem->variation->product->media[0]->getFullUrl() : asset('images/defaults/general.png') }}" alt="IMG">
                                    </div>
                                </td>
                                <td class="column-2">{{ $cartItem->variation->product->name }}</td>
                                <td class="column-3">{{ $cartItem->variation->product->getPrice() }}</td>
                                <td class="column-4">
                                    <livewire:cart-items.quantity :qty="$cartItem->qty" :price="$cartItem->variation->product->price" :stock="$cartItem->variation->stock" :cartItemId="$cartItem->id" />
                                </td>
                                <td class="column-5">{{ number_format($cartItem->variation->product->getTotalPrice($cartItem->qty), 2) }}</td>
                            </tr>

                            <input type="hidden" name="variation_id[]" value="{{ $cartItem->variation->id }}">

                            @endforeach

                        </table>
                    </div>

                    {{-- Coupon & Update Cart --}}
                    <livewire:cart-items.coupon-input>
                </div>
            </div>

            {{-- Cart Total --}}
            <div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
                <livewire:cart-items.cart-totals :cartItems="$cartItems">
            </div>

        </div>
    </div>
</form>

@endsection

@section('script')
    @livewireScripts
@endsection
