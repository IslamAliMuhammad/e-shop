@extends('client.layouts.app')

@section('style')
@livewireStyles
<script src="//unpkg.com/alpinejs" defer></script>
@endsection

@section('content')

<div class="container">
    @include('client.partials._success-alert')

</div>
<!-- Products -->
<div class="bg0 m-t-23 p-b-140">
    <div class="container">

        {{-- Header -> categories - fillter - search --}}
        <div class="flex-w flex-sb-m p-b-52">

            {{-- Navigation --}}
            <div class="flex-w flex-l-m filter-tope-group m-tb-10">
                <a class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 {{ url()->full() == route('products.index') ? 'how-active1' : '' }}"
                    href="{{ route('products.index') }}">
                    {{ __('All Products') }}
                </a>

                @foreach ($categories as $index=>$category)
                <a class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 {{ url()->full() == route('products.index', ['categoryId' => $index+1]) ? 'how-active1' : '' }}"
                    href="{{ route('products.index', ['categoryId' => $category->id]) }}">
                    {{ $category->name }}
                </a>
                @endforeach
            </div>

            {{-- Filter & Search --}}
            <div class="flex-w flex-c-m m-tb-10">
                <div class="flex-c-m stext-106 cl6 size-104 bor4 pointer hov-btn3 trans-04 m-r-8 m-tb-4 js-show-filter">
                    <i class="icon-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-filter-list"></i>
                    <i class="icon-close-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
                    {{ __('Filter') }}
                </div>

                <div class="flex-c-m stext-106 cl6 size-105 bor4 pointer hov-btn3 trans-04 m-tb-4 js-show-search">
                    <i class="icon-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-search"></i>
                    <i class="icon-close-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
                    {{ __('Search') }}
                </div>
            </div>

            <!-- Search product -->
            <div class="w-full dis-none panel-search p-t-10 p-b-15">
                <form action="{{ route('products.index') }}" method="GET">
                    @csrf
                    <div class="bor8 dis-flex p-l-15">
                        <button class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04" type="submit">
                            <i class="zmdi zmdi-search"></i>
                        </button>

                        <input class="mtext-107 cl2 size-114 plh2 p-r-15" type="text" name="search"
                            placeholder="Search">
                    </div>
                </form>
            </div>

            <!-- Filter -->
            <div class="w-full dis-none panel-filter p-t-10">
                <div class="w-full wrap-filter flex-w bg6 p-lr-40 p-t-27 p-lr-15-sm" style="height: 500px">

                    <div class="filter-col1 p-r-15 p-b-27">
                        <div class="mtext-102 cl2 p-b-15">
                            {{ __('Sort By') }}
                        </div>

                        <ul>

                            <li class="p-b-6">
                                <a href="{{ route('products.index', ['sortBy' => 'newness']) }}"
                                    class="filter-link stext-106 trans-04 {{ url()->full() == route('products.index', ['sortBy' => 'newness']) ? 'filter-link-active' : '' }}">
                                    {{ __('Newness') }}
                                </a>
                            </li>

                            <li class="p-b-6">
                                <a href="{{ route('products.index', ['sortBy' => 'priceLowToHigh']) }}"
                                    class="filter-link stext-106 trans-04 {{ url()->full() == route('products.index', ['sortBy' => 'priceLowToHigh']) ? 'filter-link-active' : '' }}">
                                    {{ __('Price: Low to High') }}
                                </a>
                            </li>

                            <li class="p-b-6">
                                <a href="{{ route('products.index', ['sortBy' => 'priceHighToLow']) }}"
                                    class="filter-link stext-106 trans-04 {{ url()->full() == route('products.index', ['sortBy' => 'priceHighToLow']) ? 'filter-link-active' : '' }}">
                                    {{ __('Price: High to Low') }}
                                </a>
                            </li>
                        </ul>

                    </div>

                    <div class="filter-col2 p-r-15 p-b-27">
                        <div class="mtext-102 cl2 p-b-15">
                            {{ __('Price') }}
                        </div>

                        <ul>
                            <li class="p-b-6">
                                <a href="{{ route('products.index') }}"
                                    class="filter-link stext-106 trans-04 {{ url()->full() == route('products.index') ? 'filter-link-active' : '' }}">
                                    {{ __('All') }}
                                </a>
                            </li>
                            <li class="p-b-6">
                                <a href="{{ route('products.index', ['min' => 0, 'max' => 50]) }}"
                                    class="filter-link stext-106 trans-04 {{ url()->full() == route('products.index', ['max' => 50, 'min' => 0]) ? 'filter-link-active' : '' }}">
                                    0.00 {{ __('EGP') }} - 50.00 {{ __('EGP') }}
                                </a>
                            </li>

                            <li class="p-b-6">
                                <a href="{{ route('products.index', ['min' => 50, 'max' => 100]) }}"
                                    class="filter-link stext-106 trans-04 {{ url()->full() == route('products.index', ['max' => 100, 'min' => 50]) ? 'filter-link-active' : '' }}">
                                    50.00 {{ __('EGP') }} - 100.00 {{ __('EGP') }}
                                </a>
                            </li>

                            <li class="p-b-6">
                                <a href="{{ route('products.index', ['min' => 100, 'max' => 150]) }}"
                                    class="filter-link stext-106 trans-04 {{ url()->full() == route('products.index', ['max' => 150, 'min' => 100]) ? 'filter-link-active' : '' }}">
                                    100.00 {{ __('EGP') }} - 150.00 {{ __('EGP') }}
                                </a>
                            </li>

                            <li class="p-b-6">
                                <a href="{{ route('products.index', ['min' => 150, 'max' => 200]) }}"
                                    class="filter-link stext-106 trans-04 {{ url()->full() == route('products.index', ['max' => 200, 'min' => 150]) ? 'filter-link-active' : '' }}">
                                    150.00 {{ __('EGP') }} - 200.00 {{ __('EGP') }}
                                </a>
                            </li>

                            <li class="p-b-6">
                                <a href="{{ route('products.index', ['min' => 200]) }}"
                                    class="filter-link stext-106 trans-04 {{ url()->full() == route('products.index', ['min' => 200]) ? 'filter-link-active' : '' }}">
                                    200.00+ {{ __('EGP') }}
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="filter-col3 p-r-15 p-b-27">
                        <div class="mtext-102 cl2 p-b-15">
                            {{ __('Color') }}
                        </div>

                        <ul class="flex-wrap d-flex">

                            @foreach ($colors as $color)
                            <li class="mr-2 p-b-6">
                                <a href="{{ route('products.index', ['colorId' => $color->id]) }}"
                                    class="filter-link stext-106 trans-04 {{ url()->full() == route('products.index', ['colorId' => $color->id]) ? 'filter-link-active' : '' }}">
                                    <span class="fs-25 lh-12 m-r-6" style="color: {{ $color->name }};">
                                        <i class="zmdi zmdi-circle"></i>
                                    </span>
                                </a>
                            </li>
                            @endforeach

                        </ul>
                    </div>

                </div>
            </div>
        </div>

        {{-- List of products --}}
        <div class="row isotope-grid">
            @if ($products->isNotEmpty())
                @foreach ($products as $product)
                {{-- Single Product --}}
                <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
                    <!-- Block2 -->
                    <div class="block2">
                        <div class="block2-pic hov-img0">
                            <img src="{{ $product->media->isNotEmpty() ? $product->media[0]->getFullUrl() : asset('images/defaults/general.png') }}"
                                alt="IMG-PRODUCT">
                        </div>

                        <div class="block2-txt flex-w flex-t p-t-14">
                            <div class="block2-txt-child1 flex-col-l ">
                                <a href="{{ route('products.show', $product->id) }}"
                                    class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                    {{ $product->description }}
                                </a>

                                <span class="stext-105 cl3">
                                    {{ $product->getPrice() . ' ' . __('EGP')}}

                                </span>
                            </div>

                            <div class="block2-txt-child2 flex-r p-t-3">
                                {{-- Wishlist Icon --}}
                                <livewire:products.wishlist-add :productId="$product->id" :wishlists="$wishlists">
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                <p class="mx-auto">
                    {{ __('Sorry, No Products Found') }}
                <p>
            @endif

        </div>

        <!-- Pagination -->
        <div class="w-full flex-c-m flex-w p-t-45">
            {{ $products->links() }}
        </div>
    </div>
</div>


<!-- Back to top -->
<div class="btn-back-to-top" id="myBtn">
    <span class="symbol-btn-back-to-top">
        <i class="zmdi zmdi-chevron-up"></i>
    </span>
</div>

@endsection



@section('script')
    @livewireScripts
@endsection
