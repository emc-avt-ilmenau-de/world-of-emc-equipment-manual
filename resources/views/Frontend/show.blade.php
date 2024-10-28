<!-- resources/views/FrontEnd/product/show.blade.php -->
@extends('FrontEnd.layouts.main') <!-- Correctly extends the main layout -->

@section('main-container')
<div class="product-show">
    <h1>{{ $product->ProductName }}</h1> <!-- Display the product name -->
    <img src="{{ asset($product->ProductImagePath) }}" alt="{{ $product->ProductName }}" /> <!-- Display the product image -->
    <p>{{ $product->description }}</p> <!-- Display the product description -->
    
    <a href="{{ route('home') }}">Back to Products</a> <!-- Link back to product listing -->
</div>
@endsection
