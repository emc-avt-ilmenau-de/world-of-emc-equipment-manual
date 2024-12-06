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

    <!-- Loop through Components -->
    @foreach($product->components as $component)
        <div class="component-section">
            <h3>{{ $component->ComponentName }}</h3>
            @if (!empty($component->localizedMultimedia))
                <!-- Learn More button that triggers the popup -->
                <button class="learn-more-btn" data-product-id="{{ $component->id }}">Learn More</button>
            @else
                <p>No multimedia available.</p>
            @endif
            <div class="component-options">
                
                @foreach($component->values as $value)
                    <div>
                        <input 
                            type="{{ $component->isMultiple ? 'checkbox' : 'radio' }}" 
                            id="{{ $component->ComponentName }}_{{ $value->ComponentValueID }}" 
                            name="components[{{ $component->ComponentID }}]{{ $component->isMultiple ? '[]' : '' }}" 
                            value="{{ $value->ComponentValueID }}" 
                            data-name="{{ $value->ComponentValueName }}"
                            data-price="{{ $value->ComponentValuePrice ?? 0 }}" 
                            onclick="updatePrice()"
                        >
                        <label for="{{ $component->ComponentName }}_{{ $value->ComponentValueID }}">
                            {{ $value->ComponentValueName }}
                            @if($value->ComponentValuePrice)
                                (+{{ $value->ComponentValuePrice }} {{ $value->ComponentValueCurrency }})
                            @endif
                        </label>
                    </div>
                @endforeach

                 <!-- Custom "Other" Option -->
            @if($component->allowsCustom)
            
                <div>
                    <input 
                        type="radio" 
                        id="{{ $component->ComponentName }}_Other" 
                        name="components[{{ $component->ComponentID }}]" 
                        value="Other" 
                        onclick="showCustomField('{{ $component->ComponentID }}')"
                    >
                    <label for="{{ $component->ComponentName }}_Other">Other</label>
                    <br><br>
                    <input 
                        type="text" 
                        id="customField_{{ $component->ComponentID }}" 
                        name="custom_components[{{ $component->ComponentID }}]" 
                        placeholder="Please specify" 
                        style="display:none;" 
                        oninput="validateCustomInput('{{ $component->ComponentName }}')"
                        >
                    
                </div>
            @endif   
           
                <!-- Power Plug as Custom Input -->
                @if($component->ComponentName === 'Power Plug')
                <a href="https://www.power-plugs-sockets.com/de/united-kingdom/" target="blank">Please visit this link to learn more about power plug types </a><br><br>
                    <label for="powerPlugInput">Please specify your Power Plug choice:</label>
                    <input 
                        type="text" 
                        id="powerPlugInput" 
                        name="powerPlugInput[{{ $component->ComponentID }}]" 
                        placeholder="Enter Power Plug Type" 
                        data-name="Power Plug" 
                        required
                        oninput="updatePrice()"
                    >
                @endif
            </div>
        </div>
    @endforeach

    <!-- Display Price -->
    <p>{{ __('messages.price') }}: <span id="basePrice">{{ $product->ProductPrice }} {{ $product->ProductCurrency }}</span></p>
    <button type="button" onclick="openModal()" class="basket-button">Add To Basket</button>
</form>

<!-- Modal Structure -->
<div id="popup-modal" class="popup-modal" style="display: none;">
    <div class="popup-content">
        <span class="popup-close">&times;</span>
        <div id="popupSlidesContainer" class="slideshow-container"></div>
        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>
    </div>
</div>
<!-- Modal for Confirmation -->
<div id="productModal" class="modal" style="display:none;">
    <div class="modal-content">
        <h3>Confirm Your Selection</h3>
        <p><strong>Product:</strong> <span id="modalProductName">{{ $product->ProductName }}</span></p>
        <p><strong>Base Price:</strong> {{ $product->ProductPrice }} {{ $product->ProductCurrency }}</p>
        
        <!-- Components Summary -->
        <div id="modalComponents"></div>
        
        <!-- Total Price -->
        <p><strong>Total Price:</strong> <span id="modalTotalPrice"></span></p>

        <!-- Buttons -->
        <button type="button" onclick="closeModal()">Close</button>
        <button type="submit" form="addToBasketForm">Confirm</button>
    </div>
</div>
            <a href="{{ route('home') }}">Back to Products</a>
        </div>
    </main>
</div>
@endsection
