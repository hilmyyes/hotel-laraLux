@extends('layouts.admin')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Facilities</h1>
        @if (@session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif
        <a class="btn btn-success" href="{{ route('facilities.create') }}">+ new</a>
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
                                <th>Name</th>
                                <th>Description</th>

                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($data as $d)
                                <tr id="tr_{{ $d->id }}">
                                    <td id="td_name_{{ $d->id }}">{{ $d->name }}</td>
                                    <td id="td_description_{{ $d->id }}">{{ $d->description }}</td>
                                    <td>
                                        <a href="#modalEditA" class="btn btn-success" data-toggle="modal"
                                            onclick="getEditForm({{ $d->id }})">Edit</a>


                                        <form method="POST" action="{{ route('facilities.destroy', $d->id) }}"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <input type="submit" value="Delete" class="btn btn-danger"
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
        function getEditForm(facilities_id) {
            $.ajax({
                type: 'POST',
                url: '{{ route('facilities.getEditForm') }}',
                data: {
                    '_token': '<?php echo csrf_token(); ?>',
                    'id': facilities_id
                },
                success: function(data) {
                    $('#modalContent').html(data.msg)
                }
            });
        }
    </script>
@endsection
