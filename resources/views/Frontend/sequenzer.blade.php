@extends('Frontend.layouts.main')
@section('main-container')

<main class="main-content">
      <div class="product-image">
      <div class="slideshow-container">

<div class="mySlides fade">
  <div class="numbertext">1 / 3</div>
  <img src="Frontend\images\sequenzer.jpg" style="width:100%">
   <br>
        <br>
        <br>
  <div class="text">Caption Text</div>
</div>

<div class="mySlides fade">
  <div class="numbertext">2 / 3</div>
  <br>
  <br>
  <br>
  <img src="Frontend\images\nt01mg.jpg" style="width:100%">
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
        <h2>Sequenzer AVT NT01</h2>
          <p>Sequencer to control any processes for test and inspection arrangements with high accuracy. The sequencer is particularly suitable for EMC measurement and testing technology. The simple installation and commissioning are outstanding features of the device.</p>
      </div>

      <div>
        <h3>Benefits:</h3>
        <ul>
          <li>control of highly precise processes with FPGA technology</li>
          <li>from 8 to 72 output trigger channels</li>
          <li>good compatibility with devices because of optical and electrical 12V outputs</li>
          <li>channel output as trigger signal and inverted trigger signal</li>
          <li>synchronization of the trigger signals with a reference variable or external signal</li>
          <li>internal zero crossing detector (ZCD)</li>
          <li>switches for start, reset, standby and safety circuit</li>
          <li>comfortable operation with rotary encoder and graphic display</li>
          <li>connection of an external HD monitor possible</li>
          <li>the device can be used independently without a PC</li>
          <li>possibility of control by PC software via Ethernet or RS232</li>
          <li>minimal installation effort, no software maintenance</li>
          <li>saving and retrieval of parameters directly on the sequencer</li>
          <li>devices can be cascaded</li>
          <li>adjustable repeat of sequences</li>
          <li>freely programmable trigger programs</li>
          <li>19″ rack mount</li>
        </ul>
      </div>

      <div>
        <h3>Options:</h3>
        <ul>
          <li>accurate resolution of 50 ns</li>
          <li>larger time duration of individual sequences to 0... 10 min</li>
          <li>larger time duration of sequences repeats 1 ms... 1 h/ 10 h</li>
          <li>working with internal accumulator</li>
          
        </ul>
      </div>

      
      </div>
      <div class="product-details">
      <h2>Most of the components are included on the base price, except some.</h2>

      <h1>Sequenzer</h1>
       
        <div class="device-type">        

        <input type="radio" id="option1" name="choice" value="Option 1">
    <label for="option1">Nt01-08</label>

    <input type="radio" id="option2" name="choice" value="Option 2">
    <label for="option2">Nt01-16</label>

    <input type="radio" id="option2" name="choice" value="Option 2">
    <label for="option2">Nt01-64</label>

    <input type="radio" id="option2" name="choice" value="Option 2">
    <label for="option2">Nt01-71</label><br>

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
        <img src="Frontend\images\sequenzer.png" alt="Image 1" style="width:100%">
      </div>
      <div class="popup-slide">
        <img src="Frontend\images\sequenzer.png" alt="Image 2" style="width:100%">
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
       

      <h1>Price</h1>

      <h4>List Price for System <SPan> 7000€</SPan></h4>

      
      <button class="basket-button">Add To Basket</button>
      </div>
      </main>
@endsection
