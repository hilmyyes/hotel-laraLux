@extends('layout.frontend')
@section('content')
    <div class="product-detail">
        <div class="container-fluid">
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
                                        @forelse ($transaction->products as $t)
                                            <tr>
                                                <td class="text-center">{{ $t->name }}</td>
                                                <td class="align-middle">
                                                    <div class="img d-flex justify-content-center align-items-center">
                                                        @if ($t->image == null)
                                                            <img src="{{ asset('images/blank.jpg') }}" alt="Default Image"
                                                                class="img-fluid">
                                                        @else
                                                            <img src="{{ asset('images/' . $t->image) }}"
                                                                alt="{{ $t->name }} Image" class="img-fluid">
                                                        @endif
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    {{ date('d/m/Y', strtotime($t->checkin_date)) }}</td>
                                                <td class="text-center">
                                                    {{ date('d/m/Y', strtotime($t->checkin_date)) }}</td>
                                                </td>
                                                <td class="text-center">
                                                    {{ 'Rp ' . number_format($t->subtotal, 2) }}
                                                </td>
                                                <td class="text-center">
                                                    {{ 'Rp ' . number_format($t->subtotal * 1.11, 2) }}
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
