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
document.addEventListener("DOMContentLoaded", function () {
    let popupSlideIndex = 0;

    const popup = document.getElementById("popup");
    const openPopupBtn = document.getElementById("openPopupBtn");
    const closeBtn = document.querySelector(".popup-close");
    const slides = document.getElementsByClassName("popup-slide");
    const nextBtn = document.querySelector(".popup-next");
    const prevBtn = document.querySelector(".popup-prev");

    let slideIndex = 0;

function showSlides(n) {
    const slides = document.getElementsByClassName("popup-slide");
    if (n >= slides.length) slideIndex = 0;
    if (n < 0) slideIndex = slides.length - 1;

    // Hide all slides
    for (let slide of slides) {
        slide.style.display = "none";
    }

    // Show the selected slide
    slides[slideIndex].style.display = "block";
}

document.querySelector(".popup-prev").addEventListener("click", function() {
    showSlides(--slideIndex); // Show previous slide
});

document.querySelector(".popup-next").addEventListener("click", function() {
    showSlides(++slideIndex); // Show next slide
});

// Show the first slide when the popup is opened
openPopupBtn.addEventListener("click", function() {
    showSlides(slideIndex);
    popup.style.display = "block"; // Show the popup
});

    // Close the popup
    if (closeBtn) {
        closeBtn.addEventListener("click", function () {
            console.log("Closing popup...");
            popup.style.display = "none"; // Hide the popup
        });
    }

    // Close the popup if the user clicks outside of the popup content
    window.addEventListener("click", function (event) {
        if (event.target === popup) {
            console.log("Clicked outside the popup. Closing...");
            popup.style.display = "none";
        }
    });

    // Next slide
    if (nextBtn) {
        nextBtn.addEventListener("click", function () {
            popupSlideIndex++;
            showPopupSlides(popupSlideIndex);
        });
    }

    // Previous slide
    if (prevBtn) {
        prevBtn.addEventListener("click", function () {
            popupSlideIndex--;
            showPopupSlides(popupSlideIndex);
        });
    }

    // Initially display the first slide (if any)
    showPopupSlides(popupSlideIndex);
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

function updatePrice() {
    let totalPrice = parseFloat(document.getElementById('basePrice').textContent);
    let selectedComponents = [];

    // Track components to avoid duplicates
    let processedComponents = new Set();

    // Loop through all selected components and calculate total price
    document.querySelectorAll('input[type="radio"]:checked, input[type="checkbox"]:checked').forEach(input => {
        let price = parseFloat(input.getAttribute('data-price')) || 0;
        let componentName = input.closest('.component-section').querySelector('h3').textContent; // Get component name
        let componentValue = input.getAttribute('data-name') || 'N/A';  // Default to 'N/A' if no value

        // Handle if "Other" was selected
        if (input.value === 'Other') {
            let customValue = document.getElementById(`customField_${input.name.match(/\d+/)[0]}`).value;
            if (customValue) {
                componentValue = customValue;  // Use the custom value entered by the user
            }
        }

        // Skip if component is already processed
        if (processedComponents.has(componentName)) return;

        processedComponents.add(componentName);  // Mark the component as processed

        totalPrice += price;

        selectedComponents.push({
            componentName: componentName,  // Store the component name
            value: componentValue,  // Store the selected or custom value
            price: price
        });

        // Hide custom field if other options are selected
        if (input.value !== 'Other') {
            hideCustomField(input.name.match(/\d+/)[0]);  // Hide custom field for this component
        }
    });

    // Add custom component values if any (for "Other" option)
    document.querySelectorAll('input[type="text"]').forEach(input => {
        if (input.value) {
            let componentName = input.closest('.component-section').querySelector('h3').textContent; // Get component name

            // Skip if this component has already been processed
            if (processedComponents.has(componentName)) return;

            processedComponents.add(componentName);  // Mark the component as processed

            selectedComponents.push({
                componentName: componentName,  // Store the component name
                value: input.value,  // Store the custom value entered by the user
                price: 0  // No price for custom values
            });
        }
    });

    // Update the price in the modal
    document.getElementById('modalTotalPrice').textContent = totalPrice.toFixed(2);
    document.getElementById('modalComponents').innerHTML = selectedComponents.map(comp => 
        `<p><strong>${comp.componentName}:</strong> ${comp.value} (+${comp.price})</p>`
    ).join('');
}

// Show the custom field for the "Other" option
function showCustomField(componentID) {
    const customField = document.getElementById(`customField_${componentID}`);
    if (customField) {
        customField.style.display = 'block';
        customField.focus();
    }
}

// Hide the custom field if other options are selected
function hideCustomField(componentID) {
    const customField = document.getElementById(`customField_${componentID}`);
    if (customField) {
        customField.style.display = 'none';
        customField.value = '';  // Reset custom value when hidden
    }
}

// Open the modal and update the price and component summary
function openModal() {
    updatePrice();  // Update price and components before opening the modal
    document.getElementById('productModal').style.display = 'block';
}

// Close the modal
function closeModal() {
    document.getElementById('productModal').style.display = 'none';
}


// Update product quantity via AJAX
document.querySelectorAll('.update-quantity').forEach(button => {
    button.addEventListener('click', function () {
        const productId = this.dataset.productId;
        const quantity = document.querySelector(`#quantity-${productId}`).value;

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
            document.querySelector(`#total-price-${productId}`).innerText = data.newTotalPrice;
            document.querySelector('#total-price').innerText = data.newGrandTotal;
        })
        .catch(error => {
            console.error('Error updating quantity:', error);
            alert('Failed to update quantity. Please try again.');
        });
    });
});

// Remove product from basket via AJAX
document.querySelectorAll('.remove-product').forEach(button => {
    button.addEventListener('click', function () {
        const productId = this.dataset.productId;

        fetch(`/basket/remove/${productId}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            document.querySelector(`#product-${productId}`).remove();
            document.querySelector('#total-price').innerText = data.newGrandTotal;
        })
        .catch(error => {
            console.error('Error removing product:', error);
            alert('Failed to remove product. Please try again.');
        });
    });
});


document.addEventListener("DOMContentLoaded", function () {
    // Add event listeners for all "Learn More" buttons
    document.querySelectorAll(".openPopupBtn").forEach(button => {
        button.addEventListener("click", function () {
            const componentId = this.getAttribute("data-product-id"); // Get the ComponentID from the button
            const popup = document.getElementById(`data-product-id`); // Get the popup by ID

            if (!popup) {
                console.error(`Popup with ID detailPopup${componentId} not found.`);
                return; // Exit the function if popup is not found
            }

            // Show the popup
            popup.style.display = "block";

            // Optionally, show the first slide
            showSlides(0, componentId);
        });
    });

    

    // Close button functionality
    document.querySelectorAll(".popup-close").forEach(closeBtn => {
        closeBtn.addEventListener("click", function () {
            const popup = this.closest(".detailPopup");
            if (popup) {
                popup.style.display = "none"; // Hide the popup
            }
        });
    });

    // Next button functionality
    document.querySelectorAll(".popup-next").forEach(nextBtn => {
        nextBtn.addEventListener("click", function () {
            const componentId = this.closest(".detailPopup").id.replace('detailPopup', '');
            let slideIndex = getCurrentSlideIndex(componentId);
            slideIndex++;
            showSlides(slideIndex, componentId); // Show next slide
        });
    });

    // Previous button functionality
    document.querySelectorAll(".popup-prev").forEach(prevBtn => {
        prevBtn.addEventListener("click", function () {
            const componentId = this.closest(".detailPopup").id.replace('detailPopup', '');
            let slideIndex = getCurrentSlideIndex(componentId);
            slideIndex--;
            showSlides(slideIndex, componentId); // Show previous slide
        });
    });

    // Function to get the current slide index
    function getCurrentSlideIndex(componentId) {
        const slides = document.querySelectorAll(`#detailPopup${componentId} .popup-slide`);
        for (let i = 0; i < slides.length; i++) {
            if (slides[i].style.display === "block") {
                return i;
            }
        }
        return 0; // Default to first slide
    }
});
