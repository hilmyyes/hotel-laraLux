@extends('layout.conquer')

@section('content')
    <form method="POST" action="{{ route('type.update', $data->id) }}">
        @csrf
        @method('PUT')
        <h2>Update Type Hotel</h2>
        <div class="form-group">
            <label for="name">Name of Category</label>
            <input type="text" name="name" class="form-control" id="nameCategory" aria-describedby="nameHelp"
                placeholder="Enter name of Type" value="{{ $data->name }}">
            <small id="nameHelp" class="form-text text-muted">Please write down your data here</small>
        </div>
        <div class="form-group">
            <label for="name">Description of Category</label>
            <input type="text" name="desc" class="form-control" id="nameCategory" aria-describedby="nameHelp"
                placeholder="Enter Description of Type" value="{{ $data->description }}">
            <small id="nameHelp" class="form-text text-muted">Please write down your data here</small>
        </div>
        <a class="btn btn-info" href="{{ route('type.index') }}">Cancel</a>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
