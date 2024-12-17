// Word count function
function countWords(text) {
    return text.split(/\s+/).filter(Boolean).length; // Splits by spaces and removes empty items
}

// Update word count and button state dynamically
function updateWordCount(textareaId, displayId, errorId, maxWords) {
    const textarea = document.getElementById(textareaId);
    const wordCountDisplay = document.getElementById(displayId);
    const wordCountError = document.getElementById(errorId);
    const submitButton = document.getElementById("create-btn");

    function handleWordCount() {
        const wordCount = countWords(textarea.value);
        wordCountDisplay.textContent = `Words: ${wordCount}/${maxWords}`;

        if (wordCount > maxWords) {
            submitButton.disabled = true;
            wordCountError.style.display = "block";
        } else {
            submitButton.disabled = false;
            wordCountError.style.display = "none";
        }
    }

    // Attach the event listener for real-time updates
    textarea.addEventListener("input", handleWordCount); // Real-time update when typing
    handleWordCount(); // Run the function once to display initial count on page load
}

// Initialize word count for all relevant textareas
function initializeWordCounts() {
    // Real-time word count for "Paragraph" textarea
    updateWordCount(
        "data-paragraph",                // Textarea ID
        "word-count-display-Paragraph",  // Word count display ID
        "word-count-error-Paragraph",    // Error message ID
        250                              // Max word count
    );

    // Real-time word count for year-specific textareas
    const years = ["2004", "2014", "2016", "2018", "2021", "2024"];
    years.forEach((year) => {
        updateWordCount(
            `data-paragraph-${year}`,     // Textarea ID
            `word-count-display-${year}`, // Word count display ID
            `word-count-error-${year}`,   // Error message ID
            250                           // Max word count
        );
    });
}

// File upload logic
function setupImageUpload() {
    const imageInput = document.getElementById("data-image");
    const imagePreview = document.getElementById("image-preview");
    const previewImg = document.getElementById("preview-img");
    const cancelBtn = document.getElementById("cancel-btn");
    const fileSizeError = document.getElementById("file-size-error");

    imageInput.addEventListener("change", function (event) {
        const file = event.target.files[0];
        if (file) {
            const fileSize = file.size / 1024 / 1024; // File size in MB
            const maxSize = 2;

            if (fileSize > maxSize) {
                fileSizeError.textContent = "File size exceeds 2MB. Please upload a smaller image.";
                imageInput.value = "";
                imagePreview.style.display = "none";
                cancelBtn.style.display = "none";
                return;
            }

            fileSizeError.textContent = "";
            const reader = new FileReader();
            reader.onload = function (e) {
                previewImg.src = e.target.result;
                imagePreview.style.display = "block";
                cancelBtn.style.display = "inline-block";
            };
            reader.readAsDataURL(file);
        }
    });

    cancelBtn.addEventListener("click", function () {
        imageInput.value = "";
        imagePreview.style.display = "none";
        cancelBtn.style.display = "none";
    });
}

// On page load, initialize word count and image upload logic
window.onload = function () {
    initializeWordCounts(); // Initialize real-time word count for all textareas
    setupImageUpload();     // Setup image upload functionality
};
