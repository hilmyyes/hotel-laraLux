@extends('layout.conquer')

@section('content')
    <form method="POST" action="{{ route('hotel.store') }}">
        @csrf
        <h2>Add new Hotel</h2>
        <div class="form-group">
            <label for="name">Name of Hotel</label>
            <input type="text" name="name" class="form-control" id="nameCategory" aria-describedby="nameHelp"
                placeholder="Enter name of Hotel">
            <small id="nameHelp" class="form-text text-muted">Please write down your data here</small>
        </div>
        <div class="form-group">
            <label for="name">Address of Hotel</label>
            <input type="text" name="address" class="form-control" id="nameCategory" aria-describedby="nameHelp"
                placeholder="Enter Address of Hotel">
            <small id="nameHelp" class="form-text text-muted">Please write down your data here</small>
        </div>
        <div class="form-group">
            <label for="name">City of Hotel</label>
            <input type="text" name="city" class="form-control" id="nameCategory" aria-describedby="nameHelp"
                placeholder="Enter City of Hotel">
            <small id="nameHelp" class="form-text text-muted">Please write down your data here</small>
        </div>
        <div class="form-group">
            <label for="name">Image of Hotel</label>
            <input type="text" name="image" class="form-control" id="nameCategory" aria-describedby="nameHelp"
                placeholder="Enter Image of Hotel">
            <small id="nameHelp" class="form-text text-muted">Please write down your data here</small>
        </div>
        <div class="form-group">
            <label for="name">Type of Hotel</label>
            <select class="form-control" name="type">
                <option value="" selected disabled>Pilih Type Hotel</option>
                @foreach ($types as $t)
                    <option value="{{ $t->id }}">{{ $t->name }}</option>
                @endforeach
            </select>
        </div>
        <a class="btn btn-info" href="{{ url()->previous() }}">Cancel</a>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
