@extends('Frontend.layouts.main')

@section('main-container')
<div class="basket">
    @if(!empty($basket) && count($basket) > 0)
        <table class="custom-table">
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
                                {{ $item['components'] }}
                            @endif
                        </td>
                        <td>{{ $item['quantity'] }}</td>
                        <td>{{ number_format($item['total_price'], 2) }} EUR</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Trigger Button -->
        <button id="openOrderModal" class="custom-btn primary-btn">Place Order</button>

        <!-- Modal Structure -->
        <div id="orderModal" class="custom-modal">
            <div class="custom-modal-content">
                <span id="closeOrderModal" class="custom-modal-close">&times;</span>
                <h3 class="modal-header">Your Details</h3>
                <form action="{{ route('order.submit') }}" method="POST" class="custom-form">
                    @csrf
                    <div class="form-group">
                        <label for="OrderCustName">Name:</label>
                        <input type="text" name="OrderCustName" required>
                    </div>
                    <div class="form-group">
                        <label for="OrderOrgName">Organization:</label>
                        <input type="text" name="OrderOrgName">
                    </div>
                    <div class="form-group">
                        <label for="OrderEmail">Email:</label>
                        <input type="email" name="OrderEmail" required>
                    </div>
                    <div class="form-group">
                        <label for="OrderPhone">Phone:</label>
                        <input type="text" name="OrderPhone">
                    </div>
                    <div class="form-group">
                        <label for="OrderAddress">Address:</label>
                        <input type="text" name="OrderAddress" required>
                    </div>
                    <div class="form-group">
                        <label for="OrderComment">Comment:</label>
                        <textarea name="OrderComment" rows="4"></textarea>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="custom-btn success-btn">Submit Order</button>
                        <button type="button" id="closeOrderModalButton" class="custom-btn danger-btn">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    @else
        <!-- Empty Basket Message -->
        <p class="empty-basket-message">Your basket is empty.</p>
    @endif
</div>
@endsection
