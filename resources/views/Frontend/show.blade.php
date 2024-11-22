<!-- resources/views/FrontEnd/product/show.blade.php -->
@extends('FrontEnd.layouts.main')

@section('main-container')
<div class="product-show">
    <div class="productname-display">
        <h1>{{ $product->ProductName }}</h1>
    </div>
    <main class="main-content">
        <div class="product-image">
            <div class="slideshow-container">
                @if (!empty($product->multimedia))
                    @foreach ($product->multimedia as $key => $media)
                        <div class="mySlides fade">
                            <div class="numbertext">{{ $loop->iteration }} / {{ count($product->multimedia) }}</div>
                            @if (strpos($media['path'], '.mp4') !== false)
                                <video width="1000" height="644" controls>
                                    <source src="{{ asset(str_replace('\\', '/', $media['path'])) }}" type="video/mp4">
                                    <source src="{{ asset(str_replace('\\', '/', $media['path'])) }}" type="video/ogg">
                                    Your browser does not support the video tag.
                                </video>
                            @else
                                <img src="{{ asset(str_replace('\\', '/', $media['path'])) }}" style="width:80%">
                            @endif
                            <div class="text">{{ $media['caption'] }}</div>
                        </div>
                    @endforeach
                @else
                    <p>No multimedia available for this product.</p>
                @endif
                <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                <a class="next" onclick="plusSlides(1)">&#10095;</a>
            </div>

            <h2>{{ $product->minidescription }}</h2>

            <!-- Features, Options, Additional Services, and Warranty sections -->
            @foreach(['Features', 'Eigenschaften:', 'Options', 'Optionen:', 'Additional services', 'Zusätzliche Dienstleistungen:', 'Warranty', 'Garantie:'] as $section)
                @if (isset($product->description[$section]) && !empty($product->description[$section]))
                    <h3>{{ __($section) }}</h3>
                    <ul>
                        @foreach ($product->description[$section] as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </ul>
                @endif
            @endforeach
        </div>

        <div class="product-details">
            <form id="addToBasketForm" action="{{ route('product.submit', ['id' => $product->ProductID]) }}" method="POST">
                @csrf
                <h2>Most of the components are included in the base price, except some.</h2>
                <h4>Please choose Components:</h4>

                <!-- Display Components and their Values -->
                @foreach($product->components as $component)
                    <div class="component-section">
                        <h2>{{ $component->ComponentName }}</h2>
                        <div class="component-options">
                            @switch($component->ComponentName)
                                @case('4K Minicam Lens')
                                    <div class="lens-options">
                                        @foreach($component->values as $value)
                                            <input type="radio" id="lens_{{ $value->ComponentValueID }}" name="lens_option" value="{{ $value->ComponentValueName }}" data-price="{{ $value->ComponentValuePrice ?? 0 }}" onclick="checkLensOther('{{ $value->ComponentValueName }}')">
                                            <label for="lens_{{ $value->ComponentValueID }}">{{ $value->ComponentValueName }}</label><br>
                                        @endforeach
                                        <div id="lensOtherFieldDiv" style="display:none;">
                                            <input type="text" id="lensOtherField" name="components[1][lens_otherField]" placeholder="Please specify lens value" required>
                                        </div>
                                    </div>
                                    @break

                                @case('Fiber Optics')
                                    <div class="fiber-optics-options">
                                        @foreach($component->values as $value)
                                            <input type="radio" id="fiber_{{ $value->ComponentValueID }}" name="fiber_option" value="{{ $value->ComponentValueID }}" data-price="{{ $value->ComponentValuePrice ?? 0 }}">
                                            <label for="fiber_{{ $value->ComponentValueID }}">{{ $value->ComponentValueName }} @if($value->ComponentValuePrice) (+ {{ $value->ComponentValuePrice }} {{ $value->ComponentValueCurrency }}) @endif</label><br>
                                        @endforeach
                                    </div>
                                    @break

                                @case('Power Supply')
                                    <div class="power-supply-options">
                                        @foreach($component->values as $value)
                                            <input type="radio" id="power_{{ $value->ComponentValueID }}" name="power_option" value="{{ $value->ComponentValueID }}" data-price="{{ $value->ComponentValuePrice ?? 0 }}">
                                            <label for="power_{{ $value->ComponentValueID }}">{{ $value->ComponentValueName }}</label><br>
                                        @endforeach
                                    </div>
                                    @break

                                @case('Power Plug')
                                    <div class="power-plug-options">
                                        <label for="powerPlugInput">Please specify your Power Plug choice:</label>
                                        <a href="https://www.power-plugs-sockets.com/de/united-kingdom/" target="_blank">Learn more about power plug types</a><br>
                                        <input type="text" id="powerPlugInput" name="components[{{ $component->ComponentID }}][power_plug]" data-price="0" placeholder="Enter Power Plug Type" required>
                                    </div>
                                    @break

                                @case('Geographic area for power')
                                    <div class="geo-area-options">
                                        @foreach($component->values as $value)
                                            <input type="radio" id="geo_{{ $value->ComponentValueID }}" name="components[{{ $component->ComponentID }}][geo_option]" value="{{ $value->ComponentValueName }}" data-price="{{ $value->ComponentValuePrice ?? 0 }}" onclick="checkGeoOther('{{ $value->ComponentValueName }}')">
                                            <label for="geo_{{ $value->ComponentValueID }}">{{ $value->ComponentValueName }}</label><br>
                                        @endforeach
                                        <div id="geoOtherFieldDiv" style="display:none;">
                                            <input type="text" id="geoOtherField" name="components[5][geo_otherField]" placeholder="Specify value" required>
                                        </div>
                                    </div>
                                    @break

                                @case('Software')
                                    <div class="software-options">
                                        @foreach($component->values as $value)
                                            <input type="checkbox" 
                                                id="software_{{ $value->ComponentValueID }}" 
                                                name="software_option[]" 
                                                value="{{ $value->ComponentValueID }}" data-price="{{ $value->ComponentValuePrice ?? 0 }}"  
                                                @if(trim($value->ComponentValueName) === 'Basic') checked @endif>
                                            <label for="software_{{ $value->ComponentValueID }}">
                                                {{ $value->ComponentValueName }} 
                                                @if($value->ComponentValuePrice) 
                                                    ({{ $value->ComponentValuePrice }} {{ $value->ComponentValueCurrency }}) 
                                                @endif
                                            </label><br>
                                        @endforeach
                                    </div>
                                @break

                                @default
                                    <div class="default-component-options">
                                        @foreach($component->values as $value)
                                            <input type="radio" id="default_{{ $value->ComponentValueID }}" name="default_option_{{ $component->ComponentID }}" value="{{ $value->ComponentValueID }}" data-price="{{ $value->ComponentValuePrice ?? 0 }}">
                                            <label for="default_{{ $value->ComponentValueID }}">{{ $value->ComponentValueName }}</label><br>
                                        @endforeach
                                    </div>
                            @endswitch
                        </div>
                    </div>
                @endforeach

                <p>{{ __('messages.price') }}: <span id="basePrice">{{ $product->ProductPrice }} {{ $product->ProductCurrency }}</span></p>
                <button type="button" onclick="openModal()" class="basket-button">Add To Basket</button>

            </form>

            <!-- Modal for confirmation -->
            <div id="productModal" class="modal" style="display:none;">
                <div class="modal-content">
                    <h3>Confirm Your Selection</h3>
                    
                    <!-- Product and Total Price Details -->
                    <p><strong>Product:</strong> <span id="modalProductName">{{ $product->ProductName }}</span></p>
                    <p><strong>Product Price:</strong> <span id="modalProductPrice">{{ $product->ProductPrice }} {{ $product->ProductCurrency }}</span></p>
                    
                    <!-- Container for selected components -->
                    <div id="modalComponents"></div>

                    <!-- Display the total calculated price -->
                    <p><strong>Total Price:</strong> <span id="modalTotalPrice">{{ $product->ProductCurrency }}</span></p>
                    
                    <!-- Close and Confirm buttons -->
                    <button type="button" onclick="closeModal()">Close</button>
                    <button id="confirmAddToBasket" onclick="submitForm()">Confirm</button>
                </div>
            </div>
            <a href="{{ route('home') }}">Back to Products</a>
        </div>
    </main>
</div>
@endsection
