<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}

    <label for="area">{{ __('Area') }}</label>
    <select class="custom-select d-block w-100" id="area" name="address[area_id]" required>
        <option value="" selected>{{ __('Choose') }}...</option>
        @foreach ($areas as $area)
            <option value="{{ $area->id }}">{{ $area->name }}</option>
        @endforeach
    </select>
    <div class="invalid-feedback">
        Please provide a valid area.
    </div>
</div>
