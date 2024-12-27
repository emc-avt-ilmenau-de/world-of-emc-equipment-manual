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
            <td>
                @if(is_array($item['components']))
                    @foreach ($item['components'] as $component)
                        {{ $component['name'] }} ({{ $component['value'] }}) @if (!$loop->last), @endif
                    @endforeach
                @else
                    {{ $item['components'] }} <!-- Handle as string -->
                @endif
            </td>
            <td>{{ $item['quantity'] }}</td>
            <td>{{ number_format($item['total_price'], 2) }} EUR</td>
        </tr>
    @endforeach
            </tbody>
        </table>

        <!-- Trigger Button -->
        <button id="openOrderModal" class="btn btn-primary">Place Order</button>

        <!-- Modal Structure -->
        <div id="orderModal" class="order-modal">
            <div class="order-modal-content">
                <span id="closeOrderModal" class="order-modal-close">&times;</span>
                <h3>Customer Details</h3>
                <form action="{{ route('order.submit') }}" method="POST">
                    @csrf
                    <div>
                        <label for="OrderCustName">Name:</label>
                        <input type="text" name="OrderCustName" required>
                    </div>
                    <div>
                        <label for="OrderOrgName">Organization:</label>
                        <input type="text" name="OrderOrgName">
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
                    <button type="submit" class="btn btn-success">Submit Order</button>
                </form>
            </div>
        </div>
    @else
        <p>Your basket is empty.</p>
    @endif
</div>
@endsection
