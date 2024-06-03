<form method="POST" action="{{ route('transaction.update', $data->id) }}">
    @csrf
    @method('PUT')
    <h2>Edit Transaction</h2>

    <div class="form-group">
        <label for="user">User</label>
        <select class="form-control" name="user" required>
            @if ($data)
                <option value="{{ $data->user_id }}" selected>{{ $data->user->name }}</option>
            @else
                <option selected disabled>Select a user</option>
            @endif

            @foreach ($users as $u)
                <option value="{{ $u->id }}">{{ $u->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="customer">Customer</label>
        <select class="form-control" name="customer" required>
            @if ($data)
                <option value="{{ $data->customer_id }}" selected>{{ $data->customer->name }}</option>
            @else
                <option selected disabled>Select a customer</option>
            @endif

            @foreach ($customers as $c)
                <option value="{{ $c->id }}">{{ $c->name }}</option>
            @endforeach
        </select>
    </div>

    <h3>Product</h3>
    <div class="form-group">
        <label for="product">Product</label>
        <select class="form-control" name="product" required>
            @if ($transactionProduct)
                <option value="{{ $transactionProduct->id }}" selected>{{ $transactionProduct->name }}</option>
            @else
                <option selected disabled>Select a product</option>
            @endif

            @foreach ($products as $p)
                <option value="{{ $p->id }}">{{ $p->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="quantity">Quantity of Product</label>
        <input type="text" name="quantity" class="form-control" id="quantity" aria-describedby="quantityHelp"
            placeholder="Enter Quantity of Product" value="{{ $transactionProduct->pivot->quantity }}">
        <small id="quantityHelp" class="form-text text-muted">Please write down your data here</small>
    </div>

    <div class="form-group">
        <label for="subtotal">Subtotal of Product</label>
        <input type="text" name="subtotal" class="form-control" id="subtotal" aria-describedby="subtotalHelp"
            placeholder="Enter Subtotal of Product" value="{{ $transactionProduct->pivot->subtotal }}">
        <small id="subtotalHelp" class="form-text text-muted">Please write down your data here</small>
    </div>

    <a class="btn btn-info" href="{{ route('transaction.index') }}">Cancel</a>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
