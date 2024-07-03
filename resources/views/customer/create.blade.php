@extends('layouts.admin')

@section('content')
    <form method="POST" action="{{ route('customer.store') }}">
        @csrf
        <h2>Add new Type Hotel</h2>
        <div class="form-group">
            <label for="customerName">Name of Customer</label>
            <input type="text" name="name" class="form-control" id="customerName" aria-describedby="nameHelp"
                placeholder="Enter name of Customer" required>
            <small id="nameHelp" class="form-text text-muted">Please write down your data here</small>
        </div>
        <div class="form-group">
            <label for="customerEmail">Email of Customer</label>
            <input type="email" name="email" class="form-control" id="customerEmail" aria-describedby="emailHelp"
                placeholder="Enter email of Customer" required>
            <small id="emailHelp" class="form-text text-muted">Please write down your data here</small>
        </div>
        <div class="form-group">
            <label for="customerPassword">Password of Customer</label>
            <div class="input-group">
                <input type="password" name="password" class="form-control" id="customerPassword"
                    aria-describedby="passwordHelp" placeholder="Enter password of Customer" required minlength="8">
                <div class="input-group-append">
                    <button type="button" class="btn btn-outline-secondary" onclick="togglePassword('customerPassword')">
                        Show
                    </button>
                </div>
            </div>
            <small id="passwordHelp" class="form-text text-muted">Please write down your data here</small>
        </div>
        <div class="form-group">
            <label for="customerConfPassword">Confirm Password of Customer</label>
            <div class="input-group">
                <input type="password" name="password_confirmation" class="form-control" id="customerConfPassword"
                    aria-describedby="confPasswordHelp" placeholder="Confirm password of Customer" required minlength="8">
                <div class="input-group-append">
                    <button type="button" class="btn btn-outline-secondary"
                        onclick="togglePassword('customerConfPassword')">
                        Show
                    </button>
                </div>
            </div>
            <small id="confPasswordHelp" class="form-text text-muted">Please write down your data
                here</small>
        </div>
        <a class="btn btn-info" href="{{ url()->previous() }}">Cancel</a>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
@section('javascript')
    <script>
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const button = field.nextElementSibling.firstElementChild;
            if (field.type === "password") {
                field.type = "text";
                button.innerText = "Hide";
            } else {
                field.type = "password";
                button.innerText = "Show";
            }
        }
    </script>
@endsection
