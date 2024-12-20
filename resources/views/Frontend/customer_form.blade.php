@extends('Frontend.layouts.main')

@section('main-container')
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header text-center">
            <h2 class="card-title">Enter Your Information</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('order.customerSubmit') }}" method="POST">
                @csrf

                <div class="form-group mb-3">
                    <label for="OrderCustName" class="form-label">Name:</label>
                    <input type="text" id="OrderCustName" name="OrderCustName" class="form-control" placeholder="Enter your full name" required>
                </div>

                <div class="form-group mb-3">
                    <label for="OrderEmail" class="form-label">Email:</label>
                    <input type="email" id="OrderEmail" name="OrderEmail" class="form-control" placeholder="Enter your email address" required>
                </div>

                <div class="form-group mb-3">
                    <label for="OrderPhone" class="form-label">Phone:</label>
                    <input type="text" id="OrderPhone" name="OrderPhone" class="form-control" placeholder="Enter your phone number">
                </div>

                <div class="form-group mb-3">
                    <label for="OrderAddress" class="form-label">Address:</label>
                    <textarea id="OrderAddress" name="OrderAddress" class="form-control" rows="3" placeholder="Enter your address" required></textarea>
                </div>

                <div class="form-group mb-3">
                    <label for="OrderComment" class="form-label">Comments:</label>
                    <textarea id="OrderComment" name="OrderComment" class="form-control" rows="4" placeholder="Any additional comments"></textarea>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-lg">Submit Order</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
