@extends('dashboard.layouts.app')

@section('content-header')
<div class="container-fluid">
    <div class="mb-2 row">
        <div class="col-sm-6">
            <h1 class="m-0"></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.home.index') }}">{{ __('Home') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('dashboard.products.index') }}">{{ __('Products') }}</a></li>
                <li class="breadcrumb-item active">{{ __('Edit') }}</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.container-fluid -->
@endsection

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ __('Edit Product') }}</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('dashboard.products.update', $product->id) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="card-body">
                <div class="form-group">
                    <label for="enNameInp">{{ __('Name In English') }}</label>
                    <input type="text" name="en[name]" class="form-control" id="enNameInp" placeholder="{{ __('Enter Name In English') }}" value="{{ $product->translate('en')->name }}" required>
                    @error("en.name")
                        @include('dashboard.partials._validation-alert')
                    @enderror
                </div>

                <div class="form-group">
                    <label for="arNameInp">{{ __('Name In Arabic') }}</label>
                    <input type="text" name="ar[name]" class="form-control" id="arNameInp" placeholder="{{ __('Enter Name In Arabic') }}" value="{{ $product->translate('ar')->name }}" required>
                    @error("ar.name")
                        @include('dashboard.partials._validation-alert')
                    @enderror
                </div>

                <div class="form-group">
                    <label for="enDescriptionInp">{{ __('Description In English') }}</label>
                    <textarea name="en[description]" class="form-control" id="enDescriptionInp" placeholder="{{ __('Enter Description In English') }}" required>{{ $product->translate('en')->description }}</textarea>
                    @error("en.description")
                        @include('dashboard.partials._validation-alert')
                    @enderror
                </div>

                <div class="form-group">
                    <label for="arDescriptionInp">{{ __('Description In Arabic') }}</label>
                    <textarea name="ar[description]" class="form-control" id="arDescriptionInp" placeholder="{{ __('Enter Description In Arabic') }}" required>{{ $product->translate('ar')->description }}</textarea>
                    @error("ar.description")
                        @include('dashboard.partials._validation-alert')
                    @enderror
                </div>

                <div class="form-group">
                    <label for="priceInp">{{ __('Price') }}</label>
                    <input type="number" min="0" step="0.01" name="price" class="form-control" id="priceInp" placeholder="{{ __('Enter Price') }}" value="{{ $product->price }}" required>
                    @error("price")
                        @include('dashboard.partials._validation-alert')
                    @enderror
                </div>

                <div class="form-group">
                    <label>{{ __('Subcategory') }}</label>

                    <select class="custom-select" name="subcategory_id">
                        <option selected value="">{{ __('Select Subcategory') }}</option>
                        @foreach ($categories as $category)
                            <optgroup label="{{ $category->name }}">
                                @foreach ($category->subcategories as $subcategory)
                                    <option value="{{ $subcategory->id }}" {{ $subcategory->id == $product->subcategory_id ? 'selected' : ''}}>{{ $subcategory->name }}</option>
                                @endforeach
                            </optgroup>
                        @endforeach
                        @error("subcategory_id")
                            @include('dashboard.partials._validation-alert')
                        @enderror
                    </select>
                </div>

                <div class="form-goup">
                    <label>{{ __('Brand') }}</label>

                    <select class="custom-select" name="brand_id">
                        <option selected value="">{{ __('Select Brand') }}</option>
                        @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}" {{ $brand->id == $product->brand_id ? 'selected' : ''}}>{{ $brand->name }}</option>
                        @endforeach
                    </select>
                    @error("brand_id")
                        @include('dashboard.partials._validation-alert')
                    @enderror
                </div>

                @if ($discounts->isNotEmpty())
                    <div class="mt-3 form-goup">
                        <label>{{ __('Discount') }}  <span class="font-weight-lighter font-italic">{{ __('(optional)') }}</span></label>

                        <select class="custom-select" name="discount_id">
                            <option selected value="">{{ __('Select Discount') }}</option>
                            @foreach ($discounts as $discount)
                                <option value="{{ $discount->id }}" {{ $discount->id == $product->discount_id ? 'selected' : ''}}>{{ $discount->name }}</option>
                            @endforeach
                        </select>
                        @error("discount_id")
                            @include('dashboard.partials._validation-alert')
                        @enderror
                    </div>
                @endif

            </div>

            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">{{ __('Edit') }} <i class="fa fa-edit"></i></button>
            </div>
        </form>
    </div>

@endsection

