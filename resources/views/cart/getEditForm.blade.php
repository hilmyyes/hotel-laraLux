<form method="POST" action="{{ route('cart.update', $data->id) }}">
    @csrf
    @method('PUT')
    <img src="{{ asset('img/' . $data->image) }}" alt="">
    <h3>Add to Cart</h3>
    <h5>Product: {{ $data->product->name }}</h5>

    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
    <input type="hidden" name="product_id" value="{{ $data->product->id }}">

    <label for="Price">Price:</label>
    <input type="number" class="form-control" id="Price" value="{{ $data->product->price }}" disabled><br>

    <label for="CheckIn">Check-In Date</label>
    <input type="date" class="form-control" name="CheckIn" id="CheckIn" value="{{ $data->checkin_date }}" min="{{ date('Y-m-d', strtotime('now')) }}"
        onchange="UpdateCheckOut()"><br>

    <label for="Duration">Duration</label>
    <input type="number" class="form-control" name="Duration" id="Duration" onchange="UpdateCheckOut()"
        placeholder="Enter Stay Duration" value="{{ $data->duration }}" min="1" max="30"><br>

    <label>CheckOut: </label><label id="CheckOut"></label><br><br>

    <label for="SubTotal">Sub Total</label>
    <input type="number" class="form-control" name="SubTotal" id="SubTotal" value="{{ $data->subtotal }}" readonly><br>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

<script>
    function UpdateCheckOut() {
        var checkInDate = document.getElementById("CheckIn").value;
        var duration = parseInt(document.getElementById("Duration").value);

        if (checkInDate && duration) {
            var date = new Date(checkInDate);
            date.setDate(date.getDate() + duration);

            var dd = String(date.getDate()).padStart(2, '0');
            var mm = String(date.getMonth() + 1).padStart(2, '0');
            var yyyy = date.getFullYear();

            var newDate = dd + '/' + mm + '/' + yyyy;
            document.getElementById("CheckOut").innerText = newDate;

            UpdateSub();
        }
    }

    function UpdateSub() {
        var newDuration = parseInt(document.getElementById('Duration').value);
        var newPrice = parseFloat(document.getElementById('Price').value || 0);

        document.getElementById('SubTotal').value = newPrice * newDuration;
    }

    window.onload = function() {
        UpdateCheckOut();
    };
</script>
