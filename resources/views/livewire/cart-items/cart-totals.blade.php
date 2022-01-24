<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
        <h4 class="mtext-109 cl2 p-b-30">
            {{ __('Cart Totals') }}
        </h4>

        <div class="flex-w flex-t bor12 p-b-13">
            <div class="size-208">
                <span class="stext-110 cl2">
                    {{ __('Subtotal') }}:
                </span>
            </div>

            <div class="size-209">
                <span class="mtext-110 cl2">
                    {{ number_format($subtotal, 2) }} {{ __('EGP') }}
                </span>
            </div>
        </div>

        <div class="flex-w flex-t bor12 p-t-15 p-b-30">
            <div class="size-208 w-full-ssm">
                <span class="stext-110 cl2">
                    {{ __('Shipping') }}:
                </span>
            </div>

            <div class="size-209 p-r-18 p-r-0-sm w-full-ssm">
                <p>
                    50 {{ __('EGP') }}
                </p>

            </div>
        </div>

        <div class="flex-w flex-t p-t-27 p-b-33">
            <div class="size-208">
                <span class="mtext-101 cl2">
                    {{ __('Total') }}:
                </span>
            </div>

            <div class="size-209 p-t-1">
                <span class="mtext-110 cl2">
                    {{ number_format($total, 2) }} {{ __('EGP') }}
                </span>
            </div>
        </div>

        <button class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
            {{ __('Proceed to Checkout') }}
        </button>
    </div>
</div>
