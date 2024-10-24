@extends('FrontEnd.layouts.main')
@section('main-container')

<main>
  <section id="all-products" class="product-category">
    <h2 id="all-products-heading">{{ __('messages.all-product') }}</h2>
    <!-- Debugging: Display Current Locale -->
    <div>
    Current Locale: {{ App::getLocale() }}<br>
    Session Locale: {{ session('locale', 'en') }}<br>
    Cookie Locale: {{ Cookie::get('locale', 'en') }} <!-- If using cookies -->
    <p>Session Data: {{ print_r(session()->all()) }}</p>
    {{ session('locale') }} <!-- Check what the session locale is -->
   
</div>

    <!-- Cameras Category -->
    <div id="camera-category" class="category-group">
      <h3>{{ __('messages.camera') }}</h3>
      <div class="product-row">
        <div class="product-item camera">
          <h4>4K Mini Cam</h4>
          <a href="/minicam">
            <img src="Frontend/images/avt_emv4kminicam_1000.jpg" alt="4K Mini Cam" />
          </a>
          <p>High resolution (UHD) Camera especially for EMC- und test laboratories and general applications.</p>
        </div>
        <div class="product-item camera">
          <h4>Thermal Cam</h4>
          <a href="/thermocam">
            <img src="Frontend/images/thermocam_1000-768x488.jpg" alt="Thermal Cam" />
          </a>
          <p>LWIR Thermography Camera especially for EMC and test laboratories.</p>
        </div>
      </div>
    </div>

    <!-- LED Category -->
    <div id="led-category" class="category-group">
      <h3>LED</h3>
      <div class="product-row">
        <div class="product-item led">
          <h4>Lamp EMVLED 100</h4>
          <a href="/lamp100">
          <img src="Frontend/images/emvled100_2_2000-768x698.jpg" alt="Lamp EMVLED 100" />
          </a>
          <p>The EMC-resistant, dimmable (optional) and low-emission LED lights and drivers are the ideal LED lighting system for EMC and test labs, as well as generally interference-sensitive environments.</p>
        </div>
        <div class="product-item led">
          <h4>Lamp EMVLED 75</h4>
          <a href="/lamp75">
          <img src="Frontend/images/emvled75_1000.jpg" alt="Lamp EMVLED 75" />
          </a>
          <p>The EMC-resistant, dimmable (optional) and low-emission LED lights and drivers are the ideal LED lighting system for EMC and test labs, as well as generally interference-sensitive environments.</p>
        </div>
        <div class="product-item led">
                <h4>Lamp EMVLED 24/40</h4>
                <a href="/lamp24">
                <img src="Frontend/images/emvled024_800-768x844.jpg" alt="Lamp EMVLED 24/40" />
                </a>
                <p>The EMC-resistant, dimmable (optional) and low-emission LED lights and drivers are the ideal LED lighting system for EMC and test labs, as well as generally interference-sensitive environments.</p>
            </div>
            <div class="product-item led">
                <h4>EMC LED Driver</h4>
                <a href="/leddriver">
                <img src="Frontend/images/AVT_EMVTLED070-1024x892.jpg" alt="EMC LED Driver" />
                </a>
                <p>The EMC-resistant, dimmable (optional) and low-emission LED lights and drivers are the ideal LED lighting system for EMC and test labs, as well as generally interference-sensitive environments.</p>
            </div>
      </div>
    </div>

    <!-- Software Category -->
    <div id="software-category" class="category-group">
      <h3>Software</h3>
      <div class="product-row">
        <div class="product-item software">
          <h4>Software Product 1</h4>
          <p>Description of Software Product 1.</p>
        </div>
      </div>
    </div>

    <!-- Other Category -->
    <div id="other-category" class="category-group">
      <h3>{{ __('messages.other') }}</h3>
      <div class="product-row">
        <div class="product-item other">
          <h4>EMC USB Converter</h4>
          <a href="/emcusb">
          <img src="Frontend/images/usb.jpg" alt="EMC USB Converter" />
          </a>
          <p>Electro-optical USB-Converter especially for EMC and test laboratories, as well as general applications.</p>
        </div>
        <div class="product-item other">
          <h4>Sequenzer AVT NT01</h4>
          <a href="/sequenzer">
          <img src="Frontend/images/sequenzer.jpg" alt="Sequenzer AVT NT01" />
          </a>
          <p>Sequenzer AVT NT01 – For EMC measuring and testing technology.</p>
        </div>
      </div>
    </div>
  </section>
</main>
@endsection
