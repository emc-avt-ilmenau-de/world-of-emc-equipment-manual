document.addEventListener('DOMContentLoaded', function() {
    const categoryGroups = document.querySelectorAll('.category-group');
    const allProductsHeading = document.getElementById('all-products-heading');
    
    function showCategory(categoryClass) {
        let showHeading = true; // Assume we will show the heading unless a specific category is selected

        categoryGroups.forEach(group => {
            if (categoryClass === 'all') {
                group.style.display = 'block'; // Show all categories
            } else {
                group.style.display = (group.id === `${categoryClass}-category`) ? 'block' : 'none';
                // Only show the heading if we're displaying all categories
                if (group.style.display === 'block') {
                    showHeading = false;
                }
            }
        });

        allProductsHeading.style.display = showHeading ? 'block' : 'none';
    }

    // Check if a category is present in the URL (like ?category=camera)
    const urlParams = new URLSearchParams(window.location.search);
    const categoryParam = urlParams.get('category');

    if (categoryParam) {
        showCategory(categoryParam);
    } else {
        // Show all products by default when no category is specified
        showCategory('all');
    }

    // Attach the showCategory function to the global window object for manual calls
    window.showCategory = showCategory;

    // Add event listeners to category buttons
    document.querySelectorAll('.dropdown-content a').forEach(anchor => {
        anchor.addEventListener('click', function() {
            // Remove active class from all buttons
            document.querySelectorAll('.dropdown-content a').forEach(btn => btn.classList.remove('active'));
            // Add active class to the clicked button
            this.classList.add('active');

            // Get the category class from href attribute
            const categoryClass = this.getAttribute('href').replace('/', '');
            showCategory(categoryClass);
        });
    });
});



let slideIndex = 1;
document.addEventListener("DOMContentLoaded", function() {
  showSlides(slideIndex); // Ensure the initial slide is displayed
});


function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  const slides = document.getElementsByClassName("mySlides");
  const dots = document.getElementsByClassName("dot");
  
  // Wrap around the slide index if out of range
  if (n > slides.length) { slideIndex = 1; }
  if (n < 1) { slideIndex = slides.length; }

  // Hide all slides and remove active class from all dots
  for (let i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  for (let i = 0; i < dots.length; i++) {
    dots[i].classList.remove("active");
  }

  // Show the current slide and add active class to the corresponding dot
  slides[slideIndex - 1].style.display = "block";  
  dots[slideIndex - 1].classList.add("active");
  // Next/previous controls
  document.querySelector(".next").onclick = function() {
    slideIndex++;
    showSlides(slideIndex);
}

document.querySelector(".prev").onclick = function() {
    slideIndex--;
    showSlides(slideIndex);
}
}


function checkOther() {
  var otherFieldDiv = document.getElementById('otherFieldDiv');
  var otherRadio = document.getElementById('other');

  // Show the text input if "Other" is selected, hide it otherwise
  if (otherRadio.checked) {
      otherFieldDiv.style.display = 'block';
  } else {
      otherFieldDiv.style.display = 'none';
  }
}

document.addEventListener("DOMContentLoaded", function() {
  let popupSlideIndex = 0;
  const slides = document.getElementsByClassName("popup-slide");
  const dots = document.getElementsByClassName("popup-dot");

  // Show the first slide initially
  showPopupSlides(popupSlideIndex);

  function showPopupSlides(n) {
      // Handle wrap-around if the index is out of bounds
      if (n >= slides.length) {
          popupSlideIndex = 0;
      }
      if (n < 0) {
          popupSlideIndex = slides.length - 1;
      }

      // Hide all slides and remove active class from dots
      for (let i = 0; i < slides.length; i++) {
          slides[i].style.display = "none";
          dots[i].className = dots[i].className.replace(" popup-active", "");
      }

      // Display the current slide and activate the corresponding dot
      slides[popupSlideIndex].style.display = "block";
      dots[popupSlideIndex].className += " popup-active";
  }

  // Open the popup
  document.getElementById('openPopupBtn').onclick = function() {
      document.getElementById('popup').style.display = 'block';
      showPopupSlides(popupSlideIndex); // Show the first slide when opening
  }

  // Close the popup
  document.getElementsByClassName('popup-close')[0].onclick = function() {
      document.getElementById('popup').style.display = 'none';
  }

  // Close the popup if the user clicks outside of the popup content
  window.onclick = function(event) {
      if (event.target == document.getElementById('popup')) {
          document.getElementById('popup').style.display = 'none';
      }
  }

  // Next/previous controls
  document.querySelector(".popup-next").onclick = function() {
      popupSlideIndex++;
      showPopupSlides(popupSlideIndex);
  }

  document.querySelector(".popup-prev").onclick = function() {
      popupSlideIndex--;
      showPopupSlides(popupSlideIndex);
  }

  // Dot controls
  for (let i = 0; i < dots.length; i++) {
      dots[i].onclick = function() {
          popupSlideIndex = i;
          showPopupSlides(popupSlideIndex);
      }
  }
});
