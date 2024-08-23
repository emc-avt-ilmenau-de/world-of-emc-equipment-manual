@extends('Frontend.layouts.main')
@section('main-container')

<main class="main-content">
      <div class="minicam-image">
      <div class="slideshow-container">

<div class="mySlides fade">
  <div class="numbertext">1 / 3</div>
  <img src="Frontend\images\avt_emv4kminicam_1000.jpg" style="width:100%">
   <br>
        <br>
        <br>
  <div class="text">Caption Text</div>
</div>

<div class="mySlides fade">
  <div class="numbertext">2 / 3</div>
  <br>
  <img src="Frontend\images\4kminicam2.png" style="width:100%">
  <br>
        <br>
        <br>
  <div class="text">Caption Two</div>
</div>

<div class="mySlides fade">
  <div class="numbertext">3 / 3</div>
  <video width="1080" height="720" controls>
          <source src="Frontend\images\avt_minicam_video.mp4" type="video/mp4">
          <source src="Frontend\images\avt_minicam_video.mp4" type="video/ogg">
          Your browser does not support the video tag.
        </video>
        <br>
        <br>
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
        <h2>High resolution (UHD) Camera especially for EMC- und test laboratories and general applications:</h2>
        <ol>
          <li>4K Camera for EMC labs and test fields with high interference imunity</li>
          <li>different resolutions selectable (640 x 360 up to 3840 x 2160)</li>
          <li>Pan/Tilt/Zoom inside camera controled by software</li>
          <li>Easy to use in hardware and software</li>
          <li>data transmission with optical fibers (USB 3.0)</li>
          <li>Small housing in slim design</li>
          <li>High field immunity > 100 V/m</li>
        </ol>
      </div>

      <div>
        <h3>Options:</h3>
        <ol>
          <li>Integrated rechargeable battery (5 Ah)</li>
          <li>Optic lens for different angles</li>
          <li>Pan/Tilt/Zoom inside camera controled by software</li>
          <li>Higher interference immunity</li>
        </ol>
      </div>

      </div>
     
      <div class="cam-details">
        <h1>Lens</h1>
        <h2>No Influence on Price</h2>
        <div class="lens-stats">        

        <form>
    <p>Please choose an Lens:</p>

    <input type="radio" id="option1" name="option" value="Option 1" onclick="checkOther()">
    <label for="option1">3.2 mm</label>

    <input type="radio" id="option2" name="option" value="Option 2" onclick="checkOther()">
    <label for="option2">4.5 mm</label>

    <input type="radio" id="option3" name="option" value="Option 3" onclick="checkOther()">
    <label for="option3">6.8 mm</label>

    <input type="radio" id="option4" name="option" value="Option 4" onclick="checkOther()">
    <label for="option3">12 mm</label>

    <input type="radio" id="other" name="option" value="Other" onclick="checkOther()">
    <label for="other">Other</label>

    <!-- Hidden input field initially -->
    <div id="otherFieldDiv">
        <label for="otherField">Please specify:</label>
        <input type="text" id="otherField" name="otherField">
    </div>

</form>


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
        <h1>Power supply</h1>
        <h2>No Influence on Price</h2>
        <div class="charging-options">
          <input
            type="radio"
            id="wall-connector"
            name="charging"
            value="wall-connector"
          />
          <label for="wall-connector">
          </label>
            Hardened switching power supply 230V/5V
          </label>
          <br />
          <input
            type="radio"
            id="mobile-connector"
            name="charging"
            value="mobile-connector"
          />
          <label for="mobile-connector">	
            Hardened nonswitching power supply 230V/5V		
          </label>

          <br />
          <input
            type="radio"
            id="mobile-connector"
            name="charging"
            value="mobile-connector"
          />
          <label for="mobile-connector">	
          Accumulator/chargeable batterie inside camera	
          </label><br>
          <br>
          <!-- Action button to open the popup -->
  <button id="openPopupBtn">Learn More</button>

<!-- Popup container -->
<div id="popup" class="popup">
  <div class="popup-content">
    <span class="popup-close">&times;</span>

    <!-- Slideshow container -->
    <div class="popup-slideshow-container">
      <div class="popup-slide">
        <img src="Frontend\images\4kminicam2.png" alt="Image 1" style="width:100%">
      </div>
      <div class="popup-slide">
        <img src="Frontend\images\4kminicam3.png" alt="Image 2" style="width:100%">
      </div>
      <div class="popup-slide">
        <img src="Frontend\images\4kminicam4.png" alt="Image 3" style="width:100%">
      </div>
      <a class="popup-prev">&#10094;</a>
      <a class="popup-next">&#10095;</a>
    </div>

    <!-- Dots to indicate current slide -->
    <div style="text-align:center">
      <span class="popup-dot"></span> 
      <span class="popup-dot"></span> 
      <span class="popup-dot"></span> 
    </div>
  </div>
</div>

        </div>
        <h1>Power Plug</h1>
        <h2>No Influence on Price</h2>
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
        <h2>No Influence on Price</h2>
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
        <h1>Software</h1>
        
      <div class="accessories-options">
      <input
          type="checkbox"
          id="all-weather-mats"
          name="accessories"
          value="all-weather-mats"
         checked/>
        <label for="all-weather-mats">Basic (Free)</label>
        <br>
        <input
          type="checkbox"
          id="car-cover"
          name="accessories"
          value="car-cover"
        />
        <label for="car-cover">MiniCam Plus (X.X€)</label>
       
        
      </div>
      <br>

      <h1>Price</h1>

      <h4>List Price for System <SPan> 7000€</SPan></h4>

        <button class="basket-button">Add To Basket</button>
      </div>
    </main>
@endsection