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
                <li class="breadcrumb-item active">{{ __('Users') }}</li>
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

                    <a class="btn btn-primary btn-sm @cannot('create users') disabled @endcannot" href="{{ route('dashboard.users.create') }}">{{ __('Create') }} <i class="fas fa-plus-circle"></i></a>

                    <div class="card-tools">
                        <form action="{{ route('dashboard.users.index') }}" method="GET">

                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="search" class="float-right form-control" placeholder="Search">

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
                                <th>{{ __('First Name') }}</th>
                                <th>{{ __('Last Name') }}</th>
                                <th>{{ __('Email') }}</th>
                                <th>{{ __('Image') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->first_name }}</td>
                                    <td>{{ $user->last_name }}</td>
                                    <td>{{ $user->email }}</td>

                                    <td>
                                        <img src="{{ $user->getMedia()->isNotEmpty() ?  $user->getMedia()[0]->getFullUrl('thumb') : '' }}" class="img-thumbnail" alt="">
                                    </td>

                                    <td>
                                        <div class="flex-row d-flex">
                                            <div class="mr-1">
                                                <a href="{{ route('dashboard.users.edit', $user->id) }}"
                                                    class="btn btn-info btn-sm @cannot('update users') disabled @endcannot">{{ __('Edit') }} <i
                                                        class="fa fa-edit"></i></a>
                                            </div>

                                            <div>
                                                <form action="{{ route('dashboard.users.destroy', $user->id) }}"
                                                    method="POST" class="deleteForm">

                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" id="deleteBtn"
                                                        class="btn btn-danger btn-sm" @cannot('delete users') disabled @endcannot>{{ __('Delete') }} <i
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
                            {{ $users->appends(['search' => request()->query('search')])->links() }}

                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>

<!-- Modal HTML -->
<!-- Modal -->
<div class="modal fade" id="deleteModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          ...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Understood</button>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $(".deleteForm").on("submit", function(e) {
            return confirm("Do you want to delete this user?");

        });

    })
</script>
@endsection

