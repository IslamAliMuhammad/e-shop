@extends('client.layouts.app')

@section('style')
@livewireStyles
@endsection

@section('content')

@include('client.partials._success-alert')

<!-- breadcrumb -->
<div class="container">
    <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
        <a href="{{ route('home') }}" class="stext-109 cl8 hov-cl1 trans-04">
            {{ __('Home') }}
            <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
        </a>

        <a href="{{ route('products.index') }}" class="stext-109 cl8 hov-cl1 trans-04">
            {{ __('Shop') }}
            <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
        </a>

        <span class="stext-109 cl4">
            {{ __('Product Details') }}
        </span>
    </div>
</div>
<!-- Product Detail -->
<section class="sec-product-detail bg0 p-t-65 p-b-60">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-7 p-b-30">
                <div class="p-l-25 p-r-30 p-lr-0-lg">
                    <div class="wrap-slick3 flex-sb flex-w">
                        <div class="wrap-slick3-dots"></div>
                        <div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

                        {{-- Product images --}}
                        <div class="slick3 gallery-lb">

                            @foreach ($product->media as $mediaItem)
                            <div class="item-slick3" data-thumb="{{ $mediaItem->getFullUrl() }}">
                                <div class="wrap-pic-w pos-relative">
                                    <img src="{{ $mediaItem->getFullUrl() }}" alt="IMG-PRODUCT">

                                    <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04"
                                        href="images/product-detail-01.jpg">
                                        <i class="fa fa-expand"></i>
                                    </a>
                                </div>
                            </div>
                            @endforeach

                            @if($product->media->isEmpty())
                            <div class="item-slick3" data-thumb="{{ asset('images/defaults/general.png') }}">
                                <div class="wrap-pic-w pos-relative">
                                    <img src="{{ asset('images/defaults/general.png') }}" alt="IMG-PRODUCT">

                                    <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04"
                                        href="images/product-detail-01.jpg">
                                        <i class="fa fa-expand"></i>
                                    </a>
                                </div>
                            </div>
                            @endif

                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-5 p-b-30">
                <div class="p-r-50 p-t-5 p-lr-0-lg">
                    <h4 class="mtext-105 cl2 js-name-detail p-b-14">
                        {{ $product->name }}
                    </h4>

                    <span class="mtext-106 cl2">
                        {{ $product->getPrice() . ' ' . __('EGP')}}
                    </span>

                    <p class="stext-102 cl3 p-t-23">
                        {{ $product->description }}
                    </p>

                    <!-- Add To Cart -->
                    <form action="{{ route('cart_items.store') }}" method="POST">
                        @csrf

                        <input type="hidden" name="product_id" id="product-id" value="{{ $product->id }}">

                        <div class="p-t-33">
                            <livewire:product-details.select-variation :product='$product'>
                        </div>
                    </form>

                    <!--  -->
                    <div class="flex-w flex-m p-l-100 p-t-40 respon7">
                        <div class="flex-m bor9 p-r-10 m-r-11">
                            <a href="#"
                                class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 js-addwish-detail tooltip100"
                                data-tooltip="Add to Wishlist">
                                <i class="zmdi zmdi-favorite"></i>
                            </a>
                        </div>

                        <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100"
                            data-tooltip="Facebook">
                            <i class="fa fa-facebook"></i>
                        </a>

                        <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100"
                            data-tooltip="Twitter">
                            <i class="fa fa-twitter"></i>
                        </a>

                        <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100"
                            data-tooltip="Google Plus">
                            <i class="fa fa-google-plus"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Navigation -> (description, Additional information, Reviews) --}}
        <div class="bor10 m-t-50 p-t-43 p-b-40">
            <!-- Tab01 -->
            <div class="tab01">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item p-b-10">
                        <a class="nav-link active" data-toggle="tab" href="#description" role="tab">{{ __('Description') }}</a>
                    </li>

                    <li class="nav-item p-b-10">
                        <a class="nav-link" data-toggle="tab" href="#reviews" role="tab">{{ __('Reviews') }}</a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content p-t-43">
                    <!-- - -->
                    <div class="tab-pane fade show active" id="description" role="tabpanel">
                        <div class="how-pos2 p-lr-15-md">
                            <p class="stext-102 cl6">
                                {{ $product->description }}
                            </p>
                        </div>
                    </div>

                    <!-- Reviews -->
                    <div class="tab-pane fade" id="reviews" role="tabpanel">
                        <div class="row">
                            <div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
                                <div class="p-b-30 m-lr-15-sm">

                                    @foreach ($reviews as $review)
                                          <!-- Review -->
                                        <div class="flex-w flex-t p-b-68">
                                            <div class="wrap-pic-s size-109 bor0 of-hidden m-r-18 m-t-6">


                                                @if ($review->user)
                                                    <img src="{{ $review->user->media->isNotEmpty() ? $review->user->media[0]->getFullUrl() : asset('images/defaults/user.png') }}" alt="AVATAR">
                                                @else
                                                    <img src="{{ asset('images/defaults/user.png') }}" alt="AVATAR">
                                                @endif

                                            </div>

                                            <div class="size-207">
                                                <div class="flex-w flex-sb-m p-b-17">
                                                    <span class="mtext-107 cl2 p-r-20">
                                                        {{ $review->reviewer_name ? $review->reviewer_name : $review->user->full_name }}
                                                    </span>

                                                    <span class="fs-18 cl11">
                                                        @for ($i = 0; $i < $review->rating; $i++)
                                                            <i class="zmdi zmdi-star"></i>
                                                        @endfor
                                                    </span>
                                                </div>

                                                <p class="stext-102 cl6">
                                                    {{ $review->body }}
                                                </p>
                                            </div>
                                        </div>
                                    @endforeach

                                    @auth
                                     <!-- Add review -->
                                     <form class="w-full" action="{{ route('reviews.store') }}" method="POST">

                                        @csrf

                                        <input type="hidden" name="product_id" value="{{ $product->id }}" >

                                        <h5 class="mtext-108 cl2 p-b-7">
                                            {{ __('Add a review') }}
                                        </h5>

                                        <p class="stext-102 cl6">
                                            {{ __('Your email address will not be published. Required fields are marked *') }}
                                        </p>

                                        <div class="flex-w flex-m p-t-50 p-b-23">
                                            <span class="stext-102 cl3 m-r-16">
                                                {{ __('Your Rating') }}
                                            </span>

                                            <span class="wrap-rating fs-18 cl11 pointer">
                                                <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                                <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                                <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                                <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                                <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                                <input class="dis-none" type="number" name="rating">
                                            </span>
                                        </div>

                                        <div class="row p-b-25">
                                            <div class="col-12 p-b-5">
                                                <label class="stext-102 cl3" for="review">{{ __('Your review') }}</label>
                                                <textarea class="size-110 bor8 stext-102 cl2 p-lr-20 p-tb-10"
                                                    id="review" name="body" ></textarea>
                                                    @error('body')
                                                        @include('client.partials._validation-alert')
                                                    @enderror
                                            </div>
                                        </div>

                                        <button
                                            class="flex-c-m stext-101 cl0 size-112 bg7 bor11 hov-btn3 p-lr-15 trans-04 m-b-10">
                                            {{ __('Submit') }}
                                        </button>
                                    </form>
                                    @endauth

                                    @guest
                                    <form class="w-full" action="{{ route('reviews.store') }}" method="POST">

                                        @csrf

                                        <input type="hidden" name="product_id" value="{{ $product->id }}" >

                                        <h5 class="mtext-108 cl2 p-b-7">
                                            {{ __('Add a review') }}
                                        </h5>

                                        <p class="stext-102 cl6">
                                            {{ __('Your email address will not be published. Required fields are marked *') }}
                                        </p>

                                        <div class="flex-w flex-m p-t-50 p-b-23">
                                            <span class="stext-102 cl3 m-r-16">
                                                {{ __('Your Rating') }}
                                            </span>

                                            <span class="wrap-rating fs-18 cl11 pointer">
                                                <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                                <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                                <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                                <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                                <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                                <input class="dis-none" type="number" name="rating">
                                            </span>
                                        </div>

                                        <div class="row p-b-25">
                                            <div class="col-12 p-b-5">
                                                <label class="stext-102 cl3" for="review">Your review</label>
                                                <textarea class="size-110 bor8 stext-102 cl2 p-lr-20 p-tb-10"
                                                    id="review" name="body" ></textarea>
                                                    @error('body')
                                                        @include('client.partials._validation-alert')
                                                    @enderror
                                            </div>


                                            <div class="col-sm-6 p-b-5">
                                                <label class="stext-102 cl3" for="name">Name</label>
                                                <input class="size-111 bor8 stext-102 cl2 p-lr-20" id="name" type="text"
                                                    name="reviewer_name" >
                                                @error('reviewer_name')
                                                    @include('client.partials._validation-alert')
                                                @enderror
                                            </div>

                                            <div class="col-sm-6 p-b-5">
                                                <label class="stext-102 cl3" for="email">Email</label>
                                                <input class="size-111 bor8 stext-102 cl2 p-lr-20" id="email"
                                                    type="text" name="reviewer_email">
                                                @error('reviewer_email')
                                                    @include('client.partials._validation-alert')
                                                @enderror
                                            </div>
                                        </div>

                                        <button
                                            class="flex-c-m stext-101 cl0 size-112 bg7 bor11 hov-btn3 p-lr-15 trans-04 m-b-10">
                                            {{ __('Submit') }}
                                        </button>
                                    </form>
                                    @endguest

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>

    <div class="bg6 flex-c-m flex-w size-302 m-t-73 p-tb-15">
        <span class="stext-107 cl6 p-lr-25">
            {{ __('Categories'). ': ' . $product->subcategory->name . ', ' . $product->subcategory->category->name }}
        </span>
    </div>
</section>

<!-- Related Products -->
<section class="sec-relate-product bg0 p-t-45 p-b-105">
    <div class="container">
        <div class="p-b-45">
            <h3 class="ltext-106 cl5 txt-center">
                {{ __('Related Products') }}
            </h3>
        </div>

        <!-- Slide2 -->
        <div class="wrap-slick2">
            <div class="slick2">

                @foreach ($relatedProducts as $product)
                <div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
                    <!-- Block2 -->
                    <div class="block2">
                        <div class="block2-pic hov-img0">
                            <img src="{{ $product->media->isNotEmpty() ? $product->media[0]->getFullUrl() : asset('images/defaults/general.png')  }}"
                                alt="IMG-PRODUCT">
                        </div>

                        <div class="block2-txt flex-w flex-t p-t-14">
                            <div class="block2-txt-child1 flex-col-l ">
                                <a href="{{ route('products.show', $product->id) }}"
                                    class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                    {{ $product->description }}
                                </a>

                                <span class="stext-105 cl3">
                                    {{ $product->price }}
                                </span>
                            </div>

                            <div class="block2-txt-child2 flex-r p-t-3">
                                <a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
                                    <img class="icon-heart1 dis-block trans-04"
                                        src="{{ asset('client/images/icons/icon-heart-01.png') }}" alt="ICON">
                                    <img class="icon-heart2 dis-block trans-04 ab-t-l"
                                        src="{{ asset('client/images/icons/icon-heart-02.png') }}" alt="ICON">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>
</section>

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

