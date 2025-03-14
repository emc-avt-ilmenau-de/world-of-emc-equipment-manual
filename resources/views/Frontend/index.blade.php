@extends('FrontEnd.layouts.main')

@section('main-container')
<div class="products">
    <main>
        <section id="all-products" class="product-category">
            <h2 id="all-products-heading">{{ __('messages.all-product') }}</h2>

            @if(isset($categories) && isset($products) && $categories->isNotEmpty())
            @foreach ($categories as $category)
            @php
            $categorySlug = strtolower(str_replace(' ', '-', $category->CategoryName));
            $categoryProducts = $products->where('CategoryID', $category->CategoryID);
            @endphp

            @if ($categoryProducts->isNotEmpty())
            <div id="{{ $categorySlug }}-category" class="category-group">
                <h3>{{ $category->CategoryName }}</h3>
                <div class="product-row">
                    @foreach ($categoryProducts as $product)
                    <div class="product-item">
                        <h4>{{ $product->ProductName }}</h4>
                        <a href="{{ route('product.show', ['id' => $product->ProductID]) }}">
                            <img src="{{ asset($product->ProductHomeImagePath) }}" alt="{{ $product->ProductName }}" />
                        </a>
                        <p>{{ $product->minidescription ?? 'No description available' }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
            @endforeach
            @else
            <p>No categories or products found.</p>
            @endif
        </section>
    </main>
</div>
@endsection