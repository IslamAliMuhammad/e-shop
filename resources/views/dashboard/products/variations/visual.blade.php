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

                <li class="breadcrumb-item active">{{ __('Visual') }}</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.container-fluid -->
@endsection

@section('content')

@include('dashboard.partials._success-alert')

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="card card-solid">
        <div class="card-body">
            <div class="row">

                {{-- Images --}}
                @if ($mediaItems->isNotEmpty())
                    <div class="col-12 col-sm-6">
                        <div class="col-12">
                            <img src="{{ $mediaItems[0]->getFullUrl() }}" class="product-image" alt="Product Image"
                                width="100px">
                        </div>
                        <div class="col-12 product-image-thumbs">
                            @foreach ($mediaItems as $index => $mediaItem)
                            <div class="product-image-thumb {{ $index == 0 ? 'active' : '' }}"><img
                                    src="{{ $mediaItem->getFullUrl() }}" alt="Product Image"></div>
                            @endforeach

                        </div>
                    </div>
                @endif
                {{-- images --}}

                <div class="col-12 col-sm-6">

                    <div class="product-header">
                        <h3 class="my-3">{{ $product->name }}</h3>
                        <p>{{ $product->description }}</p>
                    </div>

                    <hr>

                    <div class="product-colors">
                        <h4>{{ __('Available Colors') }}</h4>

                        <div class="flex-row flex-wrap btn-group btn-group-toggle d-flex" data-toggle="buttons">
                            @foreach ($variations as $variation)
                            <label class="text-center btn btn-default active">
                                <input type="radio" name="color_option" id="color_option_a1" autocomplete="off" checked>
                                {{ $variation->color->name }}
                                <br>
                                <i class="fas fa-circle fa-2x text-{{ strtolower($variation->color->name) }}"></i>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="product-sizes">
                        <h4 class="mt-3">Size</h4>
                        @foreach ($variations as $variation)
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <label class="text-center btn btn-default">
                                    <input type="radio" name="color_option" id="color_option_b1" autocomplete="off">
                                    <span class="text-xl">{{ $variation->size->name }}</span>

                                </label>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>

            <div class="product-footer">
                <div class="mt-4 row">
                    <nav class="w-100">
                        <div class="nav nav-tabs" id="product-tab" role="tablist">
                            <a class="nav-item nav-link active" id="product-desc-tab" data-toggle="tab" href="#product-desc"
                                role="tab" aria-controls="product-desc" aria-selected="true">Description</a>
                            <a class="nav-item nav-link" id="product-reviews-tab" data-toggle="tab"
                                href="#product-reviews" role="tab" aria-controls="product-reviews"
                                aria-selected="false">Reviews</a>
                            <a class="nav-item nav-link" id="product-rating-tab" data-toggle="tab" href="#product-rating"
                                role="tab" aria-controls="product-rating" aria-selected="false">Rating</a>
                        </div>
                    </nav>
                    <div class="p-3 tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="product-desc" role="tabpanel"
                            aria-labelledby="product-desc-tab">
                            <p>{{ $product->description }}</p>

                        </div>
                        <div class="tab-pane fade" id="product-reviews" role="tabpanel"
                            aria-labelledby="product-reviews-tab"> Vivamus rhoncus nisl sed venenatis luctus. Sed
                            condimentum risus ut tortor feugiat laoreet. Suspendisse potenti. Donec et finibus sem, ut
                            commodo lectus. Cras eget neque dignissim, placerat orci interdum, venenatis odio. Nulla turpis
                            elit, consequat eu eros ac, consectetur fringilla urna. Duis gravida ex pulvinar mauris ornare,
                            eget porttitor enim vulputate. Mauris hendrerit, massa nec aliquam cursus, ex elit euismod
                            lorem, vehicula rhoncus nisl dui sit amet eros. Nulla turpis lorem, dignissim a sapien eget,
                            ultrices venenatis dolor. Curabitur vel turpis at magna elementum hendrerit vel id dui.
                            Curabitur a ex ullamcorper, ornare velit vel, tincidunt ipsum. </div>
                        <div class="tab-pane fade" id="product-rating" role="tabpanel" aria-labelledby="product-rating-tab">
                            Cras ut ipsum ornare, aliquam ipsum non, posuere elit. In hac habitasse platea dictumst. Aenean
                            elementum leo augue, id fermentum risus efficitur vel. Nulla iaculis malesuada scelerisque.
                            Praesent vel ipsum felis. Ut molestie, purus aliquam placerat sollicitudin, mi ligula euismod
                            neque, non bibendum nibh neque et erat. Etiam dignissim aliquam ligula, aliquet feugiat nibh
                            rhoncus ut. Aliquam efficitur lacinia lacinia. Morbi ac molestie lectus, vitae hendrerit nisl.
                            Nullam metus odio, malesuada in vehicula at, consectetur nec justo. Quisque suscipit odio velit,
                            at accumsan urna vestibulum a. Proin dictum, urna ut varius consectetur, sapien justo porta
                            lectus, at mollis nisi orci et nulla. Donec pellentesque tortor vel nisl commodo ullamcorper.
                            Donec varius massa at semper posuere. Integer finibus orci vitae vehicula placerat. </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

</section>
<!-- /.content -->
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $(".deleteForm").on("submit", function(e) {
            return confirm("Do you want to delete this variation?");

        });

        $('.product-image-thumb').on('click', function () {
            var $image_element = $(this).find('img')
            $('.product-image').prop('src', $image_element.attr('src'))
            $('.product-image-thumb.active').removeClass('active')
            $(this).addClass('active')
        })
    })
</script>
@endsection
