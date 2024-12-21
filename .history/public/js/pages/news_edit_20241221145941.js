
const imageInput = document.getElementById("image");
const newImagePreview = document.getElementById("newImagePreview");
const currentImagePreview = document.getElementById("currentImagePreview");
const cancelBtn = document.getElementById("cancel-btn");
const fileSizeError = document.getElementById("file-size-error");

imageInput.addEventListener("change", function(event) {
    const file = event.target.files[0];
    if (file) {
        const fileSize = file.size / 1024 / 1024; // size in MB
        const maxSize = 2; // 2 MB

        // Check file size
        if (fileSize > maxSize) {
            fileSizeError.textContent = "File size exceeds 2MB. Please upload a smaller image.";
            imageInput.value = ""; // clear the file input
            newImagePreview.style.display = "none";
            cancelBtn.style.display = "none";
            return;
        }

        fileSizeError.textContent = "";
        const reader = new FileReader();
        reader.onload = function(e) {
            newImagePreview.src = e.target.result;
            newImagePreview.style.display = "block";
            cancelBtn.style.display = "inline-block";
        };
        reader.readAsDataURL(file);

        // Hide current image preview if a new one is selected
        if (currentImagePreview) {
            currentImagePreview.style.display = "none";
        }
    }
});

// Cancel the new image selection and reset preview
cancelBtn.addEventListener("click", function() {
    imageInput.value = ""; // Reset file input
    newImagePreview.style.display = "none";
    cancelBtn.style.display = "none";

    // Show the original current image preview if available
    if (currentImagePreview) {
        currentImagePreview.style.display = "block";
    }
});
