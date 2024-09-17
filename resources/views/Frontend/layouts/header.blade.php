<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>EMC WEB</title>
    <link rel="stylesheet" href="Frontend/css/styles.css" />
  </head>
  <body>
    <div class="wrapper">
      <header>
        <h1>Welcome to EMC-Web</h1>
        <h4>We Are Not Just Sellers, We Are The Producer</h4>
        <nav>
          <ul>
            <li><a href="/">Home</a></li>
            <li><a href="/about">About Us</a></li>
            <li class="dropdown">
              <a href="/" class="dropbtn">Product</a>
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
            <li><a href="/downloads">Download</a></li>
            <li><a href="#basket">Basket</a></li>
          </ul>
          <img src="Frontend/images/avt_logo_150.jpg" alt="AVT Logo" class="logo" />
        </nav>
      </header>
    </div>
    <script src="Frontend/js/script.js"></script>
  </body>
</html>

