@extends('Frontend.layouts.main')

@section('main-container')
<div class="basket">
    <h2>Your Basket</h2>

    {{-- Display success or error messages --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    {{-- Check if the basket is not empty --}}
    @if(!empty($basket) && count($basket) > 0)
        {{-- Loop through each product in the basket --}}
        @foreach($basket as $index => $item)
            <div class="basket-item">
                <h3>Product: {{ $item['product_name'] ?? 'No Product Name' }}</h3>
                <p><strong>Base Price:</strong> {{ number_format($item['base_price'], 2) }} EUR</p>
                
                {{-- Display the components for each product --}}
                <ul>
                    @foreach($item['components'] as $component)
                        <li>
                            <strong>{{ $component['name'] ?? 'Component Name Missing' }}:</strong>
                            {{-- Handle array values for 'value' --}}
                            @if(is_array($component['value']))
                                {{ implode(', ', $component['value']) }}
                            @else
                                {{ $component['value'] }}
                            @endif
                            ({{ number_format($component['price'], 2) }} EUR)
                        </li>
                        
                    @endforeach

                    <p><strong>Total Price:</strong> {{ number_format($item['total_price'], 2) }} EUR</p>

                </ul>

                {{-- Remove item form --}}
                <form action="{{ route('basket.remove', ['productId' => $item['product_id']]) }}" method="POST" class="remove-item-form">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Remove Item</button>
                </form>
            </div>
            <hr>
        @endforeach

      
    @else
        <p>Your basket is empty or no data is available in the session.</p>
    @endif
</div>
@endsection
