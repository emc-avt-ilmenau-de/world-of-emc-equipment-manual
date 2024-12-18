@extends('Frontend.layouts.main')

@section('main-container')
<h2>Enter Your Information</h2>
<form action="{{ route('order.customerSubmit') }}" method="POST">
    @csrf

    <label for="OrderCustName">Name:</label>
    <input type="text" id="OrderCustName" name="OrderCustName" required><br>

    <label for="OrderEmail">Email:</label>
    <input type="email" id="OrderEmail" name="OrderEmail" required><br>

    <label for="OrderPhone">Phone:</label>
    <input type="text" id="OrderPhone" name="OrderPhone"><br>

    <label for="OrderAddress">Address:</label>
    <input type="text" id="OrderAddress" name="OrderAddress" required><br>

    <label for="OrderComment">Comments:</label>
    <textarea id="OrderComment" name="OrderComment"></textarea><br>

    <button type="submit" class="btn btn-success">Submit Order</button>
</form>
@endsection
