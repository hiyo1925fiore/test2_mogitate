document.addEventListener("DOMContentLoaded", function () {
    // Get the image input element
    const imageInput = document.getElementById("image");

    if (!imageInput) return; // Exit if element doesn't exist

    // Create preview container
    const previewContainer = document.createElement("div");
    previewContainer.className = "register-form_preview-container";
    previewContainer.style.marginTop = "10px";
    previewContainer.style.display = "none";

    // Create preview image element
    const previewImage = document.createElement("img");
    previewImage.className = "register-form_preview-image";
    previewImage.style.maxWidth = "24%";
    previewImage.style.maxHeight = "24%";
    previewImage.style.border = "1px solid #ccc";

    // Add image to container
    previewContainer.appendChild(previewImage);

    // Add container after the image input
    imageInput.parentNode.insertBefore(
        previewContainer,
        imageInput.nextSibling
    );

    // Add change event listener to image input
    imageInput.addEventListener("change", function (event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();

            // When file is loaded, set image source and show container
            reader.onload = function (e) {
                previewImage.src = e.target.result;
                previewContainer.style.display = "block";
            };

            // Read the selected file as a data URL
            reader.readAsDataURL(file);
        } else {
            // Hide preview if no file is selected
            previewContainer.style.display = "none";
        }
    });
});
