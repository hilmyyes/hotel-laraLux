@extends('layouts.admin')

@section('content')
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
                    <select class="form-control product-select" name="product[{{ $transactionProduct->id }}]" required>
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
                        name="check_in[{{ $transactionProduct->id }}]"
                        value="{{ $transactionProduct->pivot->checkin_date }}" />
                </div>

                <div class="form-group">
                    <label for="duration_{{ $transactionProduct->id }}">Duration</label>
                    <input type="number" name="duration[{{ $transactionProduct->id }}]"
                        class="form-control duration-input" value="{{ $transactionProduct->pivot->duration }}">
                </div>

                <div class="form-group">
                    <label for="subtotal_{{ $transactionProduct->id }}">Subtotal</label>
                    <input type="number" step="0.01" name="subtotal[{{ $transactionProduct->id }}]"
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
@endsection

@section('javascript')
    <!-- Include jQuery and Date Range Picker CSS and JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/moment/min/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <!-- Initialize Date Range Picker -->
    <script>
        $(document).ready(function() {
            // Event listener for duration input changes
            $('.duration-input').on('input', function() {
                var value = $(this).val();
                if (value < 1) {
                    $(this).val(1); // Set to 1 if less than 1
                    value = 1; // Update value variable
                }

                updateSubtotal($(this));
                $(this).toggleClass('duration-changed'); // Add/remove CSS class for visual cue
            });

            // Function to update subtotal based on duration and product price
            function updateSubtotal(input) {
                var duration = input.val();
                var productId = input.closest('.product-block').attr('id').split('_')[1];
                var price = $('select[name="product[' + productId + ']"] option:selected').data('price');
                var subtotal = duration * price;
                $('input[name="subtotal[' + productId + ']"]').val(subtotal.toFixed(2));
            }

            // Initialize subtotal values on page load
            $('.duration-input').each(function() {
                updateSubtotal($(this));
            });
        });
    </script>
@endsection
