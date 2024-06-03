<form method="POST" action="{{ route('type.update', $data->id) }}">
    @csrf
    @method('PUT')
    <h2>Update Type Hotel</h2>
    <div class="form-group">
        <label for="name">Name of Category</label>
        <input type="text" id="eName" name="name" class="form-control" id="nameCategory" aria-describedby="nameHelp"
            placeholder="Enter name of Type" value="{{ $data->name }}">
        <small id="nameHelp" class="form-text text-muted">Please write down your data here</small>
    </div>
    <div class="form-group">
        <label for="name">Description of Category</label>
        <input type="text" id="eDesc"name="desc" class="form-control" id="nameCategory" aria-describedby="nameHelp"
            placeholder="Enter Description of Type" value="{{ $data->description }}">
        <small id="nameHelp" class="form-text text-muted">Please write down your data here</small>
    </div>
    <button type="button" class="btn btn-primary" onclick="saveDataUpdateTD({{ $data->id }})">Submit</button>
    <a class="btn btn-danger" href="{{ route('type.index') }}">Cancel</a>
</form>
