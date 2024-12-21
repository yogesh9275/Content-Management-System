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
    // Get the back button element
    const backBtn = document.getElementById('back-btn');

    // Try to get the referrer (previous page URL)
    const prevPage = document.referrer;

    if (prevPage) {
        // Set href of the back button to the previous page's URL
        backBtn.href = prevPage;
    } else {
        // Fallback: if no referrer, go to the homepage
        backBtn.href = '/homepage'; // This can be adjusted to any fallback URL.
    }

    // Ensure the rest of your script functionality remains intact
    handleImageUpload(
        "data-image", "cancel-btn", "preview-img", "file-size-error", document.getElementById("preview-img").src
    );

        // Ensure the rest of your script functionality remains intact for about section
        handleImageUpload(
            "about-data-image", "about-cancel-btn", "preview-img", "about-file-size-error", document.getElementById("preview-img").src
        );

    // Perform other necessary setup (word count and visibility toggling)
    toggleDivs();
    updateWordCount("data-paragraph", "word-count-display-Paragraph", "word-count-error-Paragraph", 250);
    updateWordCount("data-paragraph-2004", "word-count-display-2004", "word-count-error-2004", 250);
    updateWordCount("data-paragraph-2014", "word-count-display-2014", "word-count-error-2014", 250);
    updateWordCount("data-paragraph-2016", "word-count-display-2016", "word-count-error-2016", 250);
    updateWordCount("data-paragraph-2018", "word-count-display-2018", "word-count-error-2018", 250);
    updateWordCount("data-paragraph-2021", "word-count-display-2021", "word-count-error-2021", 250);
    updateWordCount("data-paragraph-2024", "word-count-display-2024", "word-count-error-2024", 250);
});

// Toggle visibility of element-specific sections
function toggleDivs() {
    const selectedElement = document.getElementById("element").value;
    const elementDivs = document.querySelectorAll(".element-div");

    // Iterate over each element-div
    elementDivs.forEach(function (div) {
        const inputs = div.querySelectorAll('input, textarea, select'); // Get all inputs inside the div

        // Check if the div's id matches the selected element
        if (div.id === selectedElement) {
            div.style.display = "block"; // Show the selected element div
            inputs.forEach(function (input) {
                input.disabled = false; // Enable the input fields in the selected div
            });
        } else {
            div.style.display = "none"; // Hide non-selected element divs
            inputs.forEach(function (input) {
                input.disabled = true; // Disable the input fields in non-selected divs
                input.value = ''; // Optionally clear the non-selected input fields to avoid data being submitted
            });
        }
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
    const submitButton = document.getElementById("update-btn");

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
