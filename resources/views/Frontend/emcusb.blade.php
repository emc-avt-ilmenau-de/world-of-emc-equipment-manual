@extends('Frontend.layouts.main')
@section('main-container')

<main class="main-content">
      <div class="product-image">
      <div class="slideshow-container">

<div class="mySlides fade">
  <div class="numbertext">1 / 3</div>
  <img src="Frontend\images\usb.jpg" style="width:100%">
   <br>
        <br>
        <br>
  <div class="text">Caption Text</div>
</div>

<div class="mySlides fade">
  <div class="numbertext">2 / 3</div>
  <br>
  <img src="Frontend\images\usb.jpg" style="width:85%">
  <br>
        <br>
        <br>
  <div class="text">Caption Two</div>
</div>

<div class="mySlides fade">
  <div class="numbertext">3 / 3</div>
  <video width="1000" height="650" controls>
          <source src="Frontend\images\avt_usb_converter.mp4" type="video/mp4">
          <source src="Frontend\images\avt_usb_converter.mp4" type="video/ogg">
          Your browser does not support the video tag.
        </video>
        <br>
        
  <div class="text">Caption Three</div>
</div>
<a class="prev">&#10094;</a>
      <a class="next">&#10095;</a>

</div>
<br>

<div style="text-align:center">
  <span class="dot" onclick="currentSlide(1)"></span> 
  <span class="dot" onclick="currentSlide(2)"></span> 
  <span class="dot" onclick="currentSlide(3)"></span> 
</div>

<div>
        <h2>AVT EMC USB Converter</h2>
          <p>Electro-optical USB-Converter especially for EMC and test laboratories, as well as general applications.</p>
      </div>

      <div>
        <h3>Features:</h3>
        <ul>
          <li>USB 1.0 - 3.0 Converter</li>
          <li>USB-device types 1.0 - 2.0 and 3.0</li>
          <li>maximum transmission data rate up to 5 Gbit/s</li>
          <li>up to 3 lamps on one driver EMVLED 070</li>
          <li>full data transparency (no driver dependency)</li>
          <li>power supply for EUT with 5 V / 3 A /15 W</li>
          <li>power supply device with 85 - 250 VAC / 47 - 63 Hz</li>
          <li>wide temperature range</li>
          <li>data transmission and control with fiber optic cable</li>
          <li>variants of fiber cable length 10 m / 20 m / 30 m / 50 m / 70 m / 100 m</li>
          <li>high interference immunity > 100 V/m</li>
        </ul>
      </div>

      <div>
        <h3>Options:</h3>
        <ul>
          <li>higher interference immunity</li>
          
        </ul>
      </div>

      
      </div>
      <div class="product-details">
      <h2>Most of the components are included on the base price, except some.</h2>
      <h1>USB-device types</h1>
       
        <div class="device-type">        

        <input type="radio" id="option1" name="choice" value="Option 1">
    <label for="option1">1.0 - 2.0</label>

    <input type="radio" id="option2" name="choice" value="Option 2">
    <label for="option2"> 3.0</label>



        </div>
        <h1>Fiber Optics</h1>
        <div class="cable-options">
        
    <input type="radio" id="option1" name="choice" value="Option 1">
    <label for="option1">10m</label>

    <input type="radio" id="option2" name="choice" value="Option 2">
    <label for="option2">20m</label>

    <input type="radio" id="option3" name="choice" value="Option 3">
    <label for="option3">30m</label>   <span>(Same Price)</span><br>
    <br>

    <input type="radio" id="option4" name="choice" value="Option 1">
    <label for="option1">50m</label>

    <input type="radio" id="option5" name="choice" value="Option 2">
    <label for="option2">70m</label>

    <input type="radio" id="option6" name="choice" value="Option 3">
    <label for="option3">100m</label>   <span>(Additional Price)</span>
    

   

        </div>
        <h3></h3>
        
        <h1>Power Plug</h1>
       
        <div class="accessories-options">
          <input
            type="radio"
            id="car-cover"
            name="accessories"
            value="car-cover"
          />
          <label for="car-cover">EU</label>
          <br>
          <input
            type="radio"
            id="all-weather-mats"
            name="accessories"
            value="all-weather-mats"
          />
          <label for="all-weather-mats">UK</label>
        </div>
        <h1>Geographic area for power</h1>
        
        <div class="interior-options">
          <input
            type="radio"
            id="all-black"
            name="interior"
            value="all-black"
          />
          <label for="all-black">230 V/ 50 Hz</label>
          <input
            type="radio"
            id="black-and-white"
            name="interior"
            value="black-and-white"
          />
          <label for="black-and-white">110 VAC @  60Hz</label>
        </div>
        
      <br>

      <h1>Price</h1>

      <h4>List Price for System <SPan> 7000€</SPan></h4>

      
      <button class="basket-button">Add To Basket</button>
      </div>
      </main>
@endsection
