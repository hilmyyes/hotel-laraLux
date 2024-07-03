@extends('layouts.admin')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">TRANSACTION</h1>
        @if (@session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif
        <a class="btn btn-success" href="{{ route('transaction.create') }}">+ new Transaction</a>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables </h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
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
                        <tfoot>
                            <tr>
                                <th>Tanggal Transaction</th>
                                <th>Customer</th>
                                <th>Hotel</th>
                                <th>Produk</th>
                                <th>Tanggal check_in</th>
                                <th>Durasi</th>
                                <th>Total Harga</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($transaction as $d)
                                <tr id="tr_{{ $d->id }}">
                                    {{-- <td>{{ $d->id }}</td> --}}
                                    <td>{{ $d->created_at }}</td>
                                    <td>
                                        @if ($d->user)
                                            {{ $d->user->name }}
                                        @else
                                            <span class="text-danger">Pengguna tidak ditemukan untuk ID
                                                transaksi:
                                                {{ $d->id }}</span>
                                        @endif
                                    </td>
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
                                        <strong>IDR.
                                            {{ number_format($d->total_price, 2, ',', '.') }}</strong>

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
                        </tbody>
                    </table>
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
