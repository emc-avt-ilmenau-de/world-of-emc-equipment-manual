@extends('Frontend.layouts.main')
@section('main-container')

<main class="main-content">
      <div class="product-image">
      <div class="slideshow-container">

<div class="mySlides fade">
  <div class="numbertext">1 / 3</div>
  <img src="Frontend\images\Lamp EMVLED 100 – AVT GmbH.png" style="width:85%">
   <br>
        <br>
        <br>
  <div class="text">Caption Text</div>
</div>

<div class="mySlides fade">
  <div class="numbertext">2 / 3</div>
  <br>
  <img src="Frontend\images\Lamp EMVLED 100 – AVT GmbH.png" style="width:85%">
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

        <div>
        <h2>Lamp EMVLED 100</h2>
          <p>The EMC-resistant, dimmable (optional) and low-emission LED lights and drivers are the ideal LED lighting system for EMC and test labs, as well as generally interference-sensitive environments. With a wide performance range, very high color rendering quality and low heat generation, this LED lighting system already stands out from the conventional mass of LED lamps.</p>
      </div>

      <div>
        <h3>Features:</h3>
        <ul>
          <li>LED lights or spotlights for EMC laboratories, test fields and general environments</li>
          <li>power 100 W</li>
          <li>Pan/Tilt/Zoom inside camera controled by software</li>
          <li>high luminous flux from 9600 lm per lamp</li>
          <li>very high color rendering value Ra (CRI) of 97 typ</li>
          <li>high efficiency, thus lower heat load</li>
          <li>minimal electrical and electromagnetic interference</li>
          <li>selectable color temperature (2700K – 4000K)</li>
          <li>selectable opening angle (15° – 80°) of the reflectors</li>
          <li>wide input voltage range (110V – 240V~ / 50/60Hz)</li>
          <li>developed and manufactured in Germany</li>
        </ul>
      </div>

      <div>
        <h3>Options:</h3>
        <ul>
          <li>Integrated rechargeable battery (5 Ah)</li>
          <li>Optic lens for different angles</li>
          <li>Pan/Tilt/Zoom inside camera controled by software</li>
          <li>Higher interference immunity</li>
        </ul>
      </div>

      <div>
        <h3>Additional services:</h3>
        <ul>
          <li>cable extensions for LED lamps</li>
          <li>installation services</li>
          <li>planning and lighting calculations</li>
        </ul>
      </div>

      </div>
     
      <div class="product-details">
        <h1>Color temperature</h1>
        <h4>No Influence on Price</h4>
        <div class="lens-stats">        

        <form>
    <p>Please choose an color:</p>

    <input type="radio" id="option1" name="option" value="Option 1" >
    <label for="option1">2700 K</label>

    <input type="radio" id="option2" name="option" value="Option 2" >
    <label for="option2">3000 K</label>

    <input type="radio" id="option3" name="option" value="Option 3" >
    <label for="option3">4000 K</label>   
</form>


        </div>
        
        <h3></h3>
        <h1>Reflector</h1>
        <h4>No Influence on Price</h4>
        <div class="refelector-options">
        <p>Please choose an opening angles:</p>
        <input type="radio" id="option1" name="option" value="Option 1" >
    <label for="option1">15°</label>

    <input type="radio" id="option2" name="option" value="Option 2" >
    <label for="option2">30°</label>

    <input type="radio" id="option3" name="option" value="Option 3" >
    <label for="option3">40°</label>  

    <input type="radio" id="option4" name="option" value="Option 4" >
    <label for="option4">80°</label>  
    <br>
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
        <img src="Frontend\images\reflector1.png" alt="Image 1" style="width:100%">
      </div>
      <div class="popup-slide">
        <img src="Frontend\images\reflector2.png" alt="Image 2" style="width:100%">
      </div>
      <div class="popup-slide">
        <img src="Frontend\images\aqzqalmoZpSC.png" alt="Image 3" style="width:100%">
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
        <h4>No Influence on Price</h4>
        <div class="accessories-options">
          <input
            type="radio"
            id="car-cover"
            name="accessories"
            value="car-cover"
          />
          <label for="car-cover">EU</label>
          
          <input
            type="radio"
            id="all-weather-mats"
            name="accessories"
            value="all-weather-mats"
          />
          <label for="all-weather-mats">UK</label>
        </div>

        <h1>Variant</h1>
        <div class="variant-options">
          <p> Please select an variant:</p>
       

<!-- Radio buttons -->

<label>
    <input type="radio" name="options" value="option1" onclick="showSection('section1')"> Variant 2
</label>


<label>
    <input type="radio" name="options" value="option2" onclick="showSection('section2')"> Variant 3
</label>


<div id="section1" class="hidden-sectionlamp100">
<ul>
      <li>Length-210 mm</li>
      <li>Width-250 mm</li>
      <li>Height (with/without retaining bracket 95/190 mm)</li>
      <li>Weight (without retaining bracket 4,4 kg) <br> Light only, Driver separate</li>
    </ul>
    <!-- Add more content here -->
</div>
<div id="section2" class="hidden-sectionlamp100">
    <ul>
      <li>Length-210 mm</li>
      <li>Width- 270mm</li>
      <li>Height (without / with retaining bracket 295 mm)</li>
      <li>Weight (without retaining bracket 10,6 kg) <br> Including Light and Driver</li>
    </ul>
    <!-- Add more content here -->
</div>

        </div>
        <h1>Geographic area for power</h1>
        <h4>No Influence on Price</h4>
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
        <label for="all-weather-mats">2 years included</label>
        
        <input
          type="checkbox"
          id="car-cover"
          name="accessories"
          value="car-cover"
        />
        <label for="car-cover">1 year optional (X.X€)</label>
       
        
      </div>
      <br>

      <h1>Price</h1>

      <h4>List Price for System AVT-EMVLED-100 + driver <SPan> 1350€</SPan></h4>

        <button class="basket-button">Add To Basket</button>
      </div>
    </main>
@endsection