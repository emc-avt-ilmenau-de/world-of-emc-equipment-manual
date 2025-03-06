<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>EMC WEB</title>
    <!-- Corrected stylesheet link -->
    <link rel="stylesheet" href="{{ asset('Frontend/css/styles.css') }}" />
</head>

<body>
    <div class="wrapper">

        <header>
            <div class="language-switcher">
                <a href="{{ route('set.locale', ['locale' => 'en']) }}">English</a> |
                <a href="{{ route('set.locale', ['locale' => 'de']) }}">Deutsch</a>
            </div>

            <h1>@lang('messages.welcome')</h1>
            <h4>{{ __('messages.tagline') }}</h4>

            <nav>
                <ul>
                    <li><a href="{{ url('/') }}">{{ __('messages.home') }}</a></li>
                    <li><a href="/about">{{ __('messages.about') }}</a></li>

                    {{-- Product Categories Dropdown --}}
                    @if(isset($categories) && $categories->isNotEmpty())
                    <li class="dropdown">
                        <a href="/" class="dropbtn">{{ __('messages.product') }}</a>
                        <div class="dropdown-content">
                            @foreach ($categories as $category)
                            <div class="dropdown-submenu">
                                <a href="{{ url('/') }}?category={{ strtolower(str_replace(' ', '-', $category->CategoryName)) }}">
                                    {{ $category->CategoryName }}
                                </a>

                                {{-- Show related products in a sub-dropdown --}}
                                {{--@if($category->products->isNotEmpty())
                                <div class="dropdown-subcontent">
                                    @foreach ($category->products as $product)
                                    <a href="{{ route('product.show', ['id' => $product->ProductID]) }}">
                                {{ $product->LocalizedProductName ?? '$product->LocalizedProductName' }}
                                </a>
                                @endforeach
                            </div>
                            @endif
                            --}}
                        </div>
                        @endforeach
    </div>
    </li>
    @endif
    <li><a href="/downloads">{{ __('messages.downloads') }}</a></li>
    <li><a href="/partner">Our Partners</a></li>
    <li><a href="/basket">{{ __('messages.basket') }}</a></li>
    </ul>

    {{-- Logo --}}
    <img src="{{ asset('Frontend/images/AVT_EMC_Logo2.png') }}" alt="AVT Logo" class="logo" />
    </nav>


    </header>
    </div>


    <!-- Corrected script file reference -->
    <script src="{{ asset('Frontend/js/script.js') }}"></script>
</body>

</html>