@extends('FrontEnd.layouts.main')
@section('main-container')
<div class="products">
    <main>
        <section id="all-products" class="product-category">
            <h2 id="all-products-heading">{{ __('messages.all-product') }}</h2>

            <!-- Debugging: Display Current Locale -->
            <p>Current Locale: {{ App::getLocale() }}</p>
            <p>Session Locale: {{ session('locale') }}</p>
            
            <!-- Cameras Category -->
            <div id="camera-category" class="category-group">
                <h3>{{ __('messages.camera') }}</h3>
                <div class="product-row">
                    @foreach ($products->where('CategoryID', 1) as $product)
                        <div class="product-item camera">
                            <h4>{{ $product->ProductName }}</h4>
                            <a href="{{ route('product.show', ['id' => $product->ProductID]) }}">
                            <img src="{{ asset($product->ProductHomeImagePath) }}" alt="{{ $product->ProductName }}" />
                            </a>
                            <p>{{ $product->minidescription }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
            
            <!-- LED Category -->
            <div id="led-category" class="category-group">
                <h3>LED</h3>
                <div class="product-row">
                    @foreach ($products->where('CategoryID', 2) as $product)
                        <div class="product-item led">
                            <h4>{{ $product->ProductName }}</h4>
                            <a href="{{ route('product.show', ['id' => $product->ProductID]) }}">
                            <img src="{{ asset($product->ProductHomeImagePath) }}" alt="{{ $product->ProductName }}" />
                            </a>
                            <p>{{ $product->minidescription }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Other Category -->
            <div id="other-category" class="category-group">
                <h3>{{ __('messages.other') }}</h3>
                <div class="product-row">
                    @foreach ($products->where('CategoryID', 3) as $product)
                        <div class="product-item other">
                            <h4>{{ $product->ProductName }}</h4>
                            <a href="{{ route('product.show', ['id' => $product->ProductID]) }}">
                            <img src="{{ asset($product->ProductHomeImagePath) }}" alt="{{ $product->ProductName }}" />
                            </a>
                            <p>{{ $product->minidescription }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </main>
</div>
@endsection
