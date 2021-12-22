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
                <li class="breadcrumb-item"><a href="{{ route('dashboard.products.index') }}">{{ __('Products') }}</a>
                </li>
                <li class="breadcrumb-item active">{{ __('Create Variations') }}</li>
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
                            <td>{{ ($product->discount) ? $product->discount->name . '%' : '' }}</td>
                        </tr>

                </tbody>
            </table>

        </div>
        <!-- /.card-body -->
    </div>

    <div class="card-body product-variations">
        <form action="{{ route('dashboard.products.variations.store', $product->id) }}" method="POST">

            @csrf

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

                        @if (empty(old()))
                            <tr>
                                <td class="col-sm-4">
                                    <select class="custom-select" name="1[size_id]">
                                        <option selected value="">{{ __('Select Size') }}</option>
                                        @foreach ($sizes as $size )
                                            <option value="{{ $size->id }}">{{ $size->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('1.size_id')
                                        @include('dashboard.partials._validation-alert')
                                    @enderror
                                </td>
                                <td class="col-sm-4">
                                    <select class="custom-select" name="1[color_id]">
                                        <option selected value="">{{ __('Select Color') }}</option>
                                        @foreach ($colors as $color )
                                            <option value="{{ $color->id }}">{{ $color->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('1.color_id')
                                        @include('dashboard.partials._validation-alert')
                                    @enderror
                                </td>
                                <td class="col-sm-3">
                                    <input type="text" name="1[sku]" class="form-control" />
                                    @error('1.sku')
                                        @include('dashboard.partials._validation-alert')
                                    @enderror
                                </td>
                                <td class="col-sm-3">
                                    <input type="number" name="1[stock]" min="0" step="1" class="form-control" />
                                    @error('1.stock')
                                        @include('dashboard.partials._validation-alert')
                                    @enderror
                                </td>
                                <td class="col-sm-2">
                                    <a class="deleteRow"></a>
                                </td>
                            </tr>
                        @else
                            @for ($i = 1; $i < sizeof(old()); $i++)
                                <tr>

                                    <td class="col-sm-4">
                                        <select class="custom-select" name="{{ $i }}[size_id]">
                                            <option selected value="">{{ __('Select Size') }}</option>
                                            @foreach ($sizes as $size )
                                                <option value="{{ $size->id }}" {{ $size->id == old("{$i}.size_id") ? 'selected' : '' }}>{{ $size->name }}</option>
                                            @endforeach
                                        </select>
                                        @error("{$i}.size_id")
                                            @include('dashboard.partials._validation-alert')
                                        @enderror
                                    </td>
                                    <td class="col-sm-4">
                                        <select class="custom-select" name="{{ $i }}[color_id]">
                                            <option selected value="">{{ __('Select Color') }}</option>
                                            @foreach ($colors as $color )
                                                <option value="{{ $color->id }}" {{ $color->id == old("{$i}.color_id") ? 'selected' : '' }}>{{ $color->name }}</option>
                                            @endforeach
                                        </select>
                                        @error("{$i}.color_id")
                                            @include('dashboard.partials._validation-alert')
                                        @enderror
                                    </td>
                                    <td class="col-sm-3">
                                        <input type="text" name="{{ $i }}[sku]" class="form-control" value="{{ old("{$i}.sku") }}"/>
                                        @error("{$i}.sku")
                                            @include('dashboard.partials._validation-alert')
                                        @enderror
                                    </td>
                                    <td class="col-sm-3">
                                        <input type="number" name="{{ $i }}[stock]" min="0" step="1" class="form-control" value="{{ old("{$i}.stock") }}"/>
                                        @error("{$i}.stock")
                                            @include('dashboard.partials._validation-alert')
                                        @enderror
                                    </td>
                                    <td class="col-sm-2">
                                        <a class="deleteRow"></a>
                                    </td>
                                </tr>
                            @endfor
                         @endif
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5" style="text-align: left;">
                                <input type="button" class="btn btn-lg btn-block " id="addrow" value="Add Row" />
                            </td>
                        </tr>
                        <tr>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <button class="btn btn-primary" type="submit">{{ __('Submit') }}</button>
        </form>
    </div>

@endsection

@section('script')
<script>
$(document).ready(function () {
    var counter = 2;

    $("#addrow").on("click", function () {
        var newRow = $("<tr>");
        var cols = "";

        cols += `
                <td class="col-sm-4">
                    <select class="custom-select" name=${counter}[size_id]>
                        <option selected value="">{{ __('Select Size') }}</option>
                        @foreach ($sizes as $size )
                            <option value="{{ $size->id }}">{{ $size->name }}</option>
                        @endforeach
                    </select>
                </td>`;

        cols += `
                <td class="col-sm-4">
                    <select class="custom-select" name=${counter}[color_id]>
                        <option selected value="">{{ __('Select Color') }}</option>
                        @foreach ($colors as $color )
                            <option value="{{ $color->id }}">{{ $color->name }}</option>
                        @endforeach
                    </select>
                </td>`;

        cols += `<td><input type="text" class="form-control" name=${counter}[sku]/></td>`;
        cols += `<td><input type="number" class="form-control" name=${counter}[stock]/></td>`;

        cols += '<td><input type="button" class="ibtnDel btn btn-md btn-danger "  value="Delete"></td>';
        newRow.append(cols);
        $("table.order-list").append(newRow);
        counter++;
    });



    $("table.order-list").on("click", ".ibtnDel", function (event) {
        $(this).closest("tr").remove();
        counter -= 1
    });


});

</script>
@endsection
