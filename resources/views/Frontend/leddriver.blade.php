@extends('Frontend.layouts.main')
@section('main-container')

<main class="main-content">
      <div class="product-image">
      <div class="slideshow-container">

<div class="mySlides fade">
  <div class="numbertext">1 / 3</div>
  <img src="Frontend\images\AVT_EMVTLED070-1024x892.jpg" style="width:80%">
   <br>
        <br>
        <br>
  <div class="text">Caption Text</div>
</div>

<div class="mySlides fade">
  <div class="numbertext">2 / 3</div>
  <br>
  <img src="Frontend\images\EMC LED Driver – AVT GmbH.png" style="width:100%">
  <br>
        <br>
        <br>
  <div class="text">Caption Two</div>
</div>

<div class="mySlides fade">
  <div class="numbertext">3 / 3</div>
  <video width="1000" height="650" controls>
          <source src="Frontend\images\avt_emvled_540p.mp4" type="video/mp4">
          <source src="Frontend\images\avt_emvled_540p.mp4" type="video/ogg">
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

        

      </div>
      <div class="product-details">
      <div>
        <h2>EMC LED Driver</h2>
          <p>The EMC-resistant, dimmable (optional) and low-emission LED lights and drivers are the ideal LED lighting system for EMC and test labs, as well as generally interference-sensitive environments. With a wide performance range, very high color rendering quality and low heat generation, this LED lighting system already stands out from the conventional mass of LED lamps.</p>
      </div>

      <div>
        <h3>Features:</h3>
        <ul>
          <li>Driver power from 70 W to 250 W</li>
          <li>Driver EMVC immun and very low emission</li>
          <li>Driver can be installed inside or outside the EMC equipment</li>
          <li>optionally dimmable: 10 % to 100 %</li>
          <li>Cabling as fixed installation or as 230 V cable with plugs and sockets for LED cabling</li>
        </ul>
      </div>

      <div>
        <h3>Options:</h3>
        <ul>
          <li>different housing colors possible (black as standard)</li>
          <li>different housing forms possible</li>
        </ul>
      </div>

      <div>
        <h3>Additional services:</h3>
        <ul>
          <li>cable extensions for LED lamps</li>
          <li>installation services</li>
          <li>planning and lighting calculations</li>
          <li>EMC-proof camera system with pan-tilt head</li>
        </ul>
      </div>
      <button class="basket-button">Add To Basket</button>
      </div>
      </main>
@endsection
