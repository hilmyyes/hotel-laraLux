@extends('layout.conquer')



@section('content')
    <div class="container">
        <a class="btn btn-success" href="{{ route('type.create') }}">+ new Type</a>
        <a href="#modalCreate" data-toggle="modal" class="btn btn-info">+ New Type (with Modals)</a>

        <h2>Welcome Page</h2>
        <p>this all data from Type table</p>

        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Created</th>
                    <th>Updated</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $d)
                    <tr id="tr_{{ $d->id }}">

                        <td>{{ $d->id }}</td>
                        <td id="td_name_{{ $d->id }}">{{ $d->name }}</td>
                        <td id="td_description_{{ $d->id }}">{{ $d->description }}</td>
                        <td>{{ $d->created_at }}</td>
                        <td>{{ $d->updated_at }}</td>
                        <td>
                            <a class="btn btn-warning" href="{{ route('type.edit', $d->id) }}">Edit</a>
                            <a href="#modalEditA" class="btn btn-success" data-toggle="modal"
                                onclick="getEditForm({{ $d->id }})">Edit Type A</a>
                            <a href="#modalEditB" class="btn btn-info" data-toggle="modal"
                                onclick="getEditFormB({{ $d->id }})">Edit Type B</a>
                            @can('delete-permission', Auth::user())
                                <a href="#" value="DeleteNoReload" class="btn btn-danger"
                                    onclick="if(confirm('Are you sure to delete {{ $d->id }} - {{ $d->name }} ? ')) deleteDataRemoveTR({{ $d->id }})">Delete
                                    without Reload</a>

                                <form method="POST" action="{{ route('type.destroy', $d->id) }}" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" value="delete" class="btn btn-danger"
                                        onclick="return confirm('Are you sure to delete {{ $d->id }} - {{ $d->name }} ? ');">
                                </form>
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    <!-- Create Modal -->
    <div class="modal fade" id="modalCreate" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h2 class="modal-title">Add New Type</h2>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('type.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name of Category</label>
                            <input type="text" name="name" class="form-control" id="nameCategory"
                                aria-describedby="nameHelp" placeholder="Enter name of Category">
                            <small id="nameHelp" class="form-text text-muted">Please write down your data here</small>
                        </div>
                        <div class="form-group">
                            <label for="desc">Description of Category</label>
                            <input type="text" name="desc" class="form-control" id="descCategory"
                                aria-describedby="descHelp" placeholder="Enter Description of Category">
                            <small id="descHelp" class="form-text text-muted">Please write down your data here</small>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        </div>
                    </form>
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

    <!-- Edit Modal B -->
    <div class="modal fade" id="modalEditB" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog modal-wide">
            <div class="modal-content">
                <div class="modal-body" id="modalContentB">
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
        function getEditForm(type_id) {
            $.ajax({
                type: 'POST',
                url: '{{ route('type.getEditForm') }}',
                data: {
                    '_token': '<?php echo csrf_token(); ?>',
                    'id': type_id
                },
                success: function(data) {
                    $('#modalContent').html(data.msg)
                }
            });
        }

        function getEditFormB(type_id) {
            $.ajax({
                type: 'POST',
                url: '{{ route('type.getEditFormB') }}',
                data: {
                    '_token': '<?php echo csrf_token(); ?>',
                    'id': type_id
                },
                success: function(data) {
                    $('#modalContentB').html(data.msg);
                }
            });
        }

        function saveDataUpdateTD(type_id) {
            var eName = $('#eName').val();
            var eDesc = $('#eDesc').val();
            $.ajax({
                type: 'POST',
                url: '{{ route('type.saveDataTD') }}',
                data: {
                    '_token': '<?php echo csrf_token(); ?>',
                    'id': type_id,
                    'name': eName,
                    'description': eDesc
                },
                success: function(data) {
                    if (data.status == "oke") {
                        $('#modalEditB').modal('hide');
                        $('#td_name_' + type_id).html(eName);
                        $('#td_description_' + type_id).html(eDesc);
                    }
                }
            });
        }

        function deleteDataRemoveTR(type_id) {
            $.ajax({
                type: 'POST',
                url: '{{ route('type.deleteData') }}',
                data: {
                    '_token': '<?php echo csrf_token(); ?>',
                    'id': type_id
                },
                success: function(data) {
                    if (data.status == "oke") {
                        $('#tr_' + type_id).remove();
                    }
                }
            });
        }
    </script>
@endsection
