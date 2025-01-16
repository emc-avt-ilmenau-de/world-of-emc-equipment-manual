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
        <h2>{{ __('messages.components-tag1') }}</h2>
        <h4>{{ __('messages.components-tag2') }}</h4>

      <!-- Loop through Components -->
@foreach($product->components as $component)
    <div class="component-section">
        <h3>{{ $component->ComponentName }}</h3>
        <div class="component-options">
            <!-- Handling for Software Component -->
            @if($component->ComponentName === __('Software'))
                @foreach($component->componentValues as $value)
                    <div>
                        <input 
                            type="checkbox" 
                            id="{{ Str::slug($component->ComponentName, '_') }}_{{ $value->ComponentValueID }}" 
                            name="components[{{ $component->ComponentID }}][]" 
                            value="{{ $value->ComponentValueID }}" 
                            data-name="{{ $value->ComponentValueName }}"
                            data-price="{{ $value->ComponentValuePrice ?? 0 }}" 
                            {{ strtolower($value->ComponentValueID) === '16' ? 'checked' : '' }}
                        >
                        <label for="{{ Str::slug($component->ComponentName, '_') }}_{{ $value->ComponentValueID }}">
                            {{ $value->ComponentValueName }}
                            @if($value->ComponentValuePrice)
                                (+{{ $value->ComponentValuePrice }} {{ $value->ComponentValueCurrency }})
                            @endif
                        </label>
                    </div>
                @endforeach

            <!-- ✅ Fixed Handling for EMVLED 100 Variants -->
            @elseif($component->ComponentName === "EMVLED 100 Variants" || $component->ComponentName === "EMVLED 100 Varianten")
                @foreach($component->componentValues as $value)
                    <div>
                        <input 
                            type="radio" 
                            id="variant_{{ $value->ComponentValueID }}" 
                            name="components[{{ $component->ComponentID }}]" 
                            value="{{ $value->ComponentValueID }}" 
                            onchange="handleComponentSelection(this, '{{ $value->ComponentValueID }}')"
                        >
                        <label for="variant_{{ $value->ComponentValueID }}">
                            {{ $value->ComponentValueName }}
                        </label>
                    </div>
                @endforeach

            <!-- Default Handling for Other Components -->
            @else
                @foreach($component->componentValues as $value)
                    <div>
                        <input 
                            type="{{ $component->isMultiple ? 'checkbox' : 'radio' }}" 
                            id="{{ Str::slug($component->ComponentName, '_') }}_{{ $value->ComponentValueID }}" 
                            name="components[{{ $component->ComponentID }}]{{ $component->isMultiple ? '[]' : '' }}" 
                            value="{{ $value->ComponentValueID }}" 
                            data-name="{{ $value->ComponentValueName }}"
                            data-price="{{ $value->ComponentValuePrice ?? 0 }}" 
                            onclick="checkObjectAreaInput('{{ $value->ComponentValueName }}', '{{ $component->ComponentID }}')"
                        >
                        <label for="{{ Str::slug($component->ComponentName, '_') }}_{{ $value->ComponentValueID }}">
                            {{ $value->ComponentValueName }}
                            @if($value->ComponentValuePrice)
                                (+{{ $value->ComponentValuePrice }} {{ $value->ComponentValueCurrency }})
                            @endif
                        </label>
                    </div>
                @endforeach
                
                <!-- Custom "Other" Option for All Components -->
                @if($component->allowsCustom)
                    <div>
                        <input 
                            type="radio" 
                            id="{{ Str::slug($component->ComponentName, '_') }}_Other" 
                            name="components[{{ $component->ComponentID }}]" 
                            value="Other" 
                            onclick="showCustomField('{{ $component->ComponentID }}')"
                        >
                        <label for="{{ Str::slug($component->ComponentName, '_') }}_Other">Other</label>
                        <input 
                            type="text" 
                            id="customField_{{ $component->ComponentID }}" 
                            name="custom_components[{{ $component->ComponentID }}]" 
                            placeholder="Specify other value"
                            style="display:none;" 
                            oninput="checkObjectAreaInput(this.value, '{{ $component->ComponentID }}')"
                        >
                        
                        <!-- Object Area Input Field (Only for Component ID 1 and value >= 12mm) -->
                        @if($component->ComponentID == 1)
                            <div id="objectAreaInput_{{ $component->ComponentID }}" style="display:none;">
                                <label for="objectArea_{{ $component->ComponentID }}">{{ __('messages.Object-Area1') }}:</label>
                                <input 
                                    type="text" 
                                    id="objectArea_{{ $component->ComponentID }}" 
                                    name="object_area[{{ $component->ComponentID }}]"
                                >
                            </div>
                        @endif
                    </div>
                @endif
            @endif

            <!-- Learn More Button -->
            @if (!empty($component->localizedMultimedia))
                <button 
                    id="openPopupBtn{{ $component->ComponentID }}" 
                    type="button" 
                    class="openPopupBtn" 
                    comp_multimedia_path="{{ json_encode($component->localizedMultimedia) }}"
                    data-lang="{{ app()->getLocale() }}"
                >
                    {{ __('messages.learn_more') }}
                </button>
            @endif

            <!-- Power Plug as Custom Input -->
            @if ($component->ComponentName === __('Power Plug') || $component->ComponentName === __('Netzanschlussstecker'))
                <a href="https://www.power-plugs-sockets.com/de/united-kingdom/" target="_blank">
                    {{ __('messages.power_plug_info_link') }}
                </a>
                <br><br>
                <label for="powerPlugInput">{{ __('messages.specify_power_plug') }}</label>
                <input 
                    type="text" 
                    id="powerPlugInput" 
                    name="powerPlugInput[{{ $component->ComponentID }}]" 
                    placeholder="{{ __('messages.enter_power_plug') }}" 
                    data-name="{{ __('messages.power_plug') }}" 
                    required
                >
                <small style="color: gray;">{{ __('messages.example_power_plug') }}</small>
                <p id="powerPlugError" style="color: red; display: none;">{{ __('messages.invalid_power_plug') }}</p>
            @endif
        </div>
    </div>
@endforeach

<!-- ✅ Additional Components Section Controlled by Variant 3 -->
<div id="additionalComponentsSection" style="display: none;">

    <!-- ✅ Component 12: Length of Cable Between Driver and Lamp -->
    @foreach($additionalComponents as $additionalComponent)
        @if($additionalComponent->ComponentID == 12)
            <!-- ✅ Using already decoded ComponentName -->
            <div class="component-section">
                <h3>{{ $additionalComponent->ComponentName }}</h3>
                @foreach($additionalComponent->componentValues as $value)
                    <div>
                        <input 
                            type="radio" 
                            name="components[{{ $additionalComponent->ComponentID }}]" 
                            value="{{ $value->ComponentValueID }}"
                            data-name="{{ $value->ComponentValueName }}"
                            data-price="{{ $value->ComponentValuePrice ?? 0 }}"
                        >
                        <label for="component_{{ $value->ComponentValueID }}">
                            {{ $value->ComponentValueName }}
                            @if($value->ComponentValuePrice)
                                (+{{ $value->ComponentValuePrice }} {{ $value->ComponentValueCurrency }})
                            @endif
                        </label>
                    </div>
                @endforeach
            </div>
        @endif
    @endforeach

    <!-- ✅ Component 13: Length of Cable Between Driver and Power Plug -->
    @foreach($additionalComponents as $additionalComponent)
        @if($additionalComponent->ComponentID == 13)
            <!-- ✅ Using already decoded ComponentName -->
            <div class="component-section">
                <h3>{{ $additionalComponent->ComponentName }}</h3>
                @foreach($additionalComponent->componentValues as $value)
                    <div>
                        <input 
                            type="radio" 
                            name="components[{{ $additionalComponent->ComponentID }}]" 
                            value="{{ $value->ComponentValueID }}"
                            data-name="{{ $value->ComponentValueName }}"
                            data-price="{{ $value->ComponentValuePrice ?? 0 }}"
                        >
                        <label for="component_{{ $value->ComponentValueID }}">
                            {{ $value->ComponentValueName }}
                            @if($value->ComponentValuePrice)
                                (+{{ $value->ComponentValuePrice }} {{ $value->ComponentValueCurrency }})
                            @endif
                        </label>
                    </div>
                @endforeach
            </div>
        @endif
    @endforeach
</div>


        <!-- Display Price -->
        <p>{{ __('messages.price') }}: <span id="basePrice">{{ $product->ProductPrice }} {{ $product->ProductCurrency }}</span></p>
        <button type="button" onclick="openModal()" class="basket-button">{{ __('messages.add_to_basket') }}</button>
    </form>

    <!-- Popup for Multimedia -->
    <div id="popup" class="popup-component" style="display: none;">
        <div class="popup-content">
            <!-- Close Button -->
            <span class="popup-close" style="cursor: pointer;">&times;</span>

            <!-- Slideshow container -->
            <div class="popup-slideshow-container">
                @if (!empty($component->localizedMultimedia))
                    <div class="popup-slide" style="display: none;">
                        <!-- Multimedia slides will be dynamically injected -->
                    </div>
                @else
                    <p>{{ __('messages.no_multimedia_available') }}</p>
                @endif
            </div>

            <!-- Navigation buttons -->
            <a class="popup-prev" style="cursor: pointer;">&#10094;</a>
            <a class="popup-next" style="cursor: pointer;">&#10095;</a>
        </div>
    </div>

    <!-- Modal for Confirmation -->
    <div id="productModal" class="modal" style="display:none;">
        <div class="modal-content">
            <h3>{{ __('messages.confirm_selection') }}</h3>
            <p><strong>{{ __('messages.product') }}:</strong> <span id="modalProductName">{{ $product->ProductName }}</span></p>
            <p><strong>{{ __('messages.base_price') }}:</strong> {{ $product->ProductPrice }} {{ $product->ProductCurrency }}</p>

            <!-- Components Summary -->
            <div id="modalComponents"></div>

            <!-- Total Price -->
            <p><strong>{{ __('messages.total_price') }}:</strong> <span id="modalTotalPrice"></span></p>

            <!-- Buttons -->
            <button type="button" onclick="closeModal()">{{ __('messages.close') }}</button>
            <button type="submit" form="addToBasketForm">{{ __('messages.confirm') }}</button>
        </div>
    </div>

    <a href="{{ route('home') }}">{{ __('messages.back_to_products') }}</a>
</div>


        
    </main>
</div>


@endsection


