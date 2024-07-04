@extends('layout.frontend')

@section('content')
    <div class="product-view">

        <div class="container-fluid">
            <strong>
                <h1>ALL HOTELS</h1>
            </strong>
            <div class="row">
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="product-view-top">
                                <div class="row">
                                    @foreach ($hotel as $h)
                                        <div class="col-md-4">
                                            <div class="product-item">
                                                <div class="product-title">
                                                    <a href="{{ route('laralux.hotel', $h->id) }}">{{ $h->name }}</a>
                                                    <div class="ratting">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                </div>
                                                <div class="product-image">
                                                    @if ($h->image == null)
                                                            <img src="{{ asset('images/blank.jpg') }}">
                                                        @else
                                                            <img src="{{ asset('images/' . $h->image) }}"
                                                                alt="Product Image">
                                                        @endif
                                                    <div class="product-action">
                                                        <a href="{{ route('laralux.hotel', $h->id) }}"><i
                                                            class="fa fa-search"></i></a>
                                                    </div>
                                                </div>
                                                <div class="product-price">
                                                    <h3>
                                                        <td>{{$h->products->count().' Rooms available'}}</td>
                                                    </h3>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endsection
