@extends('layouts.admin')

@section('content')
    <form method="POST" action="{{ route('product.update', $data->id) }}">
        @csrf
        @method('PUT')
        <h2>Edit Product</h2>
        <div class="form-group">
            <label for="name">Name of Product</label>
            <input type="text" name="name" class="form-control" id="nameCategory" aria-describedby="nameHelp"
                placeholder="Enter name of Product" value="{{ $data->name }}">
            <small id="nameHelp" class="form-text text-muted">Please write down your data here</small>
        </div>
        <div class="form-group">
            <label for="price">Price of Product</label>
            <input type="text" name="price" class="form-control" id="priceCategory" aria-describedby="priceHelp"
                placeholder="Enter Price of Product" value="{{ $data->price }}">
            <small id="priceHelp" class="form-text text-muted">Please write down your data here</small>
        </div>
        <div class="form-group">
            <label for="image">Image of Product</label>
            <input type="text" name="image" class="form-control" id="imageCategory" aria-describedby="imageHelp"
                placeholder="Enter Image of Product" value="{{ $data->image }}">
            <small id="imageHelp" class="form-text text-muted">Please write down your data here</small>
        </div>
        <div class="form-group">
            <label for="desc">Description of Product</label>
            <input type="text" name="desc" class="form-control" id="descCategory" aria-describedby="descHelp"
                placeholder="Enter Description of Product" value="{{ $data->description }}">
            <small id="descHelp" class="form-text text-muted">Please write down your data here</small>
        </div>
        <div class="form-group">
            <label for="room">Available Room of Product</label>
            <input type="text" name="room" class="form-control" id="roomCategory" aria-describedby="roomHelp"
                placeholder="Enter Available Room of Product" value="{{ $data->available_room }}">
            <small id="roomHelp" class="form-text text-muted">Please write down your data here</small>
        </div>
        <div class="form-group">
            <label for="hotel">Hotel of Product</label>
            <select class="form-control" name="hotel">
                @if ($hotel)
                    <option value="{{ $hotel->id }}" selected>{{ $hotel->name }}</option>
                @else
                    <option selected disabled>Select a Hotel</option>
                @endif
                @foreach ($datas as $d)
                    <option value="{{ $d->id }}">{{ $d->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group" id="facilities-group">
            <label for="facilities">Facilities of Product</label>
            <div id="facilities-container">
                @foreach ($data->facilities as $facility)
                    <div class="facilities-row mt-2">
                        <select class="form-control" name="facilities[]">
                            <option value="" disabled>Pilih Facilities</option>
                            @foreach ($facilities as $f)
                                <option value="{{ $f->id }}" {{ $f->id == $facility->id ? 'selected' : '' }}>
                                    {{ $f->name }}</option>
                            @endforeach
                        </select>
                        <button type="button" class="btn btn-sm btn-danger ml-2 remove-facility-btn">Hapus</button>
                    </div>
                @endforeach
            </div>
            <button type="button" class="btn btn-sm btn-info mt-2" id="add-facility-btn">Tambah Fasilitas</button>
        </div>
        <a class="btn btn-info" href="{{ route('product.index') }}">Cancel</a>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection

@section('javascript')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const facilitiesContainer = document.getElementById('facilities-container');
            const addFacilityBtn = document.getElementById('add-facility-btn');

            addFacilityBtn.addEventListener('click', function() {
                const newFacilityRow = document.createElement('div');
                newFacilityRow.classList.add('facilities-row', 'mt-2');

                const newFacilitySelect = document.createElement('select');
                newFacilitySelect.classList.add('form-control');
                newFacilitySelect.setAttribute('name', 'facilities[]');

                const defaultOption = document.createElement('option');
                defaultOption.value = '';
                defaultOption.textContent = 'Pilih Facilities';
                defaultOption.disabled = true;
                defaultOption.selected = true;

                newFacilitySelect.appendChild(defaultOption);

                @foreach ($facilities as $f)
                    const option{{ $f->id }} = document.createElement('option');
                    option{{ $f->id }}.value = '{{ $f->id }}';
                    option{{ $f->id }}.textContent = '{{ $f->name }}';
                    newFacilitySelect.appendChild(option{{ $f->id }});
                @endforeach

                const removeFacilityBtn = document.createElement('button');
                removeFacilityBtn.type = 'button';
                removeFacilityBtn.classList.add('btn', 'btn-sm', 'btn-danger', 'ml-2',
                    'remove-facility-btn');
                removeFacilityBtn.textContent = 'Hapus';
                removeFacilityBtn.addEventListener('click', function() {
                    newFacilityRow.remove();
                });

                newFacilityRow.appendChild(newFacilitySelect);
                newFacilityRow.appendChild(removeFacilityBtn);
                facilitiesContainer.appendChild(newFacilityRow);
            });

            document.addEventListener('click', function(event) {
                if (event.target && event.target.classList.contains('remove-facility-btn')) {
                    event.target.parentElement.remove();
                }
            });
        });
    </script>
@endsection
