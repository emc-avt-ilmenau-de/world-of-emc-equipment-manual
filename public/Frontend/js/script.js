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


 // Function to show the selected section and hide others for both lamp100 and lamp24
function showSection(sectionId) {
    // Query all hidden sections with either lamp100 or lamp24 class
    var sections = document.querySelectorAll('.hidden-sectionlamp100, .hidden-sectionlamp24');
    
    // Hide all sections by removing the 'active' class
    sections.forEach(function(section) {
        section.classList.remove('active');
    });

    // Show the selected section by adding 'active' class
    document.getElementById(sectionId).classList.add('active');
}

// JavaScript function to update the selected components and total price
function checkLensOther(value) {
    if (value === 'Other') {
        document.getElementById('lensOtherFieldDiv').style.display = 'block';
    } else {
        document.getElementById('lensOtherFieldDiv').style.display = 'none';
    }
}

function checkGeoOther(value) {
    if (value === 'Other') {
        document.getElementById('geoOtherFieldDiv').style.display = 'block';
    } else {
        document.getElementById('geoOtherFieldDiv').style.display = 'none';
    }
}

function validateSelection() {
    let isValid = true;
    let errorMessages = [];

    // Loop through each component section to ensure at least one option is selected or custom value is provided
    document.querySelectorAll('.component-section').forEach(section => {
        const radioButtons = section.querySelectorAll('input[type="radio"]');
        const checkboxes = section.querySelectorAll('input[type="checkbox"]');
        const textInput = section.querySelector('input[type="text"]');
        
        let isComponentValid = false;

        // Check if at least one radio button or checkbox is selected
        if (radioButtons.length > 0) {
            const isRadioSelected = Array.from(radioButtons).some(input => input.checked);
            if (isRadioSelected) {
                isComponentValid = true;
            }
        } else if (checkboxes.length > 0) {
            const isCheckboxSelected = Array.from(checkboxes).some(input => input.checked);
            if (isCheckboxSelected) {
                isComponentValid = true;
            }
        }

        // Handle "Other" input field validation
        if (!isComponentValid && textInput && textInput.value.trim() === '') {
            // If "Other" is selected but no custom value is provided
            if (section.querySelector('input[type="radio"]:checked')?.nextElementSibling.textContent === 'Other') {
                errorMessages.push(`${section.querySelector('h2').textContent} requires a custom value.`);
                isValid = false;
            }
        }

        // If no selection is made and it's not an "Other" input, mark as invalid
        if (!isComponentValid && textInput?.value.trim() === '') {
            errorMessages.push(`${section.querySelector('h2').textContent} requires a selection.`);
            isValid = false;
        }
    });

    // Validate Power Plug input if it exists
    const powerPlugValue = document.getElementById('powerPlugInput')?.value;
    if (powerPlugValue && powerPlugValue.trim() === '') {
        errorMessages.push('Power Plug field is required.');
        isValid = false;
    }

    // Display error messages if validation fails
    if (!isValid) {
        alert('Please fix the following errors:\n' + errorMessages.join('\n'));
    }

    return isValid;
}

function updateSelection() {
    // Only update the selection if validation passes
    if (!validateSelection()) return;

    let selectedComponents = '';
    let totalPrice = parseFloat(document.getElementById('basePrice').innerText); // Start with the base price

    // Loop through selected radio buttons or checkboxes to get additional component prices
    document.querySelectorAll('input[type="radio"]:checked, input[type="checkbox"]:checked').forEach(input => {
        const componentName = input.closest('.component-section').querySelector('h2').textContent;
        const componentValue = input.nextElementSibling.textContent;
        const componentPrice = parseFloat(input.getAttribute('data-price') || 0);

        // Handle "Other" fields (custom inputs)
        if (componentValue === "Other") {
            // Find the corresponding input field (text box) for the "Other" value
            const customInputField = input.closest('.component-section').querySelector('input[type="text"]');
            if (customInputField) {
                const customValue = customInputField.value.trim();
                if (customValue) {
                    selectedComponents += `<p><strong>${componentName}:</strong> ${customValue}</p>`;
                    totalPrice += parseFloat(customInputField.getAttribute('data-price') || 0); // Add price for custom value (if any)
                }
            }
        } else {
            // For regular selections, just add the name and price
            selectedComponents += `<p><strong>${componentName}:</strong> ${componentValue}</p>`;
            totalPrice += componentPrice; // Add the price for the selected value
        }
    });

    // Handle power plug input (if it exists)
    const powerPlugValue = document.getElementById('powerPlugInput')?.value;
    if (powerPlugValue) {
        selectedComponents += `<p><strong>Power Plug:</strong> ${powerPlugValue}</p>`;
        // Optional: Add price for Power Plug if available (you can add logic here)
    }

    // Log selected components and total price for debugging
    console.log("Selected Components:", selectedComponents);
    console.log("Total Price:", totalPrice);

    // Update the modal with selected components and total price
    document.getElementById('modalComponents').innerHTML = selectedComponents;
    document.getElementById('modalTotalPrice').textContent = totalPrice.toFixed(2) + ' EUR';
}

// Open modal function
function openModal() {
    updateSelection(); // Update the modal with selected components
    document.getElementById('productModal').style.display = 'block'; // Show the modal
}

// Close modal function
function closeModal() {
    document.getElementById('productModal').style.display = 'none'; // Hide the modal
}

// Submit form when user confirms selection
function submitForm() {
    if (validateSelection()) {
        document.getElementById('addToBasketForm').submit(); // Submit the form only if valid
    }
}

document.getElementById('addToBasketForm').addEventListener('submit', () => {
    alert('Form is being submitted');
});
// basket.js

// Event listener for updating product quantity
document.querySelectorAll('.update-quantity').forEach(button => {
    button.addEventListener('click', function(e) {
        const productId = this.dataset.productId;
        const quantity = document.querySelector(`#quantity-${productId}`).value;
        
        // Send AJAX request to update the quantity
        fetch(`/basket/update/${productId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ quantity })
        })
        .then(response => response.json())
        .then(data => {
            // Update the total price
            document.querySelector(`#total-price-${productId}`).innerText = data.newTotalPrice;
            document.querySelector('#total-price').innerText = data.newGrandTotal;
        })
        .catch(error => console.error('Error updating quantity:', error));
    });
});

// Event listener for removing a product from the basket
document.querySelectorAll('.remove-product').forEach(button => {
    button.addEventListener('click', function(e) {
        const productId = this.dataset.productId;

        // Send AJAX request to remove the product
        fetch(`/basket/remove/${productId}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            // Remove the product from the basket UI
            document.querySelector(`#product-${productId}`).remove();
            document.querySelector('#total-price').innerText = data.newGrandTotal;
        })
        .catch(error => console.error('Error removing product:', error));
    });
});