@extends('layouts.admin')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Hotel</h1>
        @if (@session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif
        <a class="btn btn-success" href="{{ route('hotel.create') }}">+ New Hotel</a>

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
                                <th>Image</th>
                                <th>Name</th>
                                <th>List Product</th>
                                <th>Address</th>
                                <th>Hotel Type</th>
                                <th>City</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>List Product</th>
                                <th>Address</th>
                                <th>Hotel Type</th>
                                <th>City</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($hotels as $hotel)
                                <tr>
                                    <td>
                                        <img height="100px" src="{{ asset('images/' . $hotel->image) }}" /><br>
                                        <a href="{{ url('hotel/uploadPhoto/' . $hotel->id) }}">
                                            <button class="btn btn-xs btn-default">Upload</button>
                                        </a>
                                    </td>
                                    <td>{{ $hotel->name }}</td>


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
                                            data-toggle="modal">Detail</a>
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

                                        <form method="POST" action="{{ route('hotel.destroy', $hotel->id) }}"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <input type="submit" value="Delete" class="btn btn-danger"
                                                onclick="return confirm('Are you sure to delete {{ $hotel->id }} - {{ $hotel->name }} ? ');">
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
