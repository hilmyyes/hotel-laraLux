@extends('layout.frontend')

@section('content')
    <div class="product-view">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="product-view-top">
                                <div class="row">
                                    @foreach ($products as $p)
                                        <div class="col-md-4">
                                            <div class="product-item">
                                                <div class="product-title">
                                                    <a href="{{ route('laralux.show', $p->id) }}">{{ $p->name }}</a>
                                                    <div class="ratting">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                </div>
                                                <div class="product-image">
                                                    <a href="product-detail.html">
                                                        @if ($p->image == null)
                                                            <img src="{{ asset('images/blank.jpg') }}">
                                                        @else
                                                            <img src="{{ asset('images/' . $p->image) }}" alt="Product Image">
                                                        @endif
                                                    </a>
                                                    <div class="product-action">
                                                        <a href="{{ route('addCart', $p->id) }}"><i class="fa fa-cart-plus"></i></a>
                                                        <a href="#"><i class="fa fa-heart"></i></a>
                                                        <a href="#"><i class="fa fa-search"></i></a>
                                                    </div>
                                                </div>
                                                <div class="product-price">
                                                    <h3><span>Rp </span>{{ $p->price }}</h3>
                                                    <a class="btn" href="{{ route('addCart', $p->id) }}"><i
                                                            class="fa fa-shopping-cart"></i>Add To Cart</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endsection
