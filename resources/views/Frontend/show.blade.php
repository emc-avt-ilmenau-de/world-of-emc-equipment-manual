<!-- resources/views/FrontEnd/product/show.blade.php -->
@extends('FrontEnd.layouts.main') <!-- Correctly extends the main layout -->

@section('main-container')
<div class="product-show">
    <div class="productname-display">
    <h1>{{ $product->ProductName }}</h1> <!-- Display the product name -->
    </div>
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
     
      
      <div class="product-details">
      <form id="addToBasketForm" action="{{ route('product.submit', ['id' => $product->ProductID]) }}" method="POST">
    @csrf
      
      <h2>Most of the components are included on the base price, except some.</h2>
      <h4>Please choose  Components:</h4>
         <!-- Display Components and their Values -->
          <!-- Loop through each component -->
    @foreach($product->components as $component)
        <div class="component-section">
            <h2>{{ $component->ComponentName }}</h2>

            <!-- Apply specific styling and input type based on the component name -->
            <div class="component-options">
            @if($component->ComponentName === '4K Minicam Lens')
    <div class="lens-options">
        @foreach($component->values as $value)
            <input type="radio" id="lens_{{ $value->ComponentValueID }}" name="lens_option" value="{{ $value->ComponentValueName }}"
                onclick="checkLensOther('{{ $value->ComponentValueName }}')">
            <label for="lens_{{ $value->ComponentValueID }}">{{ $value->ComponentValueName }}</label><br>
        @endforeach
        <br>
        <!-- Input field for custom "Other" value -->
        <div id="lensOtherFieldDiv" style="display:none;">
            <input type="text" id="lensOtherField" name="components[1][lens_otherField]" placeholder="Please specify lens value" required>
        </div>
    </div>
                            
                @elseif($component->ComponentName === 'Fiber Optics')
                    <!-- Custom layout for Fiber Optics options -->
                    <div class="fiber-optics-options">
                        @foreach($component->values as $value)
                            <input type="radio" id="fiber_{{ $value->ComponentValueID }}" name="fiber_option" value="{{ $value->ComponentValueID }}">
                            <label for="fiber_{{ $value->ComponentValueID }}">{{ $value->ComponentValueName }} @if($value->ComponentValuePrice) (+ {{ $value->ComponentValuePrice }} {{ $value->ComponentValueCurrency }}) @endif</label><br>
                        @endforeach
                    </div>

                @elseif($component->ComponentName === 'Power Supply')
                    <!-- Custom layout for Power Supply options -->
                    <div class="power-supply-options">
                        @foreach($component->values as $value)
                            <input type="radio" id="power_{{ $value->ComponentValueID }}" name="power_option" value="{{ $value->ComponentValueID }}">
                            <label for="power_{{ $value->ComponentValueID }}">{{ $value->ComponentValueName }}</label><br>
                        @endforeach
                    </div>
                    @elseif($component->ComponentName === 'Power Plug')
    <div class="power-plug-options">
        <label for="powerPlugInput">Please specify your Power Plug choice:</label><br><br> 
        <a href="https://www.power-plugs-sockets.com/de/united-kingdom/" target="_blank">Please click here to learn more about power plug types</a>
        <br><br>
        <input type="text" id="powerPlugInput" name="components[{{ $component->ComponentID }}][power_plug]" placeholder="Enter Power Plug Type" required>
    </div>

                    @elseif($component->ComponentName === 'Geographic area for power')
    <div class="geo-area-options">
        @foreach($component->values as $value)
            <input type="radio" id="geo_{{ $value->ComponentValueID }}" name="components[{{ $component->ComponentID }}][geo_option]" value="{{ $value->ComponentValueName }}"
                onclick="checkGeoOther('{{ $value->ComponentValueName }}')">
            <label for="geo_{{ $value->ComponentValueID }}">{{ $value->ComponentValueName }}</label><br>
        @endforeach

        <!-- Input field for custom "Other" value -->
        <div id="geoOtherFieldDiv" style="display:none;">
            <input type="text" id="geoOtherField" name="components[5][geo_otherField]" placeholder="Specify value" required>
        </div>
    </div>


                @elseif($component->ComponentName === 'Software')
                    <!-- Custom layout for Software options -->
                    <div class="software-options">
                        @foreach($component->values as $value)
                            <input type="checkbox" id="software_{{ $value->ComponentValueID }}" name="software_option[]" value="{{ $value->ComponentValueID }}">
                            <label for="software_{{ $value->ComponentValueID }}">{{ $value->ComponentValueName }} @if($value->ComponentValuePrice) ({{ $value->ComponentValuePrice }} {{ $value->ComponentValueCurrency }}) @endif</label><br>
                        @endforeach
                    </div>
                @else
                    <!-- Default layout for any other components -->
                    <div class="default-component-options">
                        @foreach($component->values as $value)
                            <input type="radio" id="default_{{ $value->ComponentValueID }}" name="default_option_{{ $component->ComponentID }}" value="{{ $value->ComponentValueID }}">
                            <label for="default_{{ $value->ComponentValueID }}">{{ $value->ComponentValueName }}</label><br>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    @endforeach

   

      <br>

      <h1>{{ __('messages.price') }}</h1>

      <p>{{ __('messages.price') }}: {{ $product->ProductPrice }} {{ $product->ProductCurrency }}</p>

        <button   type="button" id="addToBasketForm" class="basket-button">Add To Basket</button> 
        <br>
        <br>
        </form>

        <!-- Modal -->
<div id="productModal" class="modal" style="display:none;">
    <div class="modal-content">
        <h3>Confirm Your Selection</h3>
        <p id="modalProductName"></p>
        <p id="modalProductPrice"></p>
        <div id="modalComponents"></div>
        <button type="button" onclick="closeModal()">Close</button>
        <button id="confirmAddToBasket">Confirm</button>
    </div>
</div>

        <a href="{{ route('home') }}">Back to Products</a> <!-- Link back to product listing -->
      </div>
      
      
</div>
</main>
@endsection
