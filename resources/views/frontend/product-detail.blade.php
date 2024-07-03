@extends('layout.frontend')
@section('content')
    <div class="product-detail">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8">
                    <div class="product-detail-top">
                        <div class="row align-items-center">
                            <div class="col-md-5">
                                <div class="slider-nav-img">
                                    @if ($product->image == null)
                                        <img height="300" src="{{ asset('images/blank.jpg') }}">
                                    @else
                                        <img height="300" src="{{ asset('images/' . $product->image) }}"
                                            alt="Product Image">
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="product-content">
                                    <div class="title">
                                        <h2>{{ $product->name }}</h2>
                                    </div>
                                    <div class="ratting">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <div class="price">
                                        <h4>Price:</h4>
                                        <p>{{ 'Rp ' . number_format($product->price, 2) }}</p>
                                    </div>
                                    <div><strong><a
                                                href="{{ route('laralux.hotel', $product->hotel_id) }}"><i>Link to Hotel {{ $hotel->name }}</i></a></strong>
                                    </div><br>
                                    <div>
                                        <strong>Facilities:</strong>
                                        <ul>
                                            @foreach ($productFacilities as $facility)
                                                <li>{{ $facility->name }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="action">
                                        <a class="btn" href="{{ route('addCart', $product->id) }}"><i
                                                class="fa fa-shopping-cart"></i>Add to Cart</a>
                                        <a class="btn" href="{{ route('shop', $product->id) }}"><i
                                                class="fa fa-shopping-bag"></i>Buy Now</a>
                                    </div>
                                </div>
                            </div>
                        </div><br>
                        <div>
                            <h5>ROOMS ALSO FROM {{ $hotel->name }}:</h5><br>
                        </div>
                        <div class="row">
                            @foreach ($productSimilar as $p)
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
                                            @if ($p->image == null)
                                                <img src="{{ asset('images/blank.jpg') }}">
                                            @else
                                                <img src="{{ asset('images/' . $p->image) }}" alt="Product Image">
                                            @endif
                                            <div class="product-action">
                                                <a href="{{ route('laralux.show', $p->id) }}"><i
                                                        class="fa fa-search"></i></a>
                                                <a href="{{ route('addCart', $p->id) }}"><i
                                                        class="fa fa-cart-plus"></i></a>
                                                <a href="{{ route('shop', $p->id) }}"><i
                                                        class="fa fa-shopping-bag"></i></a>
                                            </div>
                                        </div>
                                        <div class="product-price">


                                            <h3>
                                                <td>{{ 'Rp ' . number_format($p->price, 2) }}</td>
                                            </h3>
                                            {{-- <a class="btn" href="{{ route('addCart', $p->id) }}"><i
                                                class="fa fa-shopping-cart"></i>Add To Cart</a> --}}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
