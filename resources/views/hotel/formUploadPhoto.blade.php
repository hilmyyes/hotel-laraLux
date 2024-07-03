@extends('layouts.admin')
@section('content')
    <div class="page-content">
        <h3 class="page-title">Upload Image untuk hotel {{ $hotel->name }}</h3>
        <div class="container">
            <form method="POST" enctype="multipart/form-data" action="{{ route('hotel.simpanPhoto') }}">
                @csrf
                <div class="form-group">
                    <label for="exampleInputType">Pilih image</label>
                    <input type="file" class="form-control" name="file_photo" />
                    <input type="hidden" name='hotel_id' value="{{ $hotel->id }}" />
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
