@extends('Frontend.layouts.main')

@section('main-container')
<div class="basket">
    @if(!empty($basket) && count($basket) > 0)
    <table class="custom-table">
    <thead>
        <tr>
            <th>{{ __('messages.p_name') }}</th>
            <th>{{ __('messages.c_name') }}</th>
            <th>{{ __('messages.quantity') }}</th>
            <th>{{ __('messages.total_price') }}</th>
            <th>{{ __('messages.action') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach($basket as $productId => $item)
            <tr>
                <td>{{ $item['product_name'] }}</td>
                <td>
                    <ul>
                        @foreach ($item['components'] as $component)
                            <li>{{ $component['name'] }}: {{ $component['value'] }}</li>
                        @endforeach
                    </ul>
                </td>
                <td>
                    <!-- Update Form -->
                    <form action="{{ route('basket.update', $productId) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1">
                        <button type="submit">{{ __('messages.update') }}</button>
                    </form>
                </td>
                <td>{{ number_format($item['total_price'], 2) }} EUR</td>
                <td>
                    <!-- Remove Form -->
                    <form action="{{ route('basket.remove', $productId) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">{{ __('messages.remove') }}</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>


        <!-- Trigger Button -->
        <button id="openOrderModal" class="custom-btn primary-btn">{{ __('messages.Place_Order') }}</button>

        <!-- Modal Structure -->
        <div id="orderModal" class="custom-modal">
            <div class="custom-modal-content">
                <span id="closeOrderModal" class="custom-modal-close">&times;</span>
                <h3 class="modal-header">{{ __('messages.your_details') }}</h3>
                <form action="{{ route('order.submit') }}" method="POST" class="custom-form">
                    @csrf
                    <div class="form-group">
                        <label for="OrderCustName">{{ __('messages.name') }}</label>
                        <input type="text" name="OrderCustName" required>
                    </div>
                    <div class="form-group">
                        <label for="OrderOrgName">{{ __('messages.organization') }}</label>
                        <input type="text" name="OrderOrgName">
                    </div>
                    <div class="form-group">
                        <label for="OrderEmail">{{ __('messages.email') }}</label>
                        <input type="email" name="OrderEmail" required>
                    </div>
                    <div class="form-group">
                        <label for="OrderPhone">{{ __('messages.phone') }}</label>
                        <input type="text" name="OrderPhone">
                    </div>
                    <div class="form-group">
                        <label for="OrderAddress">{{ __('messages.address') }}</label>
                        <input type="text" name="OrderAddress" required>
                    </div>
                    <div class="form-group">
                        <label for="OrderComment">{{ __('messages.comment') }}</label>
                        <textarea name="OrderComment" rows="4"></textarea>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="custom-btn success-btn">{{ __('messages.Submit_Order') }}</button>
                        <button type="button" id="closeOrderModalButton" class="custom-btn danger-btn">{{ __('messages.cancel') }}</button>
                    </div>
                </form>
            </div>
        </div>
    @else
        <!-- Empty Basket Message -->
        <p class="empty-basket-message">{{ __('messages.empty') }}</p>
    @endif
</div>
@endsection
