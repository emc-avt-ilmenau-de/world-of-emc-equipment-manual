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
            <li><a href="#about">About Us</a></li>
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
                <a href="/?category=led">LED</a>
                <a href="/?category=software">Software</a>
                <a href="/?category=other">Other</a>
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

