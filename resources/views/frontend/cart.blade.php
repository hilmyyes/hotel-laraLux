@extends('layout.frontend')

@section('content')
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
                                <th>Price</th>
                                <th>Check In Date</th>
                                <th>Duration</th>
                                <th>Check Out Date</th>
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
                                                <p>{{ $item['name'] }}</p>
                                            </div>
                                        </td>
                                        <td>{{ 'IDR ' . $item['price'] }}</td>
                                        {{-- <td>
                                            <input type="date" class="form-control" name="checkin_date"
                                                id="checkin_date_{{ $item['id'] }}"
                                                value="{{ date('Y-m-d', strtotime($item['checkin_date'])) }}"
                                                min="{{ date('Y-m-d', strtotime('now')) }}"
                                                onchange="editCheckIn({{ $item['id'] }})"><br>
                                        </td>
                                        <td>
                                            <div class="qty">
                                                <input type="number" value="{{ $item['duration'] }}"
                                                    id="duration_{{ $item['id'] }}" min="1"
                                                    onchange="changeQty({{ $item['id'] }})"> days
                                            </div>
                                        </td> --}}


                                        <td>
                                            <input type="text" name="daterange" minDate="{{ date('Y-m-d') }}" />
                                        </td>


                                        {{-- <td>
                                            {{ date('d/m/Y', strtotime($item['checkin_date'] . ' + ' . $item['duration'] . ' days')) }}
                                        </td> --}}

                                        <td>{{ 'IDR ' . $item['duration'] * $item['price'] }}</td>
                                        <td><a class="btn btn-danger" href="{{ route('delFromCart', $item['id']) }}"><i
                                                    class="fa fa-trash"></i></a></td>
                                    </tr>
                                    @php
                                        $total += $item['duration'] * $item['price'];
                                    @endphp
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5">
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
                            <input type="text" placeholder="Coupon Code">
                            <button>Apply Code</button>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="cart-summary">
                            <div class="cart-content">
                                <h1>Cart Summary</h1>
                                <h2>Grand Total<span>{{ 'IDR ' . $total }}</span></h2>
                            </div>
                            <div class="cart-btn">
                                <a class="btn btn-xs" href="{{ route('laralux.index') }}">Continue Shopping</a>
                                <a class="btn btn-xs" href="{{ route('laralux.checkout') }}">Checkout</a>
                                <a class="btn btn-xs" href="{{ route('laralux.checkout') }}">Generate Receipt</a>
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
            $('input[name="daterange"]').daterangepicker({
                opens: 'left',
                startDate: moment(),
                minDate: moment(),
                locale: {
                    format: 'DD-MM-YYYY'
                }
            }, function(start, end, label) {
                var startDate = start.format('DD-MM-YYYY');
                var endDate = end.format('DD-MM-YYYY');

                $('#checkin_date').val(startDate);

                var duration = end.diff(start, 'days') + 1;
                $('#duration').val(duration);

                console.log("A new date selection was made: " + startDate + ' to ' + endDate);

            });
        });

        function changeQty(id) {
            var newQuan = document.getElementById("duration_" + id).value;

            $.ajax({
                type: 'POST',
                url: '{{ route('changeQuantity') }}',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'id': id,
                    'newQuan': newQuan
                },
                success: function(data) {
                    location.reload();
                }
            });
        }

        function editCheckIn(id) {
            var checkin_date = document.getElementById("checkin_date_" + id).value;

            $.ajax({
                type: 'POST',
                url: '{{ route('editCheckIn') }}',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'id': id,
                    'checkin_date': checkin_date
                },
                success: function(data) {
                    location.reload();
                }
            });
        }

        function UpdateCheckOut(id) {
            var checkInDate = document.getElementById("checkin_date_" + id).value;
            var duration = parseInt(document.getElementById("duration_" + id).value);

            var date = new Date(checkInDate);
            date.setDate(date.getDate() + duration);

            var dd = String(date.getDate()).padStart(2, '0');
            var mm = String(date.getMonth() + 1).padStart(2, '0');
            var yyyy = date.getFullYear();

            var newDate = dd + '/' + mm + '/' + yyyy;
            document.getElementById("checkout_date_" + id).innerText = newDate;
        }
    </script>
@endsection
