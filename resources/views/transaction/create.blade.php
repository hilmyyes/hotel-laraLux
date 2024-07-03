@extends('layouts.admin')

@section('content')
    <form method="POST" action="{{ route('transaction.store') }}">
        @csrf
        <h2>Add new Transaction</h2>

        <div class="form-group">
            <label for="user">User</label>
            <input type="hidden" name="user" value="{{ Auth::user()->id }}">
            <input type="text" class="form-control" value="{{ Auth::user()->name }}" readonly>
        </div>

        <div class="form-group">
            <label for="customer">Customer</label>
            <select class="form-control" name="customer" required>
                <option value="" selected disabled>Pilih Customer</option>
                @foreach ($customers as $c)
                    <option value="{{ $c->id }}">{{ $c->name }}</option>
                @endforeach
            </select>
        </div>

        <h3>Products</h3>

        <div id="products-container">
            <div class="product-item">
                <div class="form-group">
                    <label for="product">Product</label>
                    <select class="form-control" name="products[]" required>
                        <option value="" selected disabled>Pilih Product</option>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="check_in">Check-in Date</label>
                    <input type="text" name="check_in[]" class="form-control date-range-picker"
                        placeholder="Select check-in date range">
                </div>
                <div class="form-group">
                    <label for="duration">Duration</label>
                    <input type="text" name="duration[]" class="form-control" placeholder="Enter duration of Product"
                        readonly>
                </div>
                <div class="form-group">
                    <label for="subtotal">Subtotal of Product</label>
                    <input type="text" name="subtotal[]" class="form-control" placeholder="Enter Subtotal of Product"
                        readonly>
                </div>
                <button type="button" class="btn btn-danger btn-sm delete-product">Delete Product</button>
                <br>
            </div>
        </div>
        <button type="button" class="btn btn-success mb-3" id="add-product">Add Product</button>
        <a class="btn btn-info" href="{{ route('transaction.index') }}">Cancel</a>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection

@section('javascript')
    <!-- Include daterangepicker CSS and JS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/moment/min/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const addProductBtn = document.getElementById('add-product');
            const productsContainer = document.getElementById('products-container');

            const initializeDateRangePicker = (element) => {
                $(element).daterangepicker({
                    startDate: moment().format('DD-MM-YYYY'),
                    minDate: moment(),
                    endDate: moment().add(1, 'days').format('DD-MM-YYYY'),
                    locale: {
                        format: 'DD-MM-YYYY'
                    }
                }, function(start, end) {
                    var id = $(this.element).attr('name') ? $(this.element).attr('name').split('_')[1] :
                        '';

                    var startDate = start.format('DD-MM-YYYY');
                    var endDate = end.format('DD-MM-YYYY');
                    var duration = end.diff(start, 'days');

                    console.log("A new date selection was made for ID " + id + ": " + startDate +
                        ' to ' + endDate + ', with duration of ' + duration + ' days.');

                    // Update the duration input field
                    const durationInput = $(this.element).closest('.product-item').find(
                        'input[name="duration[]"]');
                    durationInput.val(duration);

                    // Calculate and update the subtotal
                    updateSubtotal($(this.element).closest('.product-item'));

                    // Only make the AJAX call if there's an ID
                    if (id) {
                        $.ajax({
                            type: 'POST',
                            url: '{{ route('editCheckIn') }}',
                            data: {
                                '_token': '{{ csrf_token() }}',
                                'id': id,
                                'checkin_date': startDate,
                                'duration': duration,
                            },
                            success: function(data) {
                                console.log("Check-in date updated successfully.");
                            }
                        });
                    }
                });
            };

            const updateSubtotal = (productItem) => {
                const productSelect = productItem.find('select[name="products[]"]');
                const durationInput = productItem.find('input[name="duration[]"]');
                const subtotalInput = productItem.find('input[name="subtotal[]"]');

                const productId = productSelect.val();
                const duration = parseInt(durationInput.val(), 10);

                if (productId && !isNaN(duration)) {
                    // Fetch the product price from the server
                    getProductPrice(productId, function(productPrice) {
                        const subtotal = productPrice * duration;
                        subtotalInput.val(subtotal);
                    });
                } else {
                    subtotalInput.val('');
                }
            };

            const getProductPrice = (productId, callback) => {
                $.ajax({
                    type: 'GET',
                    url: '{{ route('product.price', '') }}/' + productId,
                    success: function(data) {
                        if (data.price !== undefined) {
                            callback(data.price);
                        } else {
                            console.error('Error fetching product price:', data.error);
                            callback(0);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('AJAX error:', textStatus, errorThrown);
                        callback(0);
                    }
                });
            };


            // Initialize daterangepicker on existing elements
            document.querySelectorAll('.date-range-picker').forEach(element => {
                initializeDateRangePicker(element);
            });

            addProductBtn.addEventListener('click', function() {
                const productItem = document.createElement('div');
                productItem.classList.add('product-item');
                productItem.innerHTML = `
            <div class="form-group">
                <label for="product">Product</label>
                <select class="form-control" name="products[]" required>
                    <option value="" selected disabled>Pilih Product</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="check_in">Check-in Date</label>
                <input type="text" name="check_in[]" class="form-control date-range-picker" placeholder="Select check-in date range">
            </div>
            <div class="form-group">
                <label for="duration">Duration</label>
                <input type="text" name="duration[]" class="form-control" placeholder="Enter duration of Product" readonly>
            </div>
            <div class="form-group">
                <label for="subtotal">Subtotal of Product</label>
                <input type="text" name="subtotal[]" class="form-control" placeholder="Enter Subtotal of Product" readonly>
            </div>
            <button type="button" class="btn btn-danger btn-sm delete-product">Delete Product</button>
        `;
                productsContainer.appendChild(productItem);

                // Initialize daterangepicker on new elements
                initializeDateRangePicker(productItem.querySelector('.date-range-picker'));

                // Add change event listener to update subtotal when product is changed
                productItem.querySelector('select[name="products[]"]').addEventListener('change',
                    function() {
                        updateSubtotal(productItem);
                    });

                // Add change event listener to update subtotal when duration is changed
                productItem.querySelector('input[name="duration[]"]').addEventListener('change',
                    function() {
                        updateSubtotal(productItem);
                    });
            });

            // Add event listener for deleting product
            productsContainer.addEventListener('click', function(e) {
                if (e.target.classList.contains('delete-product')) {
                    const productItem = e.target.closest('.product-item');
                    if (productsContainer.childElementCount > 1) {
                        productsContainer.removeChild(productItem);
                    } else {
                        alert('At least one product is required.');
                    }
                }
            });
        });
    </script>
@endsection
