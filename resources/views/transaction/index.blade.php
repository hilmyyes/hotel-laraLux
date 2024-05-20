@extends('layout.conquer')

@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <title>Bootstrap Example</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    </head>

    <body>

        <div class="container">
            <h2>DATA TRANSACTION</h2>
            <p>this all data from transaction table</p>
            <a class="btn btn-success" href="{{ route('transaction.create') }}">+ new transaction</a>
            @if (@session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Customer</th>
                        <th>Kasir</th>
                        <th>Tanggal Transaction</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $d)
                        <tr>
                            <td>{{ $d->id }}</td>
                            <td>{{ $d->customer->name }}</td>
                            <td>{{ $d->user->name }}</td>
                            <td>{{ $d->created_at }}</td>
                            <td><a class="btn btn-default" data-toggle="modal" href="#myModal"
                                    onclick="getDetailData({{ $d->id }});">Lihat Rincian Pembelian</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </body>

    </html>

    <div class="modal fade" id="myModal" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog modal-wide">
            <div class="modal-content" id="msg">
                <img src="https://media.giphy.com/media/3oEjI6SIIHBdRxXI40/giphy.gif" alt="Loading..."
                    style="width: 100px;">
                <p>Loading...</p>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        function getDetailData(id) {
            $.ajax({
                type: 'POST',
                url: '{{ route('transaction.showAjax') }}',
                data: '_token= <?php echo csrf_token(); ?> &id=' + id,
                success: function(data) {
                    $("#msg").html(data.msg);
                }
            });
        }
    </script>
@endsection
