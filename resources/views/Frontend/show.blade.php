<!-- resources/views/FrontEnd/product/show.blade.php -->
@extends('FrontEnd.layouts.main') <!-- Correctly extends the main layout -->

@section('main-container')
<div class="product-show">
    <h1>{{ $product->ProductName }}</h1> <!-- Display the product name -->
    <main class="main-content">
      <div class="product-image">
      <div class="slideshow-container">

    @if (!empty($product->multimedia))
        @foreach ($product->multimedia as $key => $media)
            <div class="mySlides fade">
                <div class="numbertext">{{ $loop->iteration }} / {{ count($product->multimedia) }}</div>
                <br>
                <br>
                @if (strpos($media['path'], '.mp4') !== false)
                    <video width="1000" height="644" controls>
                        <source src="{{ asset(str_replace('\\', '/', $media['path'])) }}" type="video/mp4">
                        <source src="{{ asset(str_replace('\\', '/', $media['path'])) }}" type="video/ogg">
                        Your browser does not support the video tag.
                    </video>
                @else
                    <img src="{{ asset(str_replace('\\', '/', $media['path'])) }}" style="width:80%">
                @endif
                
                <br>
                <br>
                <br>
                <div class="text">{{ $media['caption'] }}</div>
            </div>
        @endforeach
    @else
        <p>No multimedia available for this product.</p>
    @endif

    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
    <a class="next" onclick="plusSlides(1)">&#10095;</a>
</div>
              <!-- Display mini description -->
     <h2>{{ $product->minidescription }}</h2>

                <!-- Display Features only if they exist -->
        @if (isset($product->description['Features']) && !empty($product->description['Features']))
            <h3>Features:</h3>
            <ul>
                @foreach ($product->description['Features'] as $feature)
                    <li>{{ $feature }}</li>
                @endforeach
            </ul>
        @elseif (isset($product->description['Eigenschaften:']) && !empty($product->description['Eigenschaften:']))
            <h3>Eigenschaften:</h3>
            <ul>
                @foreach ($product->description['Eigenschaften:'] as $feature)
                    <li>{{ $feature }}</li>
                @endforeach
            </ul>
        @endif

        <!-- Display Options only if they exist -->
        @if (isset($product->description['Options']) && !empty($product->description['Options']))
            <h3>Options:</h3>
            <ul>
                @foreach ($product->description['Options'] as $option)
                    <li>{{ $option }}</li>
                @endforeach
            </ul>
        @elseif (isset($product->description['Optionen:']) && !empty($product->description['Optionen:']))
            <h3>Optionen:</h3>
            <ul>
                @foreach ($product->description['Optionen:'] as $option)
                    <li>{{ $option }}</li>
                @endforeach
            </ul>
        @endif

        <!-- Display Additional Services only if they exist -->
        @if (isset($product->description['Additional services']) && !empty($product->description['Additional services']))
            <h3>Additional services:</h3>
            <ul>
                @foreach ($product->description['Additional services'] as $additionalService)
                    <li>{{ $additionalService }}</li>
                @endforeach
            </ul>
        @elseif (isset($product->description['Zusätzliche Dienstleistungen:']) && !empty($product->description['Zusätzliche Dienstleistungen:']))
            <h3>Zusätzliche Dienstleistungen:</h3>
            <ul>
                @foreach ($product->description['Zusätzliche Dienstleistungen:'] as $additionalService)
                    <li>{{ $additionalService }}</li>
                @endforeach
            </ul>
        @endif

        <!-- Display Warranty only if it exists -->
        @if (isset($product->description['Warranty']) && !empty($product->description['Warranty']))
            <h3>Warranty:</h3>
            <ul>
                @foreach ($product->description['Warranty'] as $warranty)
                    <li>{{ $warranty }}</li>
                @endforeach
            </ul>
        @elseif (isset($product->description['Garantie:']) && !empty($product->description['Garantie:']))
            <h3>Garantie:</h3>
            <ul>
                @foreach ($product->description['Garantie:'] as $warranty)
                    <li>{{ $warranty }}</li>
                @endforeach
            </ul>
        @endif

      

      </div>
     
    
    <a href="{{ route('home') }}">Back to Products</a> <!-- Link back to product listing -->
</div>
</main>
@endsection
