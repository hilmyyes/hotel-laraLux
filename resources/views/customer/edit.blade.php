@extends('layout.conquer')

@section('content')
    <form method="POST" action="{{ route('customer.update', $data->id) }}">
        @csrf
        @method('PUT')
        <h2>Add edit Customer Hotel</h2>
        <div class="form-group">
            <label for="name">Name of Customer</label>
            <input type="text" name="name" class="form-control" id="nameCategory" aria-describedby="nameHelp"
                placeholder="Enter name of Customer"value="{{ $data->name }}">
            <small id="nameHelp" class="form-text text-muted">Please write down your data here</small>
        </div>
        <div class="form-group">
            <label for="name">Address of Customer</label>
            <input type="text" name="address" class="form-control" id="nameCategory" aria-describedby="nameHelp"
                placeholder="Enter address of Customer"value="{{ $data->address }}">
            <small id="nameHelp" class="form-text text-muted">Please write down your data here</small>
        </div>
        <a class="btn btn-info" href="{{ route('customer.index') }}">Cancel</a>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
