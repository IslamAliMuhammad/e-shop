<div>
    {{-- Success is as dangerous as failure. --}}

    <label for="city">{{ __('City') }}</label>
    <select class="custom-select d-block w-100" id="city" name="city_id" required wire:model="citySelectedId">
        <option value="" selected>Choose...</option>
        @foreach ($cities as $city)
            <option value="{{ $city->id }}">{{ $city->name }}</option>
        @endforeach
    </select>
    <div class="invalid-feedback">
        Please select a valid city.
    </div>
</div>
