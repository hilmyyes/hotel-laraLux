@extends('layout.frontend')
@section('content')
    <div class="product-detail">
        <div class="container-fluid">
            <strong>
                <h1>TRANSACTION HISTORY</h1>
                <h4>User: {{ Auth::User()->name }}</h4>
                <br>
            </strong>
            <div class=<div class="row">
                <div class="col-lg-8">
                    <div class="product-detail-top">
                        <div class="row align-items-center">
                            <div class="col-md-12">
                                <table class="table table-bordered">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th class="text-center">Transaction ID</th>
                                            <th class="text-center">Transaction Date</th>
                                            <th class="text-center">Total (exc. Tax & Points)</th>
                                            <th class="text-center">Tax</th>
                                            <th class="text-center">Points Redeemed</th>
                                            <th class="text-center">Total (inc. Tax & Points)</th>
                                            <th class="text-center">Points Earned</th>
                                            <th class="text-center">Details</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($transactions as $t)
                                            <tr>
                                                <td class="text-center">{{ $t['id'] }}</td>
                                                <td class="text-center">
                                                    {{ date('d/m/Y', strtotime($t['transaction_date'])) }}</td>
                                                <td class="text-center">
                                                    {{ 'Rp ' . number_format($t->products->sum('pivot.subtotal'), 2) }}
                                                </td>
                                                <td class="text-center">
                                                    {{ 'Rp ' . number_format($t->products->sum('pivot.subtotal') * 0.11, 2) }}
                                                </td>
                                                <td class="text-center">
                                                    @if ($t['points_redeemed'] > 0)
                                                        {{ 'Rp ' . number_format($t['points_redeemed'] * 100000, 2) . ' ( ' . $t['points_redeemed'] . ' points )' }}
                                                    @else
                                                        -
                                                    @endif
                                                </td>

                                                <td class="text-center">
                                                    {{ 'Rp ' . number_format($t->products->sum('pivot.subtotal') * 1.11 - $t['points_redeemed'] * 100000, 2) }}
                                                </td>

                                                @if ($t['points_earned'] > 0)
                                                    <td class="text-center">{{ '+' . $t['points_earned'] }}</td>
                                                @else
                                                    <td class="text-center">-</td>
                                                @endif
                                                <td class="text-center">
                                                    <a href="{{ route('detail', $t->id) }}"><i class="fa fa-search"></i></a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center">No transaction in history</td>
                                            </tr>
                                        @endforelse
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
