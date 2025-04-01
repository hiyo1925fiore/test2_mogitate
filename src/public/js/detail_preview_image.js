document.addEventListener("DOMContentLoaded", function () {
    // Get the file input element
    const imageInput = document.getElementById("image");

    // Find the existing image element - this is your original product image
    const existingImage = imageInput.parentNode.querySelector("img");

    // Store reference to the existing image or create a new one if it doesn't exist
    let imagePreview = existingImage;
    if (!imagePreview) {
        imagePreview = document.createElement("img");
        imagePreview.id = "image-preview";
        imagePreview.style.maxWidth = "100%";
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
});
