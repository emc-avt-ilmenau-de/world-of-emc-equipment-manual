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
    const openPopupBtns = document.querySelectorAll(".openPopupBtn");
    const popup_comp_div = document.getElementsByClassName("popup-component")[0];

    openPopupBtns.forEach((btn) => {
        btn.addEventListener("click", function () {
            const component_multimedia_path = btn.getAttribute("comp_multimedia_path");

            let multimediaData;
            try {
                multimediaData = JSON.parse(component_multimedia_path);
                console.log("Parsed JSON:", multimediaData); // Debugging parsed JSON
            } catch (error) {
                console.error("Invalid JSON in comp_multimedia_path:", error);
                return;
            }

            if (multimediaData && popup_comp_div) {
                // Clear previous slides
                popup_comp_div.innerHTML = '';

                // Iterate over multimedia data to create slides
                Object.values(multimediaData).forEach((media, index) => {
                    const slide = document.createElement("div");
                    slide.className = "popup-slide";
                    slide.style.display = "none"; // Hide all slides initially

                    // Normalize the path using Laravel's base URL
                    const baseUrl = window.location.origin; // e.g., http://127.0.0.1:8000
                    const normalizedPath = `${baseUrl}/${media.path.replace(/\\/g, '/')}`;

                    if (normalizedPath.endsWith(".mp4")) {
                        slide.innerHTML = `
                            <video width="100%" controls>
                                <source src="${normalizedPath}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                            <div class="text"><strong>${media.caption || ""}</strong></div>
                        `;
                    } else {
                        slide.innerHTML = `
                            <img src="${normalizedPath}" alt="Slide ${index + 1}" style="width: 80%;">
                            <div class="text"><strong>${media.caption || ""}</strong></div>
                        `;
                    }

                    popup_comp_div.appendChild(slide);
                });

                // Add navigation buttons dynamically if not already present
                if (!popup_comp_div.querySelector(".popup-close")) {
                    popup_comp_div.innerHTML += `
                        <button class="popup-close">Close</button>
                        <button class="popup-prev">Prev</button>
                        <button class="popup-next">Next</button>
                    `;
                }

                let slideIndex = 0;
                const slides = popup_comp_div.getElementsByClassName("popup-slide");
                const closeBtn = popup_comp_div.querySelector(".popup-close");
                const nextBtn = popup_comp_div.querySelector(".popup-next");
                const prevBtn = popup_comp_div.querySelector(".popup-prev");

                function showSlides(n) {
                    if (n >= slides.length) slideIndex = 0;
                    if (n < 0) slideIndex = slides.length - 1;

                    Array.from(slides).forEach((slide) => {
                        slide.style.display = "none";
                    });

                    if (slides[slideIndex]) {
                        slides[slideIndex].style.display = "block";
                    }
                }

                // Show the first slide
                showSlides(slideIndex);

                // Show the popup
                popup_comp_div.style.display = "block";

                // Navigation buttons
                nextBtn.addEventListener("click", () => {
                    slideIndex++;
                    showSlides(slideIndex);
                });

                prevBtn.addEventListener("click", () => {
                    slideIndex--;
                    showSlides(slideIndex);
                });

                closeBtn.addEventListener("click", () => {
                    popup_comp_div.style.display = "none";
                });

                window.addEventListener("click", (event) => {
                    if (event.target === popup_comp_div) {
                        popup_comp_div.style.display = "none";
                    }
                });
            } else {
                console.error("Popup or multimedia path not found.");
            }
        });
    });
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

// Update price and component summary
function updatePrice() {
    let totalPrice = parseFloat(document.getElementById("basePrice").textContent) || 0;
    let selectedComponents = [];

    // Track processed components
    let processedComponents = new Set();

    // Handle all checked inputs (radio & checkbox)
    document.querySelectorAll("input[type='radio']:checked, input[type='checkbox']:checked").forEach((input) => {
        let price = parseFloat(input.getAttribute("data-price")) || 0;
        let componentName = input.closest(".component-section").querySelector("h3").textContent;
        let componentValue = input.getAttribute("data-name") || input.value;

        // Special handling for "Other" input
        if (input.value === "Other") {
            const customInputId = `customField_${input.name.match(/\d+/)[0]}`;
            const customValue = document.getElementById(customInputId)?.value.trim();
            if (customValue) {
                componentValue = customValue;
            }
        }

        // Special handling for Software component
        if (componentName === "Software") {
            if (!processedComponents.has(componentName)) {
                processedComponents.add(componentName);

                // Gather all selected software checkboxes
                document.querySelectorAll(`input[name^="components"]:checked`).forEach((softwareInput) => {
                    if (softwareInput.closest(".component-section").querySelector("h3").textContent === "Software") {
                        const softwareValue = softwareInput.getAttribute("data-name");
                        const softwarePrice = parseFloat(softwareInput.getAttribute("data-price")) || 0;

                        selectedComponents.push({
                            componentName: componentName,
                            value: softwareValue,
                            price: softwarePrice,
                        });
                        totalPrice += softwarePrice;
                    }
                });
            }
            return; // Skip the default processing for Software
        }

        // Avoid duplicate components
        if (processedComponents.has(componentName)) return;

        processedComponents.add(componentName);
        totalPrice += price;

        selectedComponents.push({
            componentName: componentName,
            value: componentValue,
            price: price,
        });
    });

    // Handle custom text inputs
    document.querySelectorAll("input[type='text']").forEach((input) => {
        if (input.value.trim()) {
            const componentName = input.closest(".component-section").querySelector("h3").textContent;

            if (!processedComponents.has(componentName)) {
                processedComponents.add(componentName);

                selectedComponents.push({
                    componentName: componentName,
                    value: input.value.trim(),
                    price: 0,
                });
            }
        }
    });

    // Update the modal with the selected components and total price
    document.getElementById("modalTotalPrice").textContent = totalPrice.toFixed(2);
    document.getElementById("modalComponents").innerHTML = selectedComponents
        .map(
            (comp) =>
                `<p><strong>${comp.componentName}:</strong> ${comp.value} (+${comp.price})</p>`
        )
        .join("");
}


// Show the custom field for "Other" option
function showCustomField(componentID) {
    const customField = document.getElementById(`customField_${componentID}`);
    if (customField) {
        customField.style.display = "block";
        customField.focus();
    }
}

// Hide the custom field for "Other" option
function hideCustomField(componentID) {
    const customField = document.getElementById(`customField_${componentID}`);
    if (customField) {
        customField.style.display = "none";
        customField.value = ""; // Reset custom value
    }
}

// Open the modal and update price and summary
function openModal() {
    updatePrice();
    document.getElementById("productModal").style.display = "block";
}

// Close the modal
function closeModal() {
    document.getElementById("productModal").style.display = "none";
}

document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("addToBasketForm");
    const powerPlugInput = document.getElementById("powerPlugInput");
    const powerPlugError = document.getElementById("powerPlugError");

    // Validate components and Power Plug input on form submission
    form.addEventListener("submit", function (event) {
        event.preventDefault(); // Prevent default form submission
        let isFormValid = validateSelection();

        // Validate Power Plug input if it exists
        if (powerPlugInput) {
            if (powerPlugInput.value.trim() === "") {
                isFormValid = false;
                powerPlugError.style.display = "block"; // Show error message
                powerPlugInput.style.borderColor = "red"; // Highlight the field
            } else {
                powerPlugError.style.display = "none"; // Hide error message
                powerPlugInput.style.borderColor = ""; // Reset field styling
            }
        }

        // If the form is valid, submit the form
        if (isFormValid) {
            form.submit();
        }
    });

    // Real-time validation for Power Plug input
    if (powerPlugInput) {
        powerPlugInput.addEventListener("input", function () {
            if (powerPlugInput.value.trim() !== "") {
                powerPlugError.style.display = "none";
                powerPlugInput.style.borderColor = ""; // Reset field styling
            }
        });
    }

    // Function to validate component selection
    function validateSelection() {
        let isValid = true;
        let errorMessages = [];

        // Loop through each component section
        document.querySelectorAll(".component-section").forEach((section) => {
            const radioButtons = section.querySelectorAll('input[type="radio"]');
            const checkboxes = section.querySelectorAll('input[type="checkbox"]');
            const textInput = section.querySelector('input[type="text"]');
            const otherRadio = section.querySelector('input[type="radio"][value="Other"]');

            let isComponentValid = false;

            // Check if any radio button or checkbox is selected
            if (radioButtons.length > 0) {
                isComponentValid = Array.from(radioButtons).some((input) => input.checked);
            } else if (checkboxes.length > 0) {
                isComponentValid = Array.from(checkboxes).some((input) => input.checked);
            }

            // Handle "Other" input field validation
            if (!isComponentValid && otherRadio && otherRadio.checked && textInput) {
                if (textInput.value.trim() === "") {
                    errorMessages.push(
                        `${section.querySelector("h3").textContent} requires a custom value.`
                    );
                    textInput.style.borderColor = "red"; // Highlight the custom field
                    isValid = false;
                } else {
                    textInput.style.borderColor = ""; // Reset styling if valid
                    isComponentValid = true; // Mark as valid if custom value is provided
                }
            }

            // If no selection or valid input, mark as invalid
            if (!isComponentValid && !section.contains(powerPlugInput)) {
                errorMessages.push(
                    `${section.querySelector("h3").textContent} requires a selection.`
                );
                isValid = false;
            }
        });

        // Display error messages
        if (!isValid) {
            alert("Please fix the following errors:\n" + errorMessages.join("\n"));
        }

        return isValid;
    }
});

document.addEventListener("DOMContentLoaded", function () {
    const basicCheckbox = document.querySelector('input[data-name="Basic"]');
    if (basicCheckbox) {
        basicCheckbox.checked = true; // Ensure it is checked
        basicCheckbox.addEventListener("click", (event) => {
            event.preventDefault(); // Prevent deselection
        });
    }
});



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


