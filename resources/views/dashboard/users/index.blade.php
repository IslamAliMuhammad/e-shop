@extends('dashboard.layouts.app')

@section('content')

    @include('.dashboard.partials._success-alert')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">

                    <a class="btn btn-primary btn-sm" href="{{ route('dashboard.users.create') }}"> {{ __('Create') }} <i class="fas fa-user"></i></a>

                    <div class="card-tools">
                        <form action="{{ route('dashboard.users.store') }}">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

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
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>{{ __('First Name') }}</th>
                                <th>{{ __('Last Name') }}</th>
                                <th>{{ __('Email') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->first_name }}</td>
                                    <td>{{ $user->last_name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <div class="d-flex flex-row">
                                            <div class="mr-1">
                                                <a href="{{ route('dashboard.users.edit', $user->id) }}"
                                                    class="btn btn-info btn-sm">{{ __('Edit') }} <i
                                                        class="fa fa-edit"></i></a>
                                            </div>

                                            <div>
                                                <form action="{{ route('dashboard.users.destroy', $user->id) }}"
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

                    <div class="card-footer pb-0">
                        <div class="float-right">
                            {{ $users->links() }}

                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection
