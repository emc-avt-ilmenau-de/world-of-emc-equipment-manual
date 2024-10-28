<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>EMC WEB</title>
    <link rel="stylesheet" href="Frontend/css/styles.css" />
  </head>
  <body>
    <div class="wrapper">
      <header>
      <div class="language-switcher">
      <a href="{{route('set.locale',  ['locale' => 'en']) }}">English</a> | <a href="{{ route('set.locale', ['locale' => 'de']) }}">Deutsch</a>
</div>
        <h1>@lang('messages.welcome')</h1>
        
        <h4>{{ __('messages.tagline') }}</h4>
        
        <nav>
          <ul>
            <li><a href="/">{{ __('messages.home') }}</a></li>
            <li><a href="/about">{{ __('messages.about') }}</a></li>
            <li class="dropdown">
              <a href="/" class="dropbtn">{{ __('messages.product') }}</a>
              <div class="dropdown-content">
                 <!-- Camera Dropdown with Submenu -->
                 <div class="dropdown-submenu">
                  <a href="/?category=camera">Camera</a>
                  <div class="dropdown-subcontent">
                    <a href="/minicam">4K Mini Cam</a>
                    <a href="/thermocam">Thermal Cam</a>
                  </div>
                  </div>
                  <!-- Led Dropdown with Submenu -->
                  <div class="dropdown-submenu">
                <a href="/?category=led">LED</a>
                <div class="dropdown-subcontent">
                    <a href="/lamp100">Lamp EMVLED 100</a>
                    <a href="/lamp75">Lamp EMVLED 75</a>
                    <a href="/lamp24">Lamp EMVLED 24/40</a>
                    <a href="/leddriver">EMC LED Driver</a>
                  </div>
                </div>
                <a href="/?category=software">Software</a>
                 <!-- Led Dropdown with Submenu -->
                 <div class="dropdown-submenu">
                <a href="/?category=other">Other</a>
                <div class="dropdown-subcontent">
                    <a href="/emcusb">EMC USB Converter</a>
                    <a href="/sequenzer">Sequenzer AVT NT01</a>
                    
                  </div>
                </div>
                
              </div>
            </li>
            <li><a href="/downloads">{{ __('messages.downloads') }}</a></li>
            <li><a href="#basket">{{ __('messages.basket') }}</a></li>
            
          </ul>
          
          <img src="Frontend/images/avt_logo_150.jpg" alt="AVT Logo" class="logo" />
        </nav>
      </header>
    </div>
    <script src="{{ asset('Frontend/js/script.js') }}"></script>
  </body>
</html>

