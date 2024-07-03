@extends('layout.conquer')

@section('content')
    <div class="container">
        <h1><b>TRANSACTION</b></h1>

        <div style="display: flex; align-items: center; padding: 10px;">
            <div>
                <label>Employee Name:</label>
                <input type="text" id="employeeName" value="{{ Auth::user()->name }}" readonly
                    style="background-color: #c3c9cd; border: 1px solid #ccc;">
            </div>
            <div>
                <labe>Date:</labe>
                <input type="text" id="date" value="{{ Auth::user()->created_at }}" readonly
                    style="background-color: #c3c9cd; border: 1px solid #ccc;">
            </div>
        </div>


        <a class="btn btn-success" href="{{ route('transaction.create') }}">+ new transaction</a>
        {{-- <a href="#modalCreate" data-toggle="modal" class="btn btn-info">+ New Type (with Modals)</a> --}}
        @if (@session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tanggal Transaction</th>
                    <th>Customer</th>
                    <th>Hotel</th>
                    <th>Produk</th>
                    <th>Tanggal check_in</th>
                    <th>Durasi</th>
                    <th>Total Harga</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transaction as $d)
                    <tr id="tr_{{ $d->id }}">
                        <td>{{ $d->id }}</td>
                        <td>{{ $d->created_at }}</td>
                        <td>{{ $d->user->name }}</td>
                        <td>
                            <ul>
                                @foreach ($d->products as $product)
                                    <li>
                                        {{ $product->hotel->name }}
                                    </li>
                                @endforeach
                            </ul>

                        </td>
                        <td>
                            <ul>
                                @foreach ($d->products as $product)
                                    <li>
                                        {{ $product->name }}
                                    </li>
                                @endforeach
                            </ul>
                        </td>
                        <td>
                            <ul>
                                @foreach ($d->products as $product)
                                    <li>
                                        {{ $product->pivot->checkin_date }}
                                    </li>
                                @endforeach
                            </ul>
                        </td>
                        <td>
                            <ul>
                                @foreach ($d->products as $product)
                                    <li>
                                        {{ $product->pivot->duration }}
                                    </li>
                                @endforeach
                            </ul>

                        </td>
                        <td>
                            <ul>
                                @foreach ($d->products as $product)
                                    <li>
                                        IDR.
                                        {{ number_format($product->pivot->subtotal, 2, ',', '.') }}
                                    </li>
                                @endforeach
                            </ul>
                            <hr>
                            <strong>IDR. {{ number_format($d->total_price, 2, ',', '.') }}</strong>

                        </td>

                        <td>
                            {{-- <a class="btn btn-success" data-toggle="modal" href="#myModal"
                                onclick="getDetailData({{ $d->id }})"> Rincian Pembelian</a> --}}
                            <a class="btn btn-warning" href="{{ route('transaction.edit', $d->id) }}">Edit</a>
                            {{-- <a href="#modalEditA" class="btn btn-warning
                            " data-toggle="modal"
                                onclick="getEditForm({{ $d->id }})">Edit</a> --}}
                            {{-- <a href="#" value="DeleteNoReload" class="btn btn-danger"
                                onclick="if(confirm('Are you sure to delete {{ $d->id }} - {{ $d->name }} ? ')) deleteDataRemoveTR({{ $d->id }})">Delete
                                without Reload</a> --}}
                            <form method="POST" action="{{ route('transaction.destroy', $d->id) }}"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <input type="submit" value="delete" class="btn btn-danger"
                                    onclick="return confirm('Are you sure to delete {{ $d->id }} - {{ $d->name }} ? ');">
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- Detail Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog modal-wide">
            <div class="modal-content" id="msg">
                <img src="https://media.giphy.com/media/3oEjI6SIIHBdRxXI40/giphy.gif" alt="Loading..."
                    style="width: 100px;">
                <p>Loading...</p>
            </div>
        </div>
    </div>

    <!-- Edit Modal A -->
    <div class="modal fade" id="modalEditA" tabindex="-1" role="basic" aria-hidden="true">
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
        // function getDetailData(id) {
        //     $.ajax({
        //         type: 'POST',
        //         url: '{{ route('transaction.showAjax') }}',
        //         data: '_token= <?php echo csrf_token(); ?> &id=' + id,
        //         success: function(data) {
        //             $("#msg").html(data.msg);
        //         }
        //     });
        // }

        function getEditForm(transaction_id) {
            $.ajax({
                type: 'POST',
                url: '{{ route('transaction.getEditForm') }}',
                data: {
                    '_token': '<?php echo csrf_token(); ?>',
                    'id': transaction_id
                },
                success: function(data) {
                    $('#modalContent').html(data.msg)
                }
            });
        }

        // function deleteDataRemoveTR(transaction_id) {
        //     $.ajax({
        //         type: 'POST',
        //         url: '{{ route('transaction.deleteData') }}',
        //         data: {
        //             '_token': '<?php echo csrf_token(); ?>',
        //             'id': transaction_id
        //         },
        //         success: function(data) {
        //             if (data.status == "oke") {
        //                 $('#tr_' + transaction_id).remove();
        //             }
        //         }
        //     });
        // }

        // Fungsi untuk mendapatkan waktu saat ini dalam format yang diinginkan
        function updateTime() {
            var currentDate = new Date();
            var formattedDate = currentDate.getFullYear() + '-' +
                String(currentDate.getMonth() + 1).padStart(2, '0') + '-' +
                String(currentDate.getDate()).padStart(2, '0');
            var formattedTime = String(currentDate.getHours()).padStart(2, '0') + ':' +
                String(currentDate.getMinutes()).padStart(2, '0') + ':' +
                String(currentDate.getSeconds()).padStart(2, '0');
            return formattedDate + ' ' + formattedTime;
        }

        // Mendapatkan elemen input date
        var dateInput = document.getElementById('date');

        // Mengatur nilai input pertama kali
        dateInput.value = updateTime();

        // Memperbarui nilai input setiap detik
        setInterval(function() {
            dateInput.value = updateTime();
        }, 1000);
    </script>
    <script>
        $(document).ready(function() {
            // Event listener for duration input changes
            $('.duration-input').on('input', function() {
                updateSubtotal($(this));
            });

            // Function to update subtotal based on duration and product price
            function updateSubtotal(input) {
                var duration = input.val();
                var productId = input.closest('.product-block').attr('id').split('_')[1];
                var price = $('select[name="products[' + productId + '][product]"] option:selected').data('price');
                var subtotal = duration * price;
                $('input[name="products[' + productId + '][subtotal]"]').val(subtotal.toFixed(2));
            }

            // Initialize subtotal values on page load
            $('.duration-input').each(function() {
                updateSubtotal($(this));
            });
        });
    </script>
@endsection
