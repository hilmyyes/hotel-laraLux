@extends('layout.conquer')

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
                    <input type="date" name="check_in[]" class="form-control" placeholder="Enter check_in of Product">
                </div>
                <div class="form-group">
                    <label for="duration">Duration</label>
                    <input type="text" name="duration[]" class="form-control" placeholder="Enter duration of Product">
                </div>
                <div class="form-group">
                    <label for="subtotal">Subtotal of Product</label>
                    <input type="text" name="subtotal[]" class="form-control" placeholder="Enter Subtotal of Product">
                </div>
                <button type="button" class="btn btn-danger btn-sm delete-product">Delete Product</button>
            </div>
        </div>

        <button type="button" class="btn btn-success mb-3" id="add-product">Add Product</button>

        <a class="btn btn-info" href="{{ route('transaction.index') }}">Cancel</a>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection

@section('javascript')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const addProductBtn = document.getElementById('add-product');
            const productsContainer = document.getElementById('products-container');

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
                        <input type="date" name="check_in[]" class="form-control" placeholder="Enter check_in of Product">
                    </div>
                    <div class="form-group">
                        <label for="duration">Duration</label>
                        <input type="text" name="duration[]" class="form-control" placeholder="Enter duration of Product">
                    </div>
                    <div class="form-group">
                        <label for="subtotal">Subtotal of Product</label>
                        <input type="text" name="subtotal[]" class="form-control" placeholder="Enter Subtotal of Product">
                    </div>
                    <button type="button" class="btn btn-danger btn-sm delete-product">Delete Product</button>
                `;
                productsContainer.appendChild(productItem);
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
