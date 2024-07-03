<!-- Include jQuery and Date Range Picker CSS and JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/moment/min/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<!-- Form for editing transaction -->
<form id="editTransactionForm" method="POST" action="{{ route('transaction.update', $data->id) }}">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="user">Customer</label>
        <input type="text" name="customer" class="form-control" value="{{ $data->user->name }}" readonly>
    </div>

    <h3>Products</h3>
    @foreach ($data->products as $transactionProduct)
        <div id="product_{{ $transactionProduct->id }}" class="product-block">
            <div class="form-group">
                <label for="product_{{ $transactionProduct->id }}">Product</label>
                <select class="form-control product-select" name="products[{{ $transactionProduct->id }}][product]"
                    required>
                    @foreach ($products as $p)
                        <option value="{{ $p->id }}" data-price="{{ $p->price }}"
                            {{ $transactionProduct->id == $p->id ? 'selected' : '' }}>
                            {{ $p->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="check_in">Check-in Date:</label>
                <input type="date" class="form-control" id="check_in_{{ $transactionProduct->id }}"
                    name="products[{{ $transactionProduct->id }}][check_in]"
                    value="{{ $transactionProduct->pivot->checkin_date }}" />
            </div>

            <div class="form-group">
                <label for="duration_{{ $transactionProduct->id }}">Duration</label>
                <input type="number" name="products[{{ $transactionProduct->id }}][duration]"
                    class="form-control duration-input" value="{{ $transactionProduct->pivot->duration }}">
            </div>

            <div class="form-group">
                <label for="subtotal_{{ $transactionProduct->id }}">Subtotal</label>
                <input type="number" step="0.01" name="products[{{ $transactionProduct->id }}][subtotal]"
                    class="form-control subtotal-input" value="{{ $transactionProduct->pivot->subtotal }}" readonly>
            </div>

            <button type="button" class="btn btn-danger btn-sm mt-2 mb-2 delete-product">
                Delete Product
            </button>
        </div>
    @endforeach

    <div class="modal-footer">
        <a class="btn btn-info" href="{{ route('transaction.index') }}">Cancel</a>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>

<!-- Initialize Date Range Picker -->
<script>
    $(document).ready(function() {
        // Event listener for duration input changes
        $(document).on('input', '.duration-input', function() {
            updateSubtotal($(this));
        });

        // Function to update subtotal based on duration and product price
        function updateSubtotal(input) {
            var duration = input.val();
            var productId = input.closest('.product-block').attr('id').split('_')[1];
            var price = $('select[name="products[' + productId + '][product]"] option:selected').data('price');
            var subtotal = duration * price;
            $('input[name="products[' + productId + '][subtotal]"]').val(subtotal.toFixed(2));
        }

        // Initialize subtotal values on page load
        $('.duration-input').each(function() {
            updateSubtotal($(this));
        });
    });
</script>
