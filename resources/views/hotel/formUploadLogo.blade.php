@extends('layouts.admin')
@section('content')
    <div class="page-content">
        <h3 class="page-title">Upload Logo untuk hotel {{ $hotel->name }}</h3>
        <div class="container">
            <form method="POST" enctype="multipart/form-data" action="{{ url('hotel/simpanLogo') }}">
                @csrf
                <div class="form-group">
                    <label for="exampleInputType">Pilih Logo</label>
                    <input type="file" class="form-control" name="file_logo" />
                    <input type="hidden" name='hotel_id' value="{{ $hotel->id }}" />
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
