<div x-data="{ clicked: @js($isWishlist) }">
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
    <button type="submit" wire:click="addToWishlist" x-on:click="clicked = true">

        <template x-if="clicked == false">
            <img class="icon-heart1 dis-block trans-04" src="{{ asset('client/images/icons/icon-heart-01.png') }}"
            alt="ICON">
        </template>
        <template x-if="clicked == true">
            <img class="icon-heart1 dis-block trans-04" src="{{ asset('client/images/icons/icon-heart-02.png') }}"
            alt="ICON">
        </template>
    </button>
</div>
