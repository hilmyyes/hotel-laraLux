@extends('layouts.admin')

@section('content')
    <form method="POST" action="{{ route('facilities.store') }}">
        @csrf
        <h2>Add new Facilities Product</h2>
        <div class="form-group">
            <label for="name">Name of Facilities</label>
            <input type="text" name="name" class="form-control" id="nameCategory" aria-describedby="nameHelp"
                placeholder="Enter name of Category">
            <small id="nameHelp" class="form-text text-muted">Please write down your data here</small>
        </div>
        <div class="form-group">
            <label for="name">Description of Facilities</label>
            <input type="text" name="desc" class="form-control" id="nameCategory" aria-describedby="nameHelp"
                placeholder="Enter Description of Category">
            <small id="nameHelp" class="form-text text-muted">Please write down your data here</small>
        </div>
        <a class="btn btn-info" href="{{ route('facilities.index') }}">Cancel</a>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
