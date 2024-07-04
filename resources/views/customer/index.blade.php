@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">CUSTOMERS</h1>
        @if (@session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        @if (Auth::user()->role == 'owner')
        <a href="#modalCreate" data-toggle="modal" class="btn btn-success">+ New Customer</a>
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
                                <th>Role</th>

                                <th>Creted</th>
                                <th>Updated</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customers as $d)
                                <tr id="tr_{{ $d->id }}">
                                    {{-- <td>{{ $d->id }}</td> --}}
                                    <td>{{ $d->name }}</td>
                                    <td>{{ $d->points }}</td>
                                    <td>{{ $d->role }}</td>
                                    <td>{{ $d->created_at }}</td>
                                    <td>{{ $d->updated_at }}</td>
                                    <td>
                                        @if (Auth::user()->role == 'owner')
                                            <a class="btn btn-warning" href="{{ route('customer.edit', $d->id) }}">Edit</a>
                                            <form method="POST" action="{{ route('customer.destroy', $d->id) }}"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <input type="submit" value="delete" class="btn btn-danger"
                                                    onclick="return confirm('Are you sure to delete {{ $d->id }} - {{ $d->name }} ? ');">
                                            </form>
                                        @endif
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

    @if (Auth::user()->role == 'owner')
    <div class="modal fade" id="modalCreate" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" >
                <div class="modal-header">
                    <button type="button" class="close"
                            data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Add New Customer/Akun</h4>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{route("customer.store")}}">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="form_name"
                                   aria-describedby="nameHelp" placeholder="Enter your Name">
                            <br>
                            <label for="name">Email</label>
                            <input type="email" class="form-control" id="name" name="form_email"
                                   aria-describedby="nameHelp" placeholder="Enter your Email">
                            <br>
                            <label for="name">Password</label>
                            <input type="password" class="form-control" id="name" name="form_password"
                                   aria-describedby="nameHelp" placeholder="Enter your Email">
                            <br>
                            <label for="hotel_id">Role</label>
                            <select name="form_role" id="hotel_id" class="form-control" disabled>
                                <option value="guest">guest</option>
                              </select>
                            <br>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editModal" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog modal-wide">
            <div class="modal-content" >
                <div class="modal-body" id="modalContent">
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection
