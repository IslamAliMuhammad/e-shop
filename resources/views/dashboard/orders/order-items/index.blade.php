@extends('dashboard.layouts.app')

@section('style')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('dashboard/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
@endsection

@section('content-header')
<div class="container-fluid">
    <div class="mb-2 row">
        <div class="col-sm-6">
            <h1 class="m-0"></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.home.index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('dashboard.orders.index') }}">Orders</a></li>

                <li class="breadcrumb-item active">{{ __('Order Items') }}</li>
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
                <h3 class="card-title">DataTable with default features</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="datatable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('Product Name') }}</th>
                            <th>{{ __('Product Color') }}</th>
                            <th>{{ __('Product Size') }}</th>
                            <th>{{ __('QTY') }}</th>
                            <th>{{ __('Created At') }}</th>
                            <th>{{ __('Actions') }}</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orderItems as $orderItem)
                            <tr>
                                <td>{{ $orderItem->id }}</td>
                                <td>{{ $orderItem->variation->product->name }}</td>
                                <td>{{ $orderItem->variation->color->name }}</td>
                                <td>{{ $orderItem->variation->size->name }}</td>
                                <td>{{ $orderItem->qty }}</td>
                                <td>{{ $orderItem->created_at }}</td>
                                <td id="actions">
                                    <div class="flex-row d-flex">
                                        <div class="mr-1">
                                            <form action="{{ route('dashboard.orders.order_items.destroy', [$order->id, $orderItem->id]) }}"
                                                method="POST" class="deleteForm">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                    class="btn btn-danger btn-sm" @cannot('delete orders') disabled @endcannot><i
                                                        class="fa fa-trash"></i></button>
                                            </form>
                                        </div>

                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>{{ __('Address') }}</th>
                            <th>{{ __('User Name') }}</th>
                            <th>{{ __('Total') }}</th>
                            <th>{{ __('Created At') }}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card-body -->
        <!-- /.card -->
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $(".deleteForm").on("submit", function(e) {
            return confirm("Do you want to delete this order?");

        });

    })
</script>

<!-- DataTables -->
<script src="{{ asset('dashboard/plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('dashboard/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
<script>
    $(function () {
        $("#datatable").DataTable();
    });
</script>
@endsection
