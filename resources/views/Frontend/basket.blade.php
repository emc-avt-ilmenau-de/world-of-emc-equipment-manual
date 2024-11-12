@extends('Frontend.layouts.main')

@section('main-container')
<div class="basket-container">
    <h1>Your Basket</h1>

    @if (count($basket['components']) > 0)
        <table class="basket-table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Components</th>
                    <th>Component Values</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($basket['components'] as $productId => $item)
                    <tr>
                        <td>{{ $item['product']->ProductName }}</td>
                        <td>
                            @foreach ($item['product']->components as $component)
                                <p>{{ $component->ComponentName }}</p>
                            @endforeach
                        </td>
                        <td>
                            @foreach ($item['product']->components as $component)
                                @foreach ($item['component_values'] ?? [] as $valueId => $value)
                                    @if ($component->ComponentID == $valueId)
                                        <p>{{ $value->ComponentValueName }}</p>
                                    @endif
                                @endforeach
                            @endforeach
                        </td>
                        <td>{{ number_format($item['product']->ProductPrice, 2) }} {{ $item['product']->ProductCurrency }}</td>
                        <td>
                            <form action="{{ route('basket.update', ['productId' => $productId]) }}" method="POST">
                                @csrf
                                <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1">
                                <button type="submit">Update</button>
                            </form>
                        </td>
                        <td>{{ number_format($item['totalPrice'], 2) }} {{ $item['product']->ProductCurrency }}</td>
                        <td>
                            <form action="{{ route('basket.remove', ['productId' => $productId]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure you want to remove this item?')">Remove</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="basket-summary">
            <h3>Total Price: {{ number_format($basket['totalPrice'], 2) }} {{ $item['product']->ProductCurrency }}</h3>
        </div>
    @else
  
        <p>Your basket is empty.</p>
    @endif
</div>
@endsection
