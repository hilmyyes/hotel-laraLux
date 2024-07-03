@extends('layouts.admin')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">CUSTOMERS</h1>
        @if (@session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif
        {{-- <a class="btn btn-success" href="{{ route('customer.create') }}">+ new Customer</a> --}}
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
                                <th>Points</th>
                                <th>Creted</th>
                                <th>Updated</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Points</th>
                                <th>Creted</th>
                                <th>Updated</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($customers as $d)
                                <tr id="tr_{{ $d->id }}">
                                    {{-- <td>{{ $d->id }}</td> --}}
                                    <td>{{ $d->name }}</td>
                                    <td>{{ $d->points }}</td>
                                    <td>{{ $d->created_at }}</td>
                                    <td>{{ $d->updated_at }}</td>
                                    <td>
                                        <a class="btn btn-warning" href="{{ route('customer.edit', $d->id) }}">Edit</a>
                                        <form method="POST" action="{{ route('customer.destroy', $d->id) }}"
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
