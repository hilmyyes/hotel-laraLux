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
                                        <td>{{ 'IDR ' . $item['price'] }}</td>

                                        <td>
                                            <input type="text" name="daterange_{{ $item['id'] }}"
                                                data-checkin_date="{{ $item['checkin_date'] }}"
                                                data-duration="{{ $item['duration'] }}">

                                        </td>

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
