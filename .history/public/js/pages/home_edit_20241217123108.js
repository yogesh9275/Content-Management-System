// Function to handle image upload and preview
function handleImageUpload(
    fileInputId,
    cancelBtnID,
    previewImgId,
    errorId,
    originalImageSrc
) {
    var fileInput = document.getElementById(fileInputId);
    var cancelBtn = document.getElementById(cancelBtnID);
    var previewImg = document.getElementById(previewImgId);
    var fileSizeError = document.getElementById(errorId);

    // Store the original image source
    const originalImage = originalImageSrc;

    // When a file is selected, show preview
    fileInput.addEventListener("change", function (event) {
        var file = event.target.files[0];
        var reader = new FileReader();

        reader.onload = function (e) {
            if (file && file.size <= 2 * 1024 * 1024) {
                // Check if file size is within 2MB
                previewImg.src = e.target.result; // Set image source to the selected file
                cancelBtn.style.display = "inline-block"; // Show cancel button
                document.getElementById("image-preview").style.display =
                    "block"; // Show image preview container
                fileSizeError.textContent = ""; // Clear any file size error
            }
        };

        if (file) {
            const fileSize = file.size / 1024 / 1024; // Convert bytes to MB
            const maxSize = 2; // Max 2MB
            if (fileSize > maxSize) {
                fileSizeError.textContent =
                    "File size exceeds 2MB. Please upload a smaller image."; // Display error
                fileInput.value = ""; // Clear input
                previewImg.src = ""; // Clear image source
                cancelBtn.style.display = "none"; // Hide cancel button
                document.getElementById("image-preview").style.display = "none"; // Hide preview container
                return;
            }
            fileSizeError.textContent = ""; // Clear file size error
            reader.readAsDataURL(file); // Preview image
        }
    });

    // Logic for cancel button to clear file input and hide preview
    cancelBtn.addEventListener("click", function () {
        fileInput.value = ""; // Clear file input
        previewImg.src = originalImage; // Clear image source
        cancelBtn.style.display = "none"; // Hide cancel button
    });
}

// Initialize event listeners for both About Image and Regular Image inputs
document.addEventListener("DOMContentLoaded", function () {
    // Pass the original image URL into handleImageUpload
    const originalImageSrc = document.getElementById("preview-img").src;
    // Handle both About Image and Regular Image
    handleImageUpload(
        "data-about-image",
        "about-cancel-btn",
        "preview-img",
        "about-file-size-error",
        originalImageSrc
    ); // Handle About Image
    handleImageUpload(
        "data-vision-image",
        "vision-cancel-btn",
        "preview-img",
        "vision-file-size-error",
        originalImageSrc
    ); // Handle Vision Image
    handleImageUpload(
        "data-slider-image",
        "slider-cancel-btn",
        "preview-img",
        "slider-file-size-error",
        originalImageSrc
    ); // Handle Slider Image
    handleImageUpload(
        "data-image",
        "cancel-btn",
        "preview-img",
        "about-file-size-error",
        originalImageSrc
    ); // Handle Regular Image

    // Toggle visibility and set up other element-specific logic
    toggleDivs();

    // Regular description
    updateWordCount(
        "data-description",
        "word-count-display",
        "word-count-error",
        250
    );

    // Update word count and handle error for About Description
    updateWordCount(
        "data-about-description",
        "about-word-count-display",
        "about-word-count-error",
        250
    );

    // Update word count and handle error for Vision Description
    updateWordCount(
        "data-vision-description",
        "vision-word-count-display",
        "vision-word-count-error",
        250
    );

    // Set the back button behavior to navigate to the previous page
    const backBtn = document.getElementById('back-btn');
    const prevPage = document.referrer; // Gets the referring page URL

    if (prevPage) {
        backBtn.href = prevPage; // Set the back button to the previous page's URL
    } else {
        backBtn.href = '/homepage'; // Fallback redirect if no referrer (in case of direct access)
    }
});

// Toggle visibility of element-specific sections
function toggleDivs() {
    const selectedElement = document.getElementById("element").value;
    const elementDivs = document.querySelectorAll(".element-div");
    elementDivs.forEach(function (div) {
        div.style.display = div.id === selectedElement ? "block" : "none";
    });
}

// Word count function
function countWords(text) {
    return text.split(/\s+/).filter(Boolean).length;
}

// Update word count and button state
function updateWordCount(textareaId, displayId, errorId, maxWords) {
    const textarea = document.getElementById(textareaId);
    const wordCountDisplay = document.getElementById(displayId);
    const wordCountError = document.getElementById(errorId);
    const submitButton = document.getElementById("create-btn");

    // Function to update the word count
    function handleWordCount() {
        var wordCount = countWords(textarea.value);
        wordCountDisplay.textContent = `Words: ${wordCount}/${maxWords}`;

        // Disable submit button if word count exceeds max
        if (wordCount > maxWords) {
            submitButton.disabled = true;
            wordCountError.style.display = "block";
        } else {
            submitButton.disabled = false;
            wordCountError.style.display = "none";
        }
    }

    // Initialize word count display when page loads
    handleWordCount();

    // Listen for input events to update the word count and button status dynamically
    textarea.addEventListener("input", handleWordCount);
}
