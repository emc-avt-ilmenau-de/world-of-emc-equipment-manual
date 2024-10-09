@extends('FrontEnd.layouts.main')
@section('main-container')
<div class="products">
    <main>
        <section id="all-products" class="product-category">
            <h2 id="all-products-heading">All Products</h2>
               <!-- Debugging: Display Current Locale -->
<p>Current Locale: {{ App::getLocale() }}</p>
<p>Session Locale: {{ session('locale') }}</p>

            @foreach ($products as $product)
                <div class="product">
                    <h2>{{ $product->ProductName }}</h2>

                    <!-- Display product image -->
                    <img src="{{ asset($product->ProductHomeImagePath) }}" alt="{{ $product->ProductName }}">

                    <!-- Display mini description -->
                    <h1>{{ $product->minidescription }}</h1>

                    <!-- Display price -->
                    <p>Price: {{ $product->ProductPrice }} {{ $product->ProductCurrency }}</p>

                    <!-- Display features only if they exist -->
                    @if (isset($product->description['Features']))
                        <h3>Features:</h3>
                        <ul>
                            @foreach ($product->description['Features'] as $feature)
                                <li>{{ $feature }}</li>
                            @endforeach
                        </ul>
                    @else
                    <h3>Eigenschaften:</h3>
                        <ul>
                            @foreach ($product->description['Eigenschaften:'] as $feature)
                                <li>{{ $feature }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <!-- Display options only if they exist -->
                    @if (isset($product->description['Options']))
                        <h3>Options:</h3>
                        <ul>
                            @foreach ($product->description['Options'] as $option)
                                <li>{{ $option }}</li>
                            @endforeach
                        </ul>
                    @else
                    <h3>Optionen:</h3>
                    <ul>
                            @foreach ($product->description['Optionen:'] as $option)
                                <li>{{ $option }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            @endforeach
        </section>
    </main>
</div>
@endsection
