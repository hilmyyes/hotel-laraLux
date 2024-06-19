@extends('layout.conquer')

@section('content')
    <div class="container">
        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif
        <h3 class="page-title">
            Cart
        </h3>
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="index.html">Home</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <a href="#">Example</a>
                </li>
                <li>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="#" onclick="showInfo()">
                        <i class="icon-bulb"></i>
                    </a>
                </li>
            </ul>
            <div class="page-toolbar"> </div>
        </div>

        <form method="POST" action="{{ route('transaction.store') }}">
            @csrf
            <input type="hidden" name="product_data" id="product_data">

            <table class="table" id="Product-Table">
                <thead>
                    <tr>
                        <th>Prod Id</th>
                        <th>Prod Name</th>
                        <th>Image</th>
                        <th>Price</th>
                        <th>Check-In Date</th>
                        <th>Duration</th>
                        <th>Check-Out Date</th>
                        <th>Sub Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($carts as $c)
                        <tr id="tr_{{ $c->id }}">
                            <td>{{ $c->product_id }}</td>
                            <td><a href="{{ route('product.show', $c->product_id) }}">{{ $c->product->name }}</a></td>
                            <td><img src="{{ asset('images/' . $c->product->image) }}" alt=""></td>
                            <td>{{ $c->product->price }}</td>
                            <td>{{ date('d/m/Y', strtotime($c->checkin_date)) }}</td>
                            <td>{{ $c->duration }}</td>
                            <td>{{ date('d/m/Y', strtotime($c->checkin_date . ' + ' . $c->duration . ' days')) }}</td>
                            <td>{{ $c->subtotal }}</td>
                            <td>
                                <a href="#modalEdit" class="btn btn-info" data-toggle="modal"
                                    onclick="getEditForm({{ $c->id }})">Edit</a>
                            </td>
                            <td> <a href="#" value="DeleteNoReload" class="btn btn-danger"
                                    onclick="if(confirm('Are you sure to delete this cart ? ')) deleteDataRemoveTR({{ $c->id }})">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <button type="submit" class="btn btn-primary">Order</button>
        </form>
    </div>
    <!-- Edit Modal -->
    <div class="modal fade" id="modalEdit" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog modal-wide">
            <div class="modal-content">
                <div class="modal-body" id="modalContent">
                    <img src="https://media.giphy.com/media/3oEjI6SIIHBdRxXI40/giphy.gif" alt="Loading..."
                        style="width: 100px;">
                    <p>Loading...</p>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('javascript')
    <script>
        function getEditForm(cart_id) {
            $.ajax({
                type: 'POST',
                url: '{{ route('cart.getEditForm') }}',
                data: {
                    '_token': '<?php echo csrf_token(); ?>',
                    'id': cart_id
                },
                success: function(data) {
                    $('#modalContent').html(data.msg)
                }
            });
        }

        function deleteDataRemoveTR(cart_id) {
            $.ajax({
                type: 'POST',
                url: '{{ route('cart.deleteData') }}',
                data: {
                    '_token': '<?php echo csrf_token(); ?>',
                    'id': cart_id
                },
                success: function(data) {
                    if (data.status == "oke") {
                        $('#tr_' + cart_id).remove();
                    }
                }
            });
        }
    </script>
@endsection
