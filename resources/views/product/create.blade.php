@extends('layout.conquer')

@section('content')
    <form method="POST" action="{{ route('product.store') }}">
        @csrf
        <h2>Add new Product</h2>
        <div class="form-group">
            <label for="name">Name of Product</label>
            <input type="text" name="name" class="form-control" id="nameCategory" aria-describedby="nameHelp"
                placeholder="Enter name of Product">
            <small id="nameHelp" class="form-text text-muted">Please write down your data here</small>
        </div>
        <div class="form-group">
            <label for="name">Price of Product</label>
            <input type="text" name="price" class="form-control" id="nameCategory" aria-describedby="nameHelp"
                placeholder="Enter Price of Product">
            <small id="nameHelp" class="form-text text-muted">Please write down your data here</small>
        </div>
        <div class="form-group">
            <label for="name">Image of Product</label>
            <input type="text" name="image" class="form-control" id="nameCategory" aria-describedby="nameHelp"
                placeholder="Enter Image of Product">
            <small id="nameHelp" class="form-text text-muted">Please write down your data here</small>
        </div>
        <div class="form-group">
            <label for="name">Description of Product</label>
            <input type="text" name="desc" class="form-control" id="nameCategory" aria-describedby="nameHelp"
                placeholder="Enter Description of Product">
            <small id="nameHelp" class="form-text text-muted">Please write down your data here</small>
        </div>
        <div class="form-group">
            <label for="name">available_room of Product</label>
            <input type="text" name="room" class="form-control" id="nameCategory" aria-describedby="nameHelp"
                placeholder="Enter available_room of Product">
            <small id="nameHelp" class="form-text text-muted">Please write down your data here</small>
        </div>
        <div class="form-group">
            <label for="name">Hotel of Product</label>
            <select class="form-control" name="hotel">
                <option value="" selected disabled>Pilih Hotel</option>
                @foreach ($datas as $d)
                    <option value="{{ $d->id }}">{{ $d->name }}</option>
                @endforeach
            </select>
        </div>
        <a class="btn btn-info" href="{{ route('product.index') }}">Cancel</a>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
