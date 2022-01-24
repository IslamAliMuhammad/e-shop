@extends('client.layouts.app')

@section('style')
<link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/checkout/">

<style>
    .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    @media (min-width: 768px) {
        .bd-placeholder-img-lg {
            font-size: 3.5rem;
        }
    }

</style>
<!-- Custom styles for this template -->
@if(app()->getLocale() == 'en')
    <link href="{{ asset('client/css/checkout.css') }}" rel="stylesheet">

@endif

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

        <a href="{{ route('cart_items.index') }}" class="stext-109 cl8 hov-cl1 trans-04">
            {{ __('Shopping Cart') }}
            <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
        </a>

        <span class="stext-109 cl4">
            {{ __('Checkout') }}
        </span>
    </div>
</div>

<div class="container mb-5">
    <div class="mt-4 row">

        {{-- Right Side => Your Cart --}}
        <div class="mb-4 col-md-4 order-md-2">
            <h4 class="mb-3 d-flex justify-content-between align-items-center">
                <span class="text-muted">{{ __('Your cart') }}</span>
                <span class="badge badge-secondary badge-pill">{{ $cartItems->count() }}</span>
            </h4>
            <ul class="mb-3 list-group">
                @foreach ($cartItems as $cartItem)
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0">{{ $cartItem->variation->product->name }}</h6>
                        <small class="text-muted">{{ $cartItem->variation->product->description }}</small>
                    </div>
                    <span class="text-muted">{{
                        number_format($cartItem->variation->product->getTotalPrice($cartItem->qty), 2) . ' ' . __('EGP')
                        }}</span>
                </li>
                @endforeach

                <li class="list-group-item d-flex justify-content-between">
                    <span>{{ __('Shipping Fees') }} ({{ __('EGP') }})</span>
                    <strong>{{ config('cart-items.shipping_fees', 50) . ' ' . __('EGP') }}</strong>
                </li>

                <li class="list-group-item d-flex justify-content-between">
                    <span>{{ __('Total') }} ({{ __('EGP') }})</span>
                    <strong>{{ number_format($total, 2) . ' ' . __('EGP') }}</strong>
                </li>
            </ul>

        </div>

        {{-- Left Side => Billing --}}
        <div class="col-md-8 order-md-1">
            <form class="needs-validation" novalidate method="POST" action="{{ route('orders.index') }}">

                @csrf

                @if (is_null($address))
                    {{-- Create Address Form--}}
                    <div class="address">

                        <h4 class="mb-3">{{ __('Shipping address') }}</h4>

                        <div class="mb-3">
                            <label for="address">{{ __('Address') }} </label>
                            <input type="text" name="address[address_line1]" class="form-control" id="address"
                                placeholder="1234 Main St" required>
                            <div class="invalid-feedback">
                                {{ __('Please enter your shipping address.') }}
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="address2">{{ __('Address') }} 2 <span class="text-muted">({{ __('Optional')
                                    }})</span></label>
                            <input type="text" name="address[address_line2]" class="form-control" id="address2"
                                placeholder="{{ __('Apartment or suite') }}">
                        </div>

                        <div class="mb-3">
                            <label for="mobile_number">{{ __('Mobile Number') }}</label>
                            <input type="text" name="address[mobile_number]" class="form-control" id="mobile_number"
                                placeholder="01xxxxxxxxx">
                        </div>

                        <div class="row">

                            <div class="mb-3 col-md-5">
                                <livewire:checkout.city-select>
                            </div>

                            <div class="mb-3 col-md-4">
                                <livewire:checkout.area-select>
                            </div>

                            <div class="mb-3 col-md-3">
                                <label for="postal">{{ __('Postal Code') }}</label>
                                <input type="text" name="address[postal_code]" class="form-control" id="postal"
                                    placeholder="" required>
                                <div class="invalid-feedback">
                                    Postal code required.
                                </div>
                            </div>

                        </div>

                    </div>
                @else
                    {{-- Display Address --}}
                    <div class="mb-3 card">
                        <div class="card-body">
                            <p class="card-text"><span class="font-weight-bold">{{ __('Address Line 1') }}:</span> {{ $address->address_line1 }} - {{
                                $address->area->city->name }} - {{ $address->area->name }}</p>
                            <p class="card-text"><span class="font-weight-bold">{{ __('Address Line 2') }}:</span> {{ $address->address_line2 }}</p>
                            <p class="card-text"><span class="font-weight-bold">{{ __('Postal Code') }}:</span> {{ $address->postal_code }}</p>
                            <p class="card-text"><span class="font-weight-bold">{{ __('Mobile Number') }}:</span> {{ $address->mobile_number }}</p>

                        </div>
                    </div>
                @endif


                <hr class="mb-4">

                {{-- Payments --}}
                <div class="payments">
                    <h4 class="mb-3">{{ __('Payment') }}</h4>

                    <div class="my-3 d-block">
                        <div class="custom-control custom-radio">
                            <input id="cod" name="payment_method" value="cod" type="radio" class="custom-control-input"
                                checked required>
                            <label class="custom-control-label" for="cod">{{ __('Cash on Delivery (COD)') }}</label>
                        </div>
                        {{-- <div class="custom-control custom-radio">
                            <input id="credit" name="payment_method" value="credit-card" type="radio"
                                class="custom-control-input" required>
                            <label class="custom-control-label" for="credit">Credit card</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input id="debit" name="payment_method" value="debit-card" type="radio"
                                class="custom-control-input" required>
                            <label class="custom-control-label" for="debit">Debit card</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input id="paypal" name="payment_method" value="paypal" type="radio"
                                class="custom-control-input" required>
                            <label class="custom-control-label" for="paypal">PayPal</label>
                        </div> --}}
                    </div>
                </div>

                {{-- Card Details --}}
                {{-- <div class="card-details">
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="cc-name">Name on card</label>
                            <input type="text" class="form-control" id="cc-name" placeholder="" required>
                            <small class="text-muted">Full name as displayed on card</small>
                            <div class="invalid-feedback">
                                Name on card is required
                            </div>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="cc-number">Credit card number</label>
                            <input type="text" class="form-control" id="cc-number" placeholder="" required>
                            <div class="invalid-feedback">
                                Credit card number is required
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-3 col-md-3">
                            <label for="cc-expiration">Expiration</label>
                            <input type="text" class="form-control" id="cc-expiration" placeholder="" required>
                            <div class="invalid-feedback">
                                Expiration date required
                            </div>
                        </div>
                        <div class="mb-3 col-md-3">
                            <label for="cc-cvv">CVV</label>
                            <input type="text" class="form-control" id="cc-cvv" placeholder="" required>
                            <div class="invalid-feedback">
                                Security code required
                            </div>
                        </div>
                    </div>
                </div> --}}

                <hr class="mb-4">
                <button class="btn btn-primary btn-lg btn-block" type="submit">{{ __('Continue to checkout') }}</button>
            </form>
        </div>

    </div>
</div>
@endsection

@section('script')
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
</script>
<script>
    window.jQuery || document.write('<script src="/docs/4.3/assets/js/vendor/jquery-slim.min.js"><\/script>')
</script>
<script src="https://getbootstrap.com/docs/4.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous">
</script>
<script src="https://getbootstrap.com/docs/4.3/examples/checkout/form-validation.js"></script>

@livewireScripts

@endsection
