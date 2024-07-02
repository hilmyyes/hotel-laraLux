@extends('layout.frontend')

@section('content')
    <style>
        .full-width-button {
            width: 100%;
            display: inline-block;
            text-align: center;
        }
    </style>

    <div class="row">
        <div class="col-lg-8">
            <div class="cart-page-inner">
                <div class="table-responsive">
                    @php
                        $total = 0;
                    @endphp

                    <table class="table table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th>Product</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Check In / Check Out Date</th>
                                <th>Total</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody class="align-middle">
                            @if (session('cart'))
                                @foreach (session('cart') as $item)
                                    <tr>
                                        <td>
                                            <div class="img">
                                                @if ($item['photo'] == null)
                                                    <a href="#"><img src="{{ asset('images/blank.jpg') }}"
                                                            alt="Image"></a>
                                                @else
                                                    <a href="#"><img src="{{ asset('images/' . $item['photo']) }}"
                                                            alt="Image"></a>
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            <p>{{ $item['name'] }}</p>
                                        </td>
                                        <td>{{ 'Rp ' . $item['price'] }}</td>

                                        <td>
                                            <input type="text" name="daterange_{{ $item['id'] }}"
                                                data-checkin_date="{{ $item['checkin_date'] }}"
                                                data-duration="{{ $item['duration'] }}">

                                        </td>

                                        <td>{{ 'Rp ' . $item['duration'] * $item['price'] }}</td>
                                        <td><a class="btn btn-xs full-width-button"
                                                href="{{ route('delFromCart', $item['id']) }}"><i
                                                    class="fa fa-trash"></i></a></td>
                                    </tr>
                                    @php
                                        $total += $item['duration'] * $item['price'];
                                    @endphp
                                @endforeach
                                <tr>
                                    <td colspan="6">
                                        <a class="btn btn-xs full-width-button"
                                            href="{{ route('laralux.deleteAllCart') }}">Delete All Cart</a>
                                    </td>
                                </tr>
                            @else
                                <tr>
                                    <td colspan="6">
                                        <p>Tidak ada item di cart.</p>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="cart-page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <div class="coupon">
                            <input type="number" min="0" max="{{ Auth::user()->points }}" value="0"
                                name="points" id="points" oninput="updateTotal()">
                        </div>
                    </div><br><br>
                    <div class="col-md-12">
                        <h1>Cart Summary</h1>
                    </div>
                    <div class="col-md-12">
                        <div class="cart-summary">
                            <div class="customer-details">
                                <table class="table">
                                    <tr>
                                        <th scope="row">Total Rooms Cost (exc. Tax)</th>
                                        <td>
                                            <p>{{ 'Rp ' . number_format($total, 2) }}</p>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th scope="row">Value of Points Redeemed (exc. Tax)</th>
                                        <td id="pointsValue"></td>
                                    </tr>

                                    <tr>
                                        <th scope="row">Tax (11%)</th>
                                        <td>
                                            <p>{{ 'Rp ' . number_format(($total * 11) / 100, 2) }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Points Earned:</th>
                                        <td>
                                            <p>
                                                {{ '+ ' . number_format($total / 300000) }}
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Due Amount</th>
                                        <td>
                                            <p>
                                                <b>{{ 'Rp ' . number_format($total + ($total * 11) / 100 + ($total * 3) / 100, 2) }}</b>
                                            </p>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="cart-btn d-flex ">
                                <a class="btn btn-xs" href="{{ route('laralux.index') }}">Continue Shopping</a>
                                <a class="btn btn-xs mr-5" href="{{ route('laralux.checkout') }}"
                                    style="margin-left: 155px">Checkout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(function() {
            $('input[name^="daterange_"]').each(function() {
                var $this = $(this);
                var startDate = $(this).data('checkin_date');
                var duration = parseInt($(this).data('duration'));

                $this.daterangepicker({
                    opens: 'left',
                    startDate: moment(startDate, 'DD-MM-YYYY'),
                    minDate: moment(),
                    endDate: moment(startDate, 'DD-MM-YYYY').add(duration, 'days'),
                    locale: {
                        format: 'DD-MM-YYYY'
                    }
                }, function(start, end) {
                    var id = $(this.element).attr('name').split('_')[1];

                    var startDate = start.format('DD-MM-YYYY');
                    var duration = end.diff(start, 'days');
                    var endDate = start.clone().add(duration, 'days').format('DD-MM-YYYY');

                    console.log("A new date selection was made for ID " + id + ": " + startDate +
                        ' to ' + endDate + ', with duration of ' + duration + ' days.');

                    $.ajax({
                        type: 'POST',
                        url: '{{ route('editCheckIn') }}',
                        data: {
                            '_token': '{{ csrf_token() }}',
                            'id': id,
                            'checkin_date': startDate,
                            'duration': duration,
                        },
                        success: function(data) {
                            location.reload();
                        }
                    });
                });
            });
        });

        function updateTotal() {
            var points = document.getElementById('points').value;
            var valueRedeemed = points * 100000;

            document.getElementById('pointsValue').textContent = ' - Rp ' + valueRedeemed;
        }
    </script>
@endsection
