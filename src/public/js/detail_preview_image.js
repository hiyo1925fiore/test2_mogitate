document.addEventListener("DOMContentLoaded", function () {
    // Get the file input element
    const imageInput = document.getElementById("image");

    // Find the existing image element - this is your original product image
    const existingImage = imageInput.parentNode.parentNode.querySelector("img");

    // Store reference to the existing image or create a new one if it doesn't exist
    let imagePreview = existingImage;
    if (!imagePreview) {
        imagePreview = document.createElement("img");
        imagePreview.id = "image-preview";
        imagePreview.style.maxWidth = "200px";
        imagePreview.style.marginTop = "10px";
        imageInput.parentNode.appendChild(imagePreview);
    } else {
        // If using existing image, ensure it has an ID for easier reference
        imagePreview.id = "image-preview";
    }

    // Add event listener to the file input
    if (imageInput) {
        imageInput.addEventListener("change", function () {
            // Check if a file is selected
            if (this.files && this.files[0]) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    // Update the preview image source
                    imagePreview.src = e.target.result;
                    imagePreview.style.display = "block";
                };

                // Read the selected file as a data URL
                reader.readAsDataURL(this.files[0]);
            }
        });
    }

    // Add this after initializing imageInput
    if (imageInput) {
        // Display current image filename if it exists
        const currentImage = document.querySelector(
            'input[name="current_image"]'
        );
        if (currentImage && currentImage.value) {
            const filenameDisplay = document.createElement("div");
            filenameDisplay.className = "file-selected";
            filenameDisplay.textContent = currentImage.value.split("/").pop();
            imageInput.parentNode.insertBefore(
                filenameDisplay,
                imageInput.nextSibling
            );
        }
    }
});
