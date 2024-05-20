@extends('layout.conquer')

@section('content')
    <form method="POST" action="{{ route('customer.store') }}">
        @csrf
        <h2>Add new Type Hotel</h2>
        <div class="form-group">
            <label for="name">Name of Customer</label>
            <input type="text" name="name" class="form-control" id="nameCategory" aria-describedby="nameHelp"
                placeholder="Enter name of Customer">
            <small id="nameHelp" class="form-text text-muted">Please write down your data here</small>
        </div>
        <div class="form-group">
            <label for="name">Address of Customer</label>
            <input type="text" name="address" class="form-control" id="nameCategory" aria-describedby="nameHelp"
                placeholder="Enter address of Customer">
            <small id="nameHelp" class="form-text text-muted">Please write down your data here</small>
        </div>
        <a class="btn btn-info" href="{{ url()->previous() }}">Cancel</a>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
