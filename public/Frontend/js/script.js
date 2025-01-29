document.addEventListener('DOMContentLoaded', function () {
    const categoryGroups = document.querySelectorAll('.category-group');
    const allProductsHeading = document.getElementById('all-products-heading');

    // Check if 'all-products-heading' exists; if not, log a warning and exit gracefully
    if (!allProductsHeading) {
      
        return; // Stop further execution if the heading is not relevant on this page
    }

    function showCategory(categoryClass) {
        let showHeading = true;

        categoryGroups.forEach(group => {
            if (categoryClass === 'all') {
                group.style.display = 'block'; // Show all categories
            } else {
                group.style.display = (group.id === `${categoryClass}-category`) ? 'block' : 'none';
                if (group.style.display === 'block') {
                    showHeading = false;
                }
            }
        });

        // Update display of the 'all-products-heading'
        allProductsHeading.style.display = showHeading ? 'block' : 'none';
    }

    const urlParams = new URLSearchParams(window.location.search);
    const categoryParam = urlParams.get('category');

    if (categoryParam) {
        console.log("URL category parameter found:", categoryParam);
        showCategory(categoryParam);
    } else {
        
        showCategory('all');
    }

    window.showCategory = showCategory;

    const dropdownLinks = document.querySelectorAll('.dropdown-content a');
    if (dropdownLinks.length > 0) {
        dropdownLinks.forEach(anchor => {
            anchor.addEventListener('click', function () {
                console.log("Category clicked:", this.getAttribute('href'));

                dropdownLinks.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');

                const categoryClass = this.getAttribute('href')?.replace('/', '') || '';
                if (categoryClass) {
                    showCategory(categoryClass);
                } else {
                    console.error("Invalid category class.");
                }
            });
        });
    } else {
        console.warn("No dropdown links found.");
    }
});





document.addEventListener("DOMContentLoaded", function () {
    // Slideshow logic scoped within this function
    let currentSlideIndex = 1; // Scoped to this block

    function plusSlides(n) {
        showSlides(currentSlideIndex += n);
    }

    function currentSlide(n) {
        showSlides(currentSlideIndex = n);
    }

    function showSlides(n) {
        const slides = document.getElementsByClassName("mySlides");

        // Wrap around the slide index if out of range
        if (n > slides.length) {
            currentSlideIndex = 1;
        }
        if (n < 1) {
            currentSlideIndex = slides.length;
        }

        // Hide all slides
        for (let i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }

        // Show the current slide
        if (slides[currentSlideIndex - 1]) {
            slides[currentSlideIndex - 1].style.display = "block";
        }
    }

    // Event listeners for next/prev buttons
    document.querySelector(".next")?.addEventListener("click", function () {
        plusSlides(1);
    });

    document.querySelector(".prev")?.addEventListener("click", function () {
        plusSlides(-1);
    });

    // Initialize slideshow
    showSlides(currentSlideIndex);
});



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
                console.log("Parsed JSON:", multimediaData);
            } catch (error) {
                console.error("Invalid JSON in comp_multimedia_path:", error);
                return;
            }

            if (multimediaData && popup_comp_div) {
                // Clear previous slides
                popup_comp_div.innerHTML = "";

                // Iterate over multimedia data to create slides
                Object.values(multimediaData).forEach((media, index) => {
                    const slide = document.createElement("div");
                    slide.className = "popup-slide";
                    slide.style.display = "none";

                    const baseUrl = window.location.origin;
                    const normalizedPath = `${baseUrl}/${media.path.replace(/\\\\/g, "/")}`;

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

                // Add navigation buttons dynamically
                if (!popup_comp_div.querySelector(".popup-close")) {
                    popup_comp_div.innerHTML += `
                        <button class="popup-close">Close</button>
                        <button class="popup-prev">Prev</button>
                        <button class="popup-next">Next</button>
                    `;
                }

                // Scope variables to this popup
                let popupSlideIndex = 0; // Isolated slide index
                const slides = popup_comp_div.getElementsByClassName("popup-slide");
                const closeBtn = popup_comp_div.querySelector(".popup-close");
                const nextBtn = popup_comp_div.querySelector(".popup-next");
                const prevBtn = popup_comp_div.querySelector(".popup-prev");

                function showPopupSlides(n) {
                    if (n >= slides.length) popupSlideIndex = 0;
                    if (n < 0) popupSlideIndex = slides.length - 1;

                    Array.from(slides).forEach((slide) => {
                        slide.style.display = "none";
                    });

                    if (slides[popupSlideIndex]) {
                        slides[popupSlideIndex].style.display = "block";
                    }
                }

                // Show the first slide
                showPopupSlides(popupSlideIndex);

                // Show the popup
                popup_comp_div.style.display = "block";

                // Navigation buttons
                nextBtn.addEventListener("click", () => {
                    popupSlideIndex++;
                    showPopupSlides(popupSlideIndex);
                });

                prevBtn.addEventListener("click", () => {
                    popupSlideIndex--;
                    showPopupSlides(popupSlideIndex);
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

// Update price and component summary with enhanced logic and error handling
// Update price and component summary with enhanced logic and error handling
function updatePrice() {
    let totalPrice = parseFloat(document.getElementById("basePrice").textContent) || 0;
    let selectedComponents = [];
    let processedComponents = new Set(); // Prevent duplicate components

    // ✅ Handle all checked inputs (radio & checkbox)
    document.querySelectorAll("input[type='radio']:checked, input[type='checkbox']:checked").forEach((input) => {
        const componentSection = input.closest(".component-section");

        // ✅ Check if component section exists
        if (!componentSection) {
            console.warn("Missing component-section for input:", input);
            return;
        }

        // ✅ Fetch the component name and value
        let componentNameElement = componentSection.querySelector("h3");
        let componentName = componentNameElement ? componentNameElement.textContent : "Undefined Component";

        let componentValue =
            input.getAttribute("data-name") ||
            componentSection.querySelector(`label[for='${input.id}']`)?.textContent.trim() ||
            input.value;

        let price = parseFloat(input.getAttribute("data-price")) || 0;

        // ✅ Handle "Other" Option
        if (input.value === "Other") {
            const customInputId = `customField_${input.name.match(/\d+/)[0]}`;
            const customValueElement = document.getElementById(customInputId);
            const customValue = customValueElement ? customValueElement.value.trim() : null;
            if (customValue) {
                componentValue = customValue;
            }
        }

       // ✅ Special Handling for Object Area (4K MiniCam Lens and 4K-MiniCam Objektive)
       let objectAreaAppended = false;
       if (componentName.includes("4K MiniCam Lens") || componentName.includes("4K-MiniCam Objektive")) {
           const objectAreaInput = document.getElementById(`objectAreaInput_${input.name.match(/\d+/)[0]}`);
           if (objectAreaInput && objectAreaInput.style.display !== "none") {
               const objectAreaValue = objectAreaInput.querySelector("input").value.trim();

               // ✅ Append Object Area only if the value is valid (≥ 12mm)
               if (objectAreaValue && parseFloat(objectAreaValue) >= 12) {
                   if (componentName.includes("4K MiniCam Lens")) {
                       componentValue += `, Object Area: ${objectAreaValue}`;
                   } else if (componentName.includes("4K-MiniCam Objektive")) {
                       componentValue += `, Objekt Bereich: ${objectAreaValue}`;
                   }
                   objectAreaAppended = true;
               }
           }
       }

        // ✅ Special Handling for Software Component
        if (componentName === "Software") {
            if (!processedComponents.has(componentName)) {
                processedComponents.add(componentName);

                // Gather all selected software checkboxes
                document.querySelectorAll(`input[name^="components"]:checked`).forEach((softwareInput) => {
                    if (
                        softwareInput
                            .closest(".component-section")
                            ?.querySelector("h3")
                            .textContent === "Software"
                    ) {
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

        if (input.value == "28") {
            // When Variant 3 is selected
            const additionalComponentsSection = document.getElementById("additionalComponentsSection");
            if (additionalComponentsSection) {
                additionalComponentsSection.style.display = "block";

                document.querySelectorAll("#additionalComponentsSection input:checked").forEach((additionalInput) => {
                    const additionalComponentSection = additionalInput.closest(".component-section");
                    const additionalComponentId = additionalInput.getAttribute("data-id"); // Use ID
                    const additionalComponentName =
                        additionalComponentSection?.querySelector("h3")?.textContent || "Undefined Component";
                    const additionalComponentValue =
                        additionalInput.getAttribute("data-name") || additionalInput.value;
                    const additionalPrice = parseFloat(additionalInput.getAttribute("data-price")) || 0;

                    if (!processedComponents.has(`${additionalComponentId}:${additionalComponentValue}`)) {
                        processedComponents.add(`${additionalComponentId}:${additionalComponentValue}`);
                        selectedComponents.push({
                            componentId: additionalComponentId, // Use ID here
                            componentName: additionalComponentName,
                            value: additionalComponentValue,
                            price: additionalPrice,
                        });
                        totalPrice += additionalPrice;
                    }
                });
            }
        } else {
            // When Variant 3 is not selected
            const additionalComponentsSection = document.getElementById("additionalComponentsSection");
            if (additionalComponentsSection) {
                additionalComponentsSection.style.display = "none";

                // Mark components 12 and 13 as hidden instead of removing them
                selectedComponents = selectedComponents.map((component) => {
                    if (component.componentId === "12") {
                        return { ...component, hidden: true }; // Add hidden flag
                    }
                    return component;
                });

                console.log("Components 12 are marked as hidden.");
            }
        }

        // ✅ Prevent duplicate components being added
        const componentKey = `${componentName}:${componentValue}`;
        if (processedComponents.has(componentKey)) return;

        // ✅ Add component and update price
        processedComponents.add(`${componentName}:${componentValue}`);
        totalPrice += price;
        selectedComponents.push({
            componentName: componentName,
            value: componentValue,
            price: price,
        });
    });

    // ✅ Handle custom text inputs for components
    document.querySelectorAll("input[type='text']").forEach((input) => {
        if (input.value.trim()) {
            const componentSection = input.closest(".component-section");
            const componentName = componentSection?.querySelector("h3")?.textContent || "Undefined Component";

            // ✅ Prevent duplicate custom inputs
            const customKey = `${componentName}:${input.value.trim()}`;
            if (!processedComponents.has(customKey)) {
                processedComponents.add(customKey);

                selectedComponents.push({
                    componentName: componentName,
                    value: input.value.trim(),
                    price: 0,
                });
            }
        }
    });

    // ✅ Special Handling for Showing Component 14
    const shouldShowComponent14 = selectedComponents.some(
        (comp) => ["11", "12"].includes(comp.value)
    );
    const component14Section = document.querySelector(`.component-section[data-component-id="14"]`);
    if (component14Section) {
        component14Section.style.display = shouldShowComponent14 ? "block" : "none";
    }

    // ✅ Special Handling for Showing Components 12 and 15 When 28 is Selected
    const shouldShowComponent12And15 = selectedComponents.some((comp) => comp.value === "28");
    const component12Section = document.querySelector(`.component-section[data-component-id="12"]`);
    const component15Section = document.querySelector(`.component-section[data-component-id="15"]`);

    if (component12Section) component12Section.style.display = shouldShowComponent12And15 ? "block" : "none";
    if (component15Section) component15Section.style.display = shouldShowComponent12And15 ? "block" : "none";

    // ✅ Remove duplicates (Final Step)
    selectedComponents = selectedComponents.filter((value, index, self) =>
        index === self.findIndex((t) => t.componentName === value.componentName && t.value === value.value)
    );

    // ✅ Update the modal with the selected components and total price
    document.getElementById("modalTotalPrice").textContent = totalPrice.toFixed(2);
    document.getElementById("modalComponents").innerHTML = selectedComponents
        .map((comp) => `<p><strong>${comp.componentName}:</strong> ${comp.value} (+${comp.price.toFixed(2)})</p>`)
        .join("");
}




// Show the custom field when "Other" is selected
function showCustomField(componentID) {
    const customField = document.getElementById(`customField_${componentID}`);
    if (customField) {
        customField.style.display = "block";
        customField.focus();
    }
}

// Hide the custom field when any other option is selected
function hideCustomField(componentID) {
    const customField = document.getElementById(`customField_${componentID}`);
    if (customField) {
        customField.style.display = "none";
        customField.value = ""; // Clear input value when hiding
    }
}

// Ensure all radio buttons toggle visibility correctly
document.querySelectorAll("input[type='radio']").forEach(input => {
    input.addEventListener('change', function () {
        const componentID = this.name.match(/\d+/)?.[0]; // Extract the component ID
        if (!componentID) return; // Exit if no component ID is found

        // Check if the clicked option is "Other"
        if (this.value === "Other") {
            showCustomField(componentID); // Show the custom field
        } else {
            hideCustomField(componentID); // Hide and clear the custom field
        }
    });
});





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
    const additionalComponentsSection = document.getElementById("additionalComponentsSection");

    if (!form) {
        console.warn("Form not found in the DOM.");
        return;
    }

    form.addEventListener("submit", function (event) {
        event.preventDefault();

        let isFormValid = validateSelection();

        

        if (isFormValid) {
            const formData = new FormData(form);

            // Collect and add Components 12 and 13 values if applicable
            if (additionalComponentsSection?.style.display !== "none") {
                const component12Input = document.querySelector("input[name='components[12,15]']");
                
                if (component12Input && component12Input.value.trim() !== "") {
                    formData.append("components[12]", component12Input.value.trim());
                }
                
            }

            console.log("Form data submitted:", Object.fromEntries(formData.entries())); // Debugging
            form.submit();
        }
    });

   
    function validateSelection() {
        let isValid = true;
        let errorMessages = [];

        const isComponentValue29Selected = Array.from(
            document.querySelectorAll('input[type="radio"]:checked')
        ).some((input) => input.value === "28");

        document.querySelectorAll(".component-section").forEach((section) => {
            const radioButtons = section.querySelectorAll('input[type="radio"]');
            const checkboxes = section.querySelectorAll('input[type="checkbox"]');
            const textInput = section.querySelector('input[type="text"]');
            const otherRadio = section.querySelector('input[type="radio"][value="Other"]');
            const componentId = section.querySelector('input')?.name.match(/\d+/)?.[0];

            if (
                (componentId === "12") &&
                (!isComponentValue29Selected || additionalComponentsSection?.style.display === "none")
            ) {
                return;
            }

            let isComponentValid = false;

            if (radioButtons.length > 0) {
                isComponentValid = Array.from(radioButtons).some((input) => input.checked);
            } else if (checkboxes.length > 0) {
                isComponentValid = Array.from(checkboxes).some((input) => input.checked);
            }

            if (!isComponentValid && otherRadio && otherRadio.checked && textInput) {
                if (textInput.value.trim() === "") {
                    errorMessages.push(
                        `${section.querySelector("h3")?.textContent || "Custom value"} requires a custom value.`
                    );
                    textInput.style.borderColor = "red";
                    isValid = false;
                } else {
                    textInput.style.borderColor = "";
                    isComponentValid = true;
                }
            }

            if (!isComponentValid && !section.contains(powerPlugInput)) {
                const sectionTitle = section.querySelector("h3")?.textContent || "Unknown Component";
                errorMessages.push(`${sectionTitle} requires a selection.`);
                isValid = false;
            }
        });

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


// Modal handling
document.addEventListener("DOMContentLoaded", function () {
const modal = document.getElementById('orderModal');
const openBtn = document.getElementById('openOrderModal');
const closeBtn = document.getElementById('closeOrderModal');
const closeModalButton = document.getElementById('closeOrderModalButton');

if (modal && openBtn && closeBtn && closeModalButton) {
    openBtn.addEventListener('click', () => modal.style.display = 'block');
    closeBtn.addEventListener('click', () => modal.style.display = 'none');
    closeModalButton.addEventListener('click', () => modal.style.display = 'none');

    window.addEventListener('click', (event) => {
        if (event.target === modal) modal.style.display = 'none';
    });



}
});

// Check object area input for values >= 12mm
function checkObjectAreaInput(selectedValue, componentID) {
    const objectAreaDiv = document.getElementById(`objectAreaInput_${componentID}`);
    const numericValue = parseFloat(selectedValue);

    if (!objectAreaDiv) {
        console.warn(`Object area container not found for componentID: ${componentID}`);
        return;
    }

    if (numericValue >= 12) {
        objectAreaDiv.style.display = "block";
        const objectAreaInput = document.getElementById(`objectArea_${componentID}`);
        if (objectAreaInput) {
            objectAreaInput.focus(); // Focus the input
        }
        console.log(`Showing object area input for value >= 12: objectArea_${componentID}`);
    } else {
        objectAreaDiv.style.display = "none";
        const objectAreaInput = document.getElementById(`objectArea_${componentID}`);
        if (objectAreaInput) {
            objectAreaInput.value = ""; // Clear the input field
            console.log(`Hiding and clearing object area input: objectArea_${componentID}`);
        }
    }
}

    /**
     * JavaScript to show/hide components 12 and 13 based on selection of Variant 3 (ComponentValueID 29)
     */
    function handleComponentSelection(inputElement, componentValueID) {
        const selectedValueIDs = [28, 11, 12]; // IDs that trigger visibility
        
        // Show/Hide Entire Additional Components Section
        const additionalComponentsSection = document.getElementById('additionalComponentsSection');
        const anyChecked = Array.from(document.querySelectorAll('input[type="radio"]:checked'))
            .some(input => selectedValueIDs.includes(parseInt(input.value)));
        additionalComponentsSection.style.display = anyChecked ? 'block' : 'none';
    
        // Individual Component Handling
        toggleComponentVisibility(14, [11, 12]); // Show Component 14 when ID 11 or 12 is selected
        toggleComponentVisibility(12, [28]); // Show Component 12 when ID 28 is selected
        toggleComponentVisibility(15, [28]); // Show Component 15 when ID 28 is selected
    }
    
    // Function to Show/Hide Individual Components
    function toggleComponentVisibility(componentID, triggerIDs) {
        const componentSection = document.querySelector(`.component-section[data-component-id="${componentID}"]`);
        
        if (componentSection) {
            const isTriggered = Array.from(document.querySelectorAll('input[type="radio"]:checked'))
                .some(input => triggerIDs.includes(parseInt(input.value)));
            componentSection.style.display = isTriggered ? 'block' : 'none';
        }
    }
    
    // Attach Event Listeners to All Radio Inputs
    document.querySelectorAll('input[type="radio"]').forEach(input => {
        input.addEventListener('change', function() {
            handleComponentSelection(this, parseInt(this.value));
        });
    });
    
    
    
