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
                <li class="breadcrumb-item"><a href="{{ route('dashboard.coupons.index') }}">{{ __('Coupons') }}</a></li>
                <li class="breadcrumb-item active">{{ __('Edit') }}</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.container-fluid -->
@endsection

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ __('Edit Coupon') }}</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('dashboard.coupons.update', $coupon->id) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="card-body">
                <div class="form-group">
                    <label for="codeInp">{{ __('Code') }}</label>
                    <input type="text" name="code" class="form-control" id="codeInp" placeholder="{{ __('Enter Code') }}" value="{{ $coupon->code }}" required>
                    @error("code")
                        @include('dashboard.partials._validation-alert')
                    @enderror
                </div>

                <div class="mt-3 form-goup ">
                    <label>{{ __('Type') }}</label>

                    <select class="custom-select" name="type">
                        <option selected value="">{{ __('Select Type') }}</option>
                        <option value="percent" {{ $coupon->type == 'percent' ? 'selected' : ''}}>{{ __('Percent') }}</option>
                        <option value="fixed" {{ $coupon->type == 'fixed' ? 'selected' : ''}}>{{ __('Fixed') }}</option>
                    </select>
                    @error("type")
                        @include('dashboard.partials._validation-alert')
                    @enderror
                </div>

                <div class="mt-3 form-group">
                    <label for="discountAmountInp">{{ __('Discount Amount') }}</label>
                    <input type="number" min="0" name="discount_amount" class="form-control" id="discountAmountInp" placeholder="{{ __('Enter Discount Amount') }}" value="{{ $coupon->discount_amount }}" required>
                    @error("discount_amount")
                        @include('dashboard.partials._validation-alert')
                    @enderror
                </div>

                <div class="mt-3 form-group">
                    <label for="minAmountInp">{{ __('Minimum Amount') }}</label>
                    <input type="number" min="0" name="min_amount" class="form-control" id="minAmountInp" placeholder="{{ __('Enter Minimum Amount') }}" value="{{ $coupon->min_amount }}" required>
                    @error("min_amount")
                        @include('dashboard.partials._validation-alert')
                    @enderror
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">{{ __('Edit') }} <i class="fa fa-plus-circle"></i></button>
            </div>
        </form>
    </div>

@endsection
