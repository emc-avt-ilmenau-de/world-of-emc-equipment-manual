@extends('Frontend.layouts.main')

@section('content')
<div class="basket">
    <h2>Your Basket</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Debugging Session Data --}}
    <pre>{{ print_r(session('basket'), true) }}</pre>

    @if(!empty($basket) && count($basket) > 0)
        @foreach($basket as $item)
            <div class="product">
                <h3>Product: {{ $item['product_name'] }}</h3>
                <p>Product Price: {{ number_format($item['product_price'], 2) }} {{ $item['currency'] }}</p>

                @php
                    $itemSubtotal = $item['product_price'] * $item['quantity'];
                @endphp

                @foreach($item['components'] as $component)
                    <div class="product-details">
                        <p>{{ $component['component_name'] }}: {{ $component['value_name'] }}</p>
                        @if ($component['value_price'] > 0)
                            <p>(+ {{ number_format($component['value_price'], 2) }} {{ $item['currency'] }})</p>
                            @php
                                $itemSubtotal += ($component['value_price'] * $item['quantity']);
                            @endphp
                        @endif
                    </div>
                @endforeach

                <h4>Subtotal for {{ $item['product_name'] }}: {{ number_format($itemSubtotal, 2) }} {{ $item['currency'] }}</h4>
                <h3>Total Price: {{ number_format($item['total_price'], 2) }} {{ $item['currency'] }}</h3>
                <p>Quantity: {{ $item['quantity'] }}</p>
            </div>
        @endforeach

        <h3>Grand Total: {{ number_format($totalPrice, 2) }} EUR</h3>
    @else
        <p>Your basket is empty.</p>
    @endif
</div>
@endsection
