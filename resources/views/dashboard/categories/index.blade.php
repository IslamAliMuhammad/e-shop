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
                <li class="breadcrumb-item active">{{ __('Categories') }}</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.container-fluid -->
@endsection

@section('content')

    @include('dashboard.partials._success-alert')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">

                    <a class="btn btn-primary btn-sm" href="{{ route('dashboard.categories.create') }}"> {{ __('Create') }} <i class="fas fa-plus-circle"></i></a>

                    <div class="card-tools">
                        <form action="{{ route('dashboard.categories.store') }}">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="table_search" class="float-right form-control" placeholder="Search">

                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
                <!-- /.card-header -->
                <div class="p-0 card-body table-responsive">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>{{ __('#') }}</th>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>
                                        <div class="flex-row d-flex">
                                            <div class="mr-1">
                                                <a href="{{ route('dashboard.categories.edit', $category->id) }}"
                                                    class="btn btn-info btn-sm">{{ __('Edit') }} <i
                                                        class="fa fa-edit"></i></a>
                                            </div>

                                            <div>
                                                <form action="{{ route('dashboard.categories.destroy', $category->id) }}"
                                                    method="POST">

                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit"
                                                        class="btn btn-danger btn-sm">{{ __('Delete') }} <i
                                                            class="fa fa-trash"></i></button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                    <div class="pb-0 card-footer">
                        <div class="float-right">
                            {{ $categories->links() }}

                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection
