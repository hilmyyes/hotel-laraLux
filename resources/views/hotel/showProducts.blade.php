<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <h4 class="modal-title">Products of hotel : {{ $nama }}</h4>
</div>
<div class="modal-body">
    <div class='row'>
        @foreach ($data as $d)
            <div class='col-md-4' style='border:1px solid #eee;text-align:center'>
                <img src="{{ asset('images/' . $d->image) }}" height='200px' />
                <br>
                {{ $d->name }}
                <br>
                Rp. {{ $d->price }}
            </div>
        @endforeach
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
