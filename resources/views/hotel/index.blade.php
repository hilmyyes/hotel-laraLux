{{-- ini adalah index hotel
<a href="{{ route('hotel.create') }}"> klik ini untuk lanjut ke create controller</a>


<ul>
    @foreach ($hotels as $i)
        <li>{{ $i->name }}</li>
    @endforeach
</ul> --}}


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
            <h2>HOTELS</h2>
            <p>this all data from “Hotels” Table</p>
            <a class="btn btn-warning" data-toggle="modal" href="#disclaimer">Disclaimer</a>

            <table class="table table-striped">
                <thead>
                    <tr>
                        {{-- <th>ID</th> --}}
                        <th>Image</th>
                        <th>Name</th>
                        <td>List Of Product</td>
                        <th>Address</th>
                        <th>Hotel Type</th>
                        <th>City</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($hotels as $hotel)
                        <tr>
                            {{-- <td>{{ $hotel->id }}</td> --}}
                            {{-- <td><img src="{{ $hotel->image }}" alt=""></td> --}}
                            <td><img src="{{ asset('images/' . $hotel->image) }}" alt=""></td>

                            <td>{{ $hotel->name }}</td>

                            <td>
                                @foreach ($hotel->products as $p)
                                    <ul>
                                        <li>{{ $p->name }}</li>
                                    </ul>
                                @endforeach
                                <a class='btn btn-xs btn-info' data-toggle='modal' data-target='#myModal'
                                    onclick='showProducts({{ $hotel->id }})'>Detail</a>
                            </td>

                            <td>{{ $hotel->address }}</td>
                            <td>{{ $hotel->type }}</td>
                            <td>{{ $hotel->city }}</td>


                            {{-- toggle button detail --}}
                            <td>
                                <a class="btn btn-info" href="#detail_{{ $hotel->id }}"
                                    data-toggle="modal">{{ $hotel->name }}</a>

                                <div class="modal fade" id="detail_{{ $hotel->id }}" tabindex="-1" role="basic"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">{{ $hotel->name }}</h4>
                                            </div>
                                            <div class="modal-body">
                                                <img src="{{ asset('images/' . $hotel->image) }}" height='200px' />
                                                <h3><b>ALAMAT :{{ $hotel->address }}</b></h3>
                                                <h3><b>TIPE HOTEL: {{ $hotel->type }}</b></h3>
                                                <h3><b>CITY: {{ $hotel->city }}</b></h3>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default"
                                                    data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </body>

    </html>

    <div class="modal fade" id="disclaimer" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">DISCLAIMER</h4>
                </div>
                <div class="modal-body">
                    Pictures shown are for illustration purpose only. Actual product may vary due to product enhancement.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="myModal" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog modal-wide">
            <div class="modal-content" id="showproducts">
                <img src="https://media.giphy.com/media/3oEjI6SIIHBdRxXI40/giphy.gif" alt="Loading..."
                    style="width: 100px;">
                <p>Loading...</p>
            </div>
        </div>
    </div>
@endsection


@section('javascript')
    <script>
        function showProducts(category_id) {
            $.ajax({
                type: 'POST',
                url: '{{ route('hotel.showProducts') }}',
                data: {
                    '_token': '<?php echo csrf_token(); ?>',
                    'hotel_id': category_id
                },
                success: function(data) {
                    $('#showproducts').html(data.msg)
                }
            });
        }
    </script>
@endsection
