<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
    <div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
        <div class="flex-w flex-m m-r-20 m-tb-5">
            <input class="stext-104 cl2 plh4 size-117 bor13 p-lr-20 m-r-10 m-tb-5" type="text"
                placeholder="{{ __('Coupon Code') }}" wire:model="couponCode">

            <div
                class="flex-c-m stext-101 cl2 size-118 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-5" wire:click="couponEntered">
                {{ __('Apply coupon') }}
            </div>
        </div>
        @error('couponCode')
            @include('client.partials._validation-alert')
        @enderror

        <button class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10" wire:click="deleteAll">
            {{ __('Delete All') }}
        </button>
    </div>
</div>
