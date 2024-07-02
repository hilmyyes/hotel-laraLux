<form method="POST" action="{{ route('transaction.update', $data->id) }}">
    @csrf
    @method('PUT')
    <h2>Edit Transaction</h2>

    <div class="form-group">
        <label for="user">Employee</label>
        <input type="text" name="user" class="form-control" value="{{ $data->user->name }}" readonly>
    </div>

    <div class="form-group">
        <label for="customer">Customer</label>
        <input type="text" name="customer" class="form-control" value="{{ $data->customer->name }}" readonly>
    </div>

    <h3>Products</h3>
    @foreach ($data->products as $transactionProduct)
        <div id="product_{{ $transactionProduct->id }}" class="product-block">
            <div class="form-group">
                <label for="product_{{ $transactionProduct->id }}">Product</label>
                <select class="form-control" name="products[{{ $transactionProduct->id }}][product]"
                    id="product_{{ $transactionProduct->id }}" required>
                    <option value="{{ $transactionProduct->id }}" selected>{{ $transactionProduct->name }}</option>
                    @foreach ($products as $p)
                        <option value="{{ $p->id }}">{{ $p->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="checkin_date_{{ $transactionProduct->id }}">Check-in Date</label>
                <input type="date" name="products[{{ $transactionProduct->id }}][checkin_date]" class="form-control"
                    id="checkin_date_{{ $transactionProduct->id }}"
                    value="{{ $transactionProduct->pivot->checkin_date }}">
            </div>

            <div class="form-group">
                <label for="duration_{{ $transactionProduct->id }}">Duration</label>
                <input type="number" name="products[{{ $transactionProduct->id }}][duration]" class="form-control"
                    id="duration_{{ $transactionProduct->id }}" value="{{ $transactionProduct->pivot->duration }}">
            </div>

            <div class="form-group">
                <label for="subtotal_{{ $transactionProduct->id }}">Subtotal</label>
                <input type="number" step="0.01" name="products[{{ $transactionProduct->id }}][subtotal]"
                    class="form-control" id="subtotal_{{ $transactionProduct->id }}"
                    value="{{ $transactionProduct->pivot->subtotal }}">
            </div>

            <button type="button" class="btn btn-danger btn-sm mt-2 mb-2"
                onclick="removeProduct('{{ $transactionProduct->id }}')">Delete Product</button>
        </div>
    @endforeach

    <a class="btn btn-info" href="{{ route('transaction.index') }}">Cancel</a>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
