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
                <li class="breadcrumb-item"><a href="{{ route('dashboard.products.index') }}">{{ __('Products') }}</a></li>
                <li class="breadcrumb-item active">{{ __('Edit') }}</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.container-fluid -->
@endsection

@section('content')

    <div class="card product">
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
                    </tr>
                </thead>
                <tbody>
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->description }}</td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->subcategory->category->name }}</td>
                            <td>{{ $product->subcategory->name }}</td>
                            <td>{{ $product->brand->name }}</td>
                            <td>{{ ($product->discount) ? $product->discount->name : '' }}</td>
                        </tr>

                </tbody>
            </table>

        </div>
        <!-- /.card-body -->
    </div>

    <div class="card-body product-variations">
        <form action="{{ route('dashboard.products.variations.update', [$product->id, $variation->id]) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="container">
                <table id="myTable" class="table order-list">
                    <thead>
                        <tr>
                            <td>{{ __('Size') }}</td>
                            <td>{{ __('Color') }}</td>
                            <td>{{ __('SKU') }}</td>
                            <td>{{ __('Stock') }}</td>

                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="col-sm-4">
                                <select class="custom-select" name="size_id">
                                    <option selected value="">{{ __('Select Size') }}</option>
                                    @foreach ($sizes as $size )
                                        <option value="{{ $size->id }}" {{ $size->id == $variation->size_id ? 'selected' : '' }}>{{ $size->name }}</option>
                                    @endforeach
                                </select>
                                @error('size_id')
                                    @include('dashboard.partials._validation-alert')
                                @enderror
                            </td>
                            <td class="col-sm-4">
                                <select class="custom-select" name="color_id">
                                    <option selected value="">{{ __('Select Color') }}</option>
                                    @foreach ($colors as $color )
                                        <option value="{{ $color->id }}" {{ $color->id == $variation->color_id ? 'selected' : '' }}>{{ $color->name }}</option>
                                    @endforeach
                                </select>
                                @error('color_id')
                                    @include('dashboard.partials._validation-alert')
                                @enderror
                            </td>
                            <td class="col-sm-3">
                                <input type="text" name="sku" class="form-control" value="{{ $variation->sku }}"/>
                                @error('sku')
                                    @include('dashboard.partials._validation-alert')
                                @enderror
                            </td>
                            <td class="col-sm-3">
                                <input type="number" name="stock" min="0" step="1" class="form-control" value="{{ $variation->stock }}"/>
                                @error('stock')
                                    @include('dashboard.partials._validation-alert')
                                @enderror
                            </td>
                            <td class="col-sm-2">
                                <a class="deleteRow"></a>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>

            <div class="card-footer">
                <button class="btn btn-primary btn-block" type="submit"><i class="fa fa-edit"></i> {{ __('Edit') }}</button>
            </div>
        </form>
    </div>

@endsection

