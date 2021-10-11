@extends('layout.master')

@section('content')
    <div class="container">
        <div class="row mt-5">
            @if(isset($products) && !empty($products))

                <div id="products-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">

                        @foreach($products->data as $product)
                            <div class="carousel-item @if($loop->iteration == 1) active @endif">
                                <img class="w-100 main-image" src="{{$product?->main_image}}"
                                     alt="Main image">

                                <img class=" w-100 hidden alt-image"
                                     src="{{$product?->images[(count($product?->images) > 1) ? rand(1, count($product?->images)-1) : 0]}}"
                                     alt="Alt image">

                                <div class="carousel-caption d-none d-md-block">
                                    <h5>{{$product->name}}</h5>
                                    <p>{{substr($product->description,0,30)}}<span
                                                class="hidden description">{{substr($product->description,30)}}</span></p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev bg-dark" href="#" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next bg-dark" href="#" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            @else
                <div class="col-12">
                    <div class="alert alert-warning" role="alert">
                        Nie udało się pobrać produktów.
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

@section('bottomScripts')
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

    <script>
        $('#products-carousel').carousel({
            interval: 5000
        }).on('mouseenter', function () {
            $('.main-image').hide();
            $('.alt-image').show();
            $('.description').show(50000);
        }).on('mouseleave', function () {
            $('.alt-image').hide();
            $('.description').hide(50000);
            $('.main-image').show();
        });

        $('.carousel-control-next').on('click', function () {
            $('#products-carousel').carousel('next')
        });
        $('.carousel-control-prev').on('click', function () {
            $('#products-carousel').carousel('prev')
        })

    </script>
@endsection