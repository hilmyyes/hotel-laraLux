<form method="POST" action="{{ route('facilities.update', $data->id) }}">
    @csrf
    @method('PUT')
    <h2>Update Facilities Product</h2>
    <div class="form-group">
        <label for="name">Name of Facilities</label>
        <input type="text" name="name" class="form-control" id="nameCategory" aria-describedby="nameHelp"
            placeholder="Enter name of Type" value="{{ $data->name }}">
        <small id="nameHelp" class="form-text text-muted">Please write down your data here</small>
    </div>
    <div class="form-group">
        <label for="name">Description of Facilities</label>
        <input type="text" name="desc" class="form-control" id="nameCategory" aria-describedby="nameHelp"
            placeholder="Enter Description of Type" value="{{ $data->description }}">
        <small id="nameHelp" class="form-text text-muted">Please write down your data here</small>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    <a class="btn btn-danger" href="{{ route('facilities.index') }}">Cancel</a>

</form>
