@extends('dashboard.layouts.app')

@section('content-header')
<div class="container-fluid">
    <div class="mb-2 row">
        <div class="col-sm-6">
            <h1 class="m-0"></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.home.index') }}">{{ ('Home') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('dashboard.discounts.index') }}">{{ ('Discounts') }}</a></li>
                <li class="breadcrumb-item active">{{ __('Create') }}</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.container-fluid -->
@endsection

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ __('Create Discount') }}</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('dashboard.discounts.store') }}" method="POST">

            @csrf

            <div class="card-body">
                <div class="form-group">
                    <label for="enNameInp">{{ __('Name In English') }}</label>
                    <input type="text" name="en[name]" class="form-control" id="enNameInp" placeholder="{{ __('Enter Name In English') }}" value="{{ old('en[name]') }}" required>
                    @error("en[name]")
                        @include('dashboard.partials._validation-alert')
                    @enderror
                </div>

                <div class="form-group">
                    <label for="arNameInp">{{ __('Name In Arabic') }}</label>
                    <input type="text" name="ar[name]" class="form-control" id="arNameInp" placeholder="{{ __('Enter Name In Arabic') }}" value="{{ old('ar[name]') }}" required>
                    @error("ar[name]")
                        @include('dashboard.partials._validation-alert')
                    @enderror
                </div>

                <div class="form-group">
                    <label for="enDescriptionInp">{{ __('Description In English') }}</label>
                    <input type="text" name="en[description]" class="form-control" id="enDescriptionInp" placeholder="{{ __('Enter Description In English') }}" value="{{ old('en[descriptin]') }}" required>
                    @error("en[description]")
                        @include('dashboard.partials._validation-alert')
                    @enderror
                </div>

                <div class="form-group">
                    <label for="arDescriptionInp">{{ __('Description In Arabic') }}</label>
                    <input type="text" name="ar[description]" class="form-control" id="arDescriptionInp" placeholder="{{ __('Enter Description In Arabic') }}" value="{{ old('ar[descriptin]') }}" required>
                    @error("ar[description]")
                        @include('dashboard.partials._validation-alert')
                    @enderror
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="discountInp">{{ __('Discount %') }}</label>
                        <input type="number" min="0" step="0.01" name="discount_percent" class="form-control" id="discountInp" placeholder="{{ __('Enter Percentage Discount') }}" value="{{ old('discount') }}" required>
                        @error("discount")
                            @include('dashboard.partials._validation-alert')
                        @enderror
                    </div>

                    <div class="pl-5 my-auto form-group col-md-6">
                        <label class="d-block">{{ __('Is Active') }}</label>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="is_active" id="trueActiveRadio" value="1">
                            <label class="form-check-label" for="trueActiveRadio">true</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="is_active" id="falseActiveRadio" value="0">
                            <label class="form-check-label" for="falseActiveRadio">false</label>
                          </div>


                        @error("is_active")
                            @include('dashboard.partials._validation-alert')
                        @enderror
                    </div>


                </div>
            </div>

            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">{{ __('Create') }} <i class="fa fa-plus-circle"></i></button>
            </div>
        </form>
    </div>

@endsection
