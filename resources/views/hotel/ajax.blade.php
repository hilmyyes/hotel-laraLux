@extends('layout.conquer')

@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <title>Hotels List</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    </head>

    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <a class="btn btn-success" href="{{ route('hotel.create') }}">+ New Hotel</a>
                    <h2>Hotels</h2>
                    <p>All data from the "Hotels" Table</p>
                    @if (session('status'))
                        <div class="alert alert-success">{{ session('status') }}</div>
                    @endif
                    <a class="btn btn-warning" data-toggle="modal" href="#disclaimer">Disclaimer</a>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Logo</th>
                                <th>List Product</th>
                                <th>Address</th>
                                <th>Hotel Type</th>
                                <th>City</th>
                                <th>Detail</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($hotels as $hotel)
                                <tr>
                                    <td>{{ $hotel->name }}</td>
                                    <td>
                                        <img height="100px" src="{{ asset('images/' . $hotel->image) }}" /><br>
                                        <a href="{{ url('hotel/uploadPhoto/' . $hotel->id) }}">
                                            <button class="btn btn-xs btn-default">Upload</button>
                                        </a>
                                    </td>
                                    <td>
                                        <img height="100px" src="{{ asset('logo/' . $hotel->id . '.jpg') }}" /><br>
                                        <a href="{{ url('hotel/uploadLogo/' . $hotel->id) }}">
                                            <button class="btn btn-xs btn-default">Upload</button>
                                        </a>
                                    </td>
                                    <td>
                                        @foreach ($hotel->products as $p)
                                            <ul>
                                                <li>{{ $p->name }}</li>
                                            </ul>
                                        @endforeach
                                        <a class="btn btn-xs btn-info" data-toggle="modal" data-target="#myModal"
                                            onclick="showProducts({{ $hotel->id }})">Detail</a>
                                    </td>
                                    <td>{{ $hotel->address }}</td>
                                    <td>{{ $hotel->type }}</td>
                                    <td>{{ $hotel->city }}</td>
                                    <td>
                                        <a class="btn btn-info" href="#detail_{{ $hotel->id }}"
                                            data-toggle="modal">{{ $hotel->name }}</a>
                                        <div class="modal fade" id="detail_{{ $hotel->id }}" tabindex="-1"
                                            role="basic" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">{{ $hotel->name }}</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <img src="{{ asset('images/' . $hotel->image) }}" height="200px" />
                                                        <p>Address: {{ $hotel->address }}</p>
                                                        <p>Type: {{ $hotel->type }}</p>
                                                        <p>City: {{ $hotel->city }}</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default"
                                                            data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <a class="btn btn-danger" href="#delete_{{ $hotel->id }}"
                                            data-toggle="modal">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Disclaimer Modal -->
        <div class="modal fade" id="disclaimer" tabindex="-1" role="basic" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">DISCLAIMER</h4>
                    </div>
                    <div class="modal-body">
                        Pictures shown are for illustration purpose only. Actual product may vary due to product
                        enhancement.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Details Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="basic" aria-hidden="true">
            <div class="modal-dialog modal-wide">
                <div class="modal-content" id="showproducts">
                    <img src="https://media.giphy.com/media/3oEjI6SIIHBdRxXI40/giphy.gif" alt="Loading..."
                        style="width: 100px;">
                    <p>Loading...</p>
                </div>
            </div>
        </div>
    </body>

    </html>
@endsection

@section('javascript')
    <script>
        function showProducts(hotel_id) {
            $.ajax({
                type: 'POST',
                url: '{{ route('hotel.showProducts') }}',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'hotel_id': hotel_id
                },
                success: function(data) {
                    $('#showproducts').html(data.msg);
                }
            });
        }
    </script>
@endsection
