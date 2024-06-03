@extends('layout.conquer')

@section('content')
    <div class="container">
        <h2>Welcome Page</h2>
        <p>this all data from Customer table</p>

        <a class="btn btn-success" href="{{ route('customer.create') }}">+ new Type</a>
        <a href="#modalCreate" data-toggle="modal" class="btn btn-info">+ New Customer (with Modals)</a>
        @if (@session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Creted</th>
                    <th>Updated</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($customers as $d)
                    <tr id="tr_{{ $d->id }}">
                        <td>{{ $d->id }}</td>
                        <td>{{ $d->name }}</td>
                        <td>{{ $d->address }}</td>
                        <td>{{ $d->created_at }}</td>
                        <td>{{ $d->updated_at }}</td>
                        <td>
                            <a class="btn btn-warning" href="{{ route('customer.edit', $d->id) }}">Edit</a>
                            <a href="#modalEditA" class="btn btn-success" data-toggle="modal"
                                onclick="getEditForm({{ $d->id }})">Edit Type A</a>
                            <a href="#" value="DeleteNoReload" class="btn btn-danger"
                                onclick="if(confirm('Are you sure to delete {{ $d->id }} - {{ $d->name }} ? ')) deleteDataRemoveTR({{ $d->id }})">Delete
                                without Reload</a>
                            <form method="POST" action="{{ route('customer.destroy', $d->id) }}" style="display:inline;">
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


    <!-- Create Modal -->
    <div class="modal fade" id="modalCreate" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h2 class="modal-title">Add New Customer</h2>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('customer.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name of Customer</label>
                            <input type="text" name="name" class="form-control" id="nameCategory"
                                aria-describedby="nameHelp" placeholder="Enter name of Customer">
                            <small id="nameHelp" class="form-text text-muted">Please write down your data here</small>
                        </div>
                        <div class="form-group">
                            <label for="name">Address of Customer</label>
                            <input type="text" name="address" class="form-control" id="nameCategory"
                                aria-describedby="nameHelp" placeholder="Enter address of Customer">
                            <small id="nameHelp" class="form-text text-muted">Please write down your data here</small>
                        </div>
                        <a class="btn btn-info" href="{{ url()->previous() }}">Cancel</a>
                        <button type="submit" class="btn btn-primary">Submit</button>
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
@endsection


@section('javascript')
    <script>
        function getEditForm(customer_id) {
            $.ajax({
                type: 'POST',
                url: '{{ route('customer.getEditForm') }}',
                data: {
                    '_token': '<?php echo csrf_token(); ?>',
                    'id': customer_id
                },
                success: function(data) {
                    $('#modalContent').html(data.msg)
                }
            });
        }

        function deleteDataRemoveTR(customer_id) {
            $.ajax({
                type: 'POST',
                url: '{{ route('customer.deleteData') }}',
                data: {
                    '_token': '<?php echo csrf_token(); ?>',
                    'id': customer_id
                },
                success: function(data) {
                    if (data.status == "oke") {
                        $('#tr_' + customer_id).remove();
                    }
                }
            });
        }
    </script>
@endsection
