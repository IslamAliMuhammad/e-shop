@extends('dashboard.layouts.app')

@section('content-header')
<div class="container-fluid">
    <div class="mb-2 row">
        <div class="col-sm-6">
            <h1 class="m-0"></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.home.index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('dashboard.categories.index') }}">Categories</a></li>
                <li class="breadcrumb-item active">{{ __('Edit') }}</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.container-fluid -->
@endsection

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ __('Edit Category') }}</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('dashboard.categories.update', $category->id) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="card-body">
                <div class="form-group">
                    <label for="enNameInp">{{ __('Name In English') }}</label>
                    <input type="text" name="en[name]" class="form-control" id="enNameInp" placeholder="{{ __('Enter Name In English') }}" value="{{ $category->translate('ar')->name }}" required>
                    @error("en[name]")
                        @include('dashboard.partials._validation-alert')
                    @enderror
                </div>

                <div class="form-group">
                    <label for="arNameInp">{{ __('Name In Arabic') }}</label>
                    <input type="text" name="ar[name]" class="form-control" id="arNameInp" placeholder="{{ __('Enter Name In Arabic') }}" value="{{ $category->translate('en')->name }}" required>
                    @error("ar[name]")
                        @include('dashboard.partials._validation-alert')
                    @enderror
                </div>

            </div>

            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">{{ __('Edit') }} <i class="fa fa-edit"></i></button>
            </div>
        </form>
    </div>

@endsection

