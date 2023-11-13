@extends('layouts.app')

@section('title')
    {{ $product->title }}
@stop

@section('content')
    <div class="container dark-grey-text mt-5">
        <h1 style="text-align: center;">{{ $product->title }}</h1>
        <!--Grid row-->
        <div class="row wow fadeIn" style="flex-wrap: nowrap">
            <!--Grid column-->
            <div class="col-mb-6 mb-4">
                <div class="row">
                    <div class="col-12">
                        <img src="{{ $product->cover }}" class="img-fluid img-thumbnail" alt="">
                    </div>
                </div>
                @if(empty($product->gallery->images))
                    <div class="row mt-2">
                        @for($i = 0; $i < 4; $i++)
                            <div class="col-3">
                                <img src="https://img.icons8.com/?size=512&id=j1UxMbqzPi7n&format=png" alt=""
                                     class="img-fluid img-thumbnail">
                            </div>
                        @endfor
                    </div>
                @else
                    <div class="row mt-2">
                        @foreach($product->gallery->images as $photo)
                            <div class="col-3">
                                <img src="{{ $photo->path }}" alt="" class="img-fluid img-thumbnail">
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
            <!--Grid column-->

            <!--Grid column-->
            <div class="col-md-6 mb-4">

                <!--Content-->
                <div class="p-4">

                    <div class="mb-3">
                        @foreach($product->categories as $category)
                            <a href="/public/category/show/{{ $category->slug }}">
                                <span class="badge
                                @if ($category->id == 1)
                                    purple
                                    @elseif($category->id == 2)
                                    blue
                                    @elseif($category->id == 3)
                                    red
                                    @elseif($category->id == 4)
                                    yellow
                                    @elseif($category->id == 5)
                                    lime
                                    @elseif($category->id == 6)
                                    cyan
                                    @elseif($category->id == 7)
                                    green
                                @endif
                                    mr-1">{{ $category->name }}</span>
                            </a>
                        @endforeach
                    </div>

                    <p class="lead">
                        <span class="mr-1"></span>
                        <span>${{ $product->price }}</span>
                    </p>
                    <p><span>  Остаток: {{ $product->stock }}</span></p>

                    <div class="card-footer">
            <span class="bridge {{ $product->stock > 0 ? 'badge-success' : 'badge-danger' }}">
                {{ $product->stock > 0 ? 'on stock' : 'not on stock' }}
            </span>
                        @if( $product->stock > 0 )
                            <span style="display: flex; flex-direction: column;">
                <a href="{{ route('cart.add', ['productId' => $product->id]) }}"
                   class="btn btn-sm btn-outline-secondary waves-effect">
                     to cart <i class="fas fa-cart-arrow-down"></i>
                </a>
            </span>
                        @else
                            <span class="float-right"></span>

                        @endif
                    </div>

                    <p class="lead font-weight-bold">Description</p>

                    <p>
                        {{ $product->description }}
                    </p>
                </div>
                <!--Content-->

            </div>
            <!--Grid column-->

        </div>
        <!--Grid row-->

        <hr>

        <!--Grid row-->
        <div class="row d-flex justify-content-center wow fadeIn">

            <!--Grid column-->
            <div class="col-md-6 text-center">

                <h4 class="my-4 h4">Additional information</h4>

                <p>
                    Lorem ipsum dolor sit amet.
                </p>

            </div>
            <!--Grid column-->

        </div>
        <!--Grid row-->

        <!--Grid row-->
        <div class="row wow fadeIn">

            <!--Grid column-->
            <div class="col-lg-4 col-md-12 mb-4">

                <img src="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Products/11.jpg" class="img-fluid"
                     alt="">

            </div>
            <!--Grid column-->

            <!--Grid column-->
            <div class="col-lg-4 col-md-6 mb-4">

                <img src="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Products/12.jpg" class="img-fluid"
                     alt="">

            </div>
            <!--Grid column-->

            <!--Grid column-->
            <div class="col-lg-4 col-md-6 mb-4">

                <img src="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Products/13.jpg" class="img-fluid"
                     alt="">

            </div>
            <!--Grid column-->
        </div>
    </div>
@stop
