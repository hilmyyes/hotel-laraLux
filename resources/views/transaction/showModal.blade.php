<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <h4 class="modal-title">Transaction ID  #{{ $data->id }} - {{ $data->transaction_date }}</h4>
</div>
<div class="modal-body">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                @foreach ($products as $p)
                    <div class="card mb-4 box-shadow">
                        <img class="card-img-top"alt="Thumbnail [100%x225]"
                            style="height: 225px; width:100%; display: block;" src="{{ asset('images/' . $p->image) }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $p->name }}</h5>
                            <p class="card-text">Hotel : {{ $p->hotel->name }}</p>
                            <p class="card-text">Subtotal : {{ $p->pivot->subtotal }}</p>
                            <p class="card-text">Quantity : {{ $p->pivot->quantity }}</p>
                        </div>
                    </div>

                    <hr>
                @endforeach
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
