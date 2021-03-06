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
                <li class="breadcrumb-item"><a href="{{ route('dashboard.users.index') }}">{{ __('Users') }}</a></li>
                <li class="breadcrumb-item active">{{ __('Create') }}</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.container-fluid -->
@endsection

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ __('Create User') }}</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('dashboard.users.store') }}" method="POST" enctype="multipart/form-data">

            @csrf

            <div class="card-body">
                <div class="form-group">
                    <label for="firstNameInp">{{ __('First Name') }}</label>
                    <input type="text" name="first_name" class="form-control" id="firstNameInp" placeholder="{{ __('Enter First Name') }}" value="{{ old('first_name') }}" required>
                    @error('first_name')
                        @include('dashboard.partials._validation-alert')
                    @enderror
                </div>

                <div class="form-group">
                    <label for="lastNameInp">{{ __('Last Name') }}</label>
                    <input type="text" name="last_name" class="form-control" id="lastNameInp" placeholder="{{ __('Enter Last Name') }}" value="{{ old('last_name') }}" required>
                    @error('last_name')
                        @include('dashboard.partials._validation-alert')
                    @enderror
                </div>

                <div class="form-group">
                    <label for="emailInp">{{ __('Email') }}</label>
                    <input type="email" name="email" class="form-control" id="emailInp" placeholder="{{ __('Enter Email') }}" value="{{ old('email') }}" required>
                    @error('email')
                       @include('dashboard.partials._validation-alert')
                    @enderror
                </div>

                <div class="form-group">
                    <label for="passwordInp">{{ __('Password') }}</label>
                    <input type="password" name="password" class="form-control" id="passwordInp" placeholder="{{ __('Enter Password') }}"  required>
                    @error('password')
                       @include('dashboard.partials._validation-alert')
                    @enderror
                </div>

                <div class="form-group">
                    <label for="paswordConfirmationInp">{{ __('Password Confirmation') }}</label>
                    <input type="password" name="password_confirmation" class="form-control" id="paswordConfirmationInp" placeholder="{{ __('Enter Password Confirmation') }}" required>
                    @error('password_confirmation')
                       @include('dashboard.partials._validation-alert')
                    @enderror
                </div>

                <div class="form-group">
                    <label>{{ __('User Role') }}</label>
                    <select class="custom-select" name="role_name">
                        <option value="">{{ __('Customer') }}</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mt-4 form-group">
                    <label for="myfile">Select images:</label>
                    <input type="file" id="myfile" name="image">
                </div>
            </div>
            <!-- /.card-body -->

<<<<<<< HEAD
=======
            <div class="form-group">
                <label>{{ __('User Role') }}</label>
                <select class="custom-select" name="role_name">
                    <option value="">{{ __('Customer') }}</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>

>>>>>>> dev
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">{{ __('Create') }} <i class="fa fa-plus-circle"></i></button>
            </div>
        </form>
    </div>

@endsection
