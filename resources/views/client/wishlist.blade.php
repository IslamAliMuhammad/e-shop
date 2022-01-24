@extends('client.layouts.app')

@section('style')
@livewireStyles
@endsection

@section('content')

<!-- breadcrumb -->
<div class="container">
    <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
        <a href="{{ route('home') }}" class="stext-109 cl8 hov-cl1 trans-04">
            Home
            <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
        </a>

        <span class="stext-109 cl4">
            Wishlist
        </span>
    </div>
</div>

<!-- Shoping Cart -->
    <div class="container">
        <div class="row">
            {{-- Cart Items  --}}
            <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
                <div class="m-l-25 m-r--38 m-lr-0-xl">
                    {{-- Cart Items --}}
                    <div class="wrap-table-shopping-cart">
                        <table class="table-shopping-cart">
                            <tr class="table_head">
                                <th class="column-1">Product</th>
                                <th class="column-2"></th>
                                <th class="column-3">Price</th>
                                <th class="column-4"></th>

                            </tr>

                            @foreach ($wishlists as $index=>$wishlist)
                            <tr class="table_row">
                                <td class="column-1">
                                    <div class="how-itemcart1">
                                        <img src="{{ $wishlist->product->media->isNotEmpty() ? $wishlist->product->media[0]->getFullUrl() : asset('images/defaults/general.png') }}" alt="IMG">
                                    </div>
                                </td>
                                <td class="column-2">{{ $wishlist->product->name }}</td>
                                <td class="column-3">{{ $wishlist->product->getPrice() . ' ' . __('EGP') }}</td>
                                <td>
                                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-cart">
                                        <a href="{{ route('products.show', $wishlist->product->id) }}"><i class="zmdi zmdi-shopping-cart"></i></a>
                                    </div>
                                </td>
                            </tr>


                            @endforeach

                        </table>
                    </div>

                    <div class="float-right">
                        <form action="{{ route('wishlists.deleteAll') }}" method="POST">
                            @csrf
                            <button class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10" href="">
                                {{ __('Delete All') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

@section('script')
    @livewireScripts
@endsection
