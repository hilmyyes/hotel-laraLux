@extends('layout.frontend')
@section('content')
    <div class="product-detail">
        <div class="container-fluid">
            <strong>
                <h1>TRANSACTION DETAIL</h1>
                <h4>User: {{ Auth::User()->name }}</h4>
                <h4>Transaction ID: {{ $transaction->id }}</h4><br>
                <div class="cart-btn d-flex ">
                    <a class="btn btn-xs" href="{{ route('laporan') }}">Go Back to History</a>
                </div>
                <br>
            </strong>
            <div class="row">
                <div class="col-lg-8">
                    <div class="product-detail-top">
                        <div class="row align-items-center">
                            <div class="col-md-12">
                                <table class="table table-bordered">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th class="text-center">Product Name</th>
                                            <th class="text-center">Product Image</th>
                                            <th class="text-center">Check-in Date</th>
                                            <th class="text-center">Check-out date</th>
                                            <th class="text-center">Sub Total (ex.Tax)</th>
                                            <th class="text-center">Sub Total (inc.Tax)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($transaction->products as $product)
                                            <tr>
                                                <td class="text-center">{{ $product->name }}</td>
                                                <td class="align-middle">
                                                    <div class="img d-flex justify-content-center align-items-center">
                                                        @if ($product->image == null)
                                                            <img src="{{ asset('images/blank.jpg') }}" alt="Default Image"
                                                                class="img-fluid">
                                                        @else
                                                            <img src="{{ asset('images/' . $product->image) }}"
                                                                alt="{{ $product->name }} Image" class="img-fluid">
                                                        @endif
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    {{ date('d/m/Y', strtotime($product->pivot->checkin_date)) }}
                                                </td>
                                                <td class="text-center">
                                                    {{ date('d/m/Y', strtotime($product->pivot->checkin_date)) }}
                                                </td>
                                                <td class="text-center">
                                                    {{ 'Rp ' . number_format($product->pivot->subtotal, 2) }}
                                                </td>
                                                <td class="text-center">
                                                    {{ 'Rp ' . number_format($product->pivot->subtotal * 1.11, 2) }}
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="3"></td>
                                            <td colspan="2" class="text-left"><strong>Total Rooms Cost (exc. Tax &
                                                    Points)</strong></td>
                                            <td><strong>{{ 'Rp ' . number_format($transaction->products->sum('pivot.subtotal'), 2) }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"></td>
                                            <td colspan="2" class="text-left"><strong>Value Points Redeemed</strong></td>
                                            <td><strong>{{ '-' . number_format($transaction->points_redeemed * 100000, 2) }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"></td>
                                            <td colspan="2" class="text-left"><strong>Tax (11%)</strong>
                                            </td>
                                            <td><strong>{{ 'Rp ' . number_format((($transaction->products->sum('pivot.subtotal') - $transaction->points_redeemed * 100000) * 11) / 100, 2) }}</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"></td>
                                            <td colspan="2" class="text-left"><strong>Points Earned:</strong>
                                            </td>
                                            <td><strong>{{ '+' . floor(($transaction->products->sum('pivot.subtotal') - $transaction->points_redeemed * 100000) / 300000) }}</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"></td>
                                            <td colspan="2" class="text-left"><strong>Due Amount</strong></td>
                                            <td>
                                                <strong>{{ 'Rp ' . number_format($transaction->products->sum('pivot.subtotal') - $transaction->points_redeemed * 100000 + (($transaction->products->sum('pivot.subtotal') - $transaction->points_redeemed * 100000) * 11) / 100, 2) }}</strong>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div><br>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
