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
                <li class="breadcrumb-item"><a href="{{ route('dashboard.brands.index') }}">{{ __('Brands') }}</a></li>
                <li class="breadcrumb-item active">{{ __('Create') }}</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.container-fluid -->
@endsection

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ __('Create Brand') }}</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('dashboard.brands.store') }}" method="POST">

            @csrf

            <div class="card-body">
                <div class="form-group">
                    <label for="nameInp">{{ __('Name') }}</label>
                    <input type="text" name="name" class="form-control" id="nameInp" placeholder="{{ __('Enter Name') }}" value="{{ old('name') }}" required>
                    @error("name")
                        @include('dashboard.partials._validation-alert')
                    @enderror
                </div>

            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">{{ __('Create') }} <i class="fa fa-plus-circle"></i></button>
            </div>
        </form>
    </div>

@endsection
