@extends('Frontend.layouts.main')

@section('main-container')
<div class="basket">
@if(!empty($basket))
    <table>
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Components</th>
                <th>Quantity</th>
                <th>Total Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach($basket as $item)
                <tr>
                    <td>{{ $item['product_name'] }}</td>
                    <td>{{ $item['components'] }}</td>
                    <td>{{ $item['quantity'] }}</td>
                    <td>{{ number_format($item['total_price'], 2) }} EUR</td>
                    <td>
                    <form action="{{ route('basket.update', $item['product_id']) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1">
                        <button type="submit">Update</button>
                    </form>
                    </td>
                    <td>
                    <form action="{{ route('basket.remove', $item['product_id']) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Remove</button>
                    </form>
                </td>
                  
                </tr>           
            @endforeach
        </tbody>
    </table>

    <!-- Order Form -->
    <form action="{{ route('order.submit') }}" method="POST">
        @csrf
        <h3>Customer Details</h3>
        <div>
            <label for="OrderCustName">Name:</label>
            <input type="text" name="OrderCustName" required>
        </div>
        <div>
            <label for="OrderEmail">Email:</label>
            <input type="email" name="OrderEmail" required>
        </div>
        <div>
            <label for="OrderPhone">Phone:</label>
            <input type="text" name="OrderPhone">
        </div>
        <div>
            <label for="OrderAddress">Address:</label>
            <input type="text" name="OrderAddress" required>
        </div>
        <div>
            <label for="OrderComment">Comment:</label>
            <textarea name="OrderComment"></textarea>
        </div>
        <button type="submit">Place Order</button>
    </form>
@else
    <p>Your basket is empty.</p>
@endif



</div>
@endsection
