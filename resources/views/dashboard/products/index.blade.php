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
                <li class="breadcrumb-item active">{{ __('Products') }}</li>
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

                    <a class="btn btn-primary btn-sm @cannot('create products') disabled @endcannot" href="{{ route('dashboard.products.create') }}"> {{ __('Create') }} <i class="fas fa-plus-circle"></i></a>

                    <div class="card-tools">
                        <form action="{{ route('dashboard.products.index') }}" method="GET">
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
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Description') }}</th>
                                <th>{{ __('Price') }}</th>
                                <th>{{ __('Category') }}</th>
                                <th>{{ __('Subcategory') }}</th>
                                <th>{{ __('Brand') }}</th>
                                <th>{{ __('Discount %') }}</th>
                                <th>{{ __('Variations') }}</th>
                                <th>{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->description }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td>{{ $product->subcategory->category->name }}</td>
                                    <td>{{ $product->subcategory->name }}</td>
                                    <td>{{ $product->brand->name }}</td>
                                    <td>{{ ($product->discount) ? $product->discount->name : '' }}</td>

                                    <td id="variations">
                                        <div class="flex-row d-flex">
                                            <div class="mr-1">
                                                <a href="{{ route('dashboard.products.variations.create', $product->id) }}"
                                                    class="btn btn-secondary btn-sm @cannot('create products') disabled @endcannot"><i
                                                        class="fa fa-plus-circle"></i></a>
                                            </div>

                                            <div class="mr-1">
                                                <a href="{{ route('dashboard.products.variations.index', $product->id) }}"
                                                    class="btn btn-info btn-sm @cannot('read products') disabled @endcannot"><i
                                                        class="fa fa-list"></i></a>
                                            </div>


                                            <div>
                                                <a href="{{ route('dashboard.products.variations.visual', $product->id) }}"
                                                    class="btn btn-warning btn-sm @cannot('update products') disabled @endcannot"><i class="fas fa-images"></i>
                                                </a>
                                            </div>

                                        </div>
                                    </td>

                                    <td id="actions">
                                        <div class="flex-row d-flex">
                                            <div class="mr-1">
                                                <a href="{{ route('dashboard.products.edit', $product->id) }}"
                                                    class="btn btn-info btn-sm @cannot('update products') disabled @endcannot"><i
                                                        class="fa fa-edit"></i></a>
                                            </div>

                                            <div class="mr-1">
                                                <form action="{{ route('dashboard.products.destroy', $product->id) }}"
                                                    method="POST" class="deleteForm">

                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit"
                                                        class="btn btn-danger btn-sm" @cannot('delete products') disabled @endcannot><i
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
                            {{ $products->appends(['search' => request()->query('search')])->links() }}

                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>

@endsection

@section('script')
<script>
    $(document).ready(function() {
        $(".deleteForm").on("submit", function(e) {
            return confirm("Do you want to delete this product?");

        });

    })
</script>
@endsection

