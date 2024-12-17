// Word count function
function countWords(text) {
    return text.split(/\s+/).filter(Boolean).length; // Split text into words, ignore empty spaces
}

// Update word count and button state
function updateWordCount(textareaId, displayId, errorId, maxWords) {
    const textarea = document.getElementById(textareaId);
    const wordCountDisplay = document.getElementById(displayId);
    const wordCountError = document.getElementById(errorId);
    const submitButton = document.getElementById("create-btn");

    // Function to handle word count dynamically
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

    // Initialize and listen for changes
    handleWordCount(); // Run on page load
    textarea.addEventListener("input", handleWordCount); // Update on input
}

// Function to initialize word count for all textareas
function initializeWordCounts() {
    // Word count setup for Paragraph
    updateWordCount(
        "data-paragraph",                // Textarea ID
        "word-count-display-Paragraph",  // Word count display ID
        "word-count-error-Paragraph",    // Error ID
        250                              // Max word count
    );

    // Word count setup for year-specific fields
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

    // Cancel button functionality
    cancelBtn.addEventListener("click", function () {
        imageInput.value = "";
        imagePreview.style.display = "none";
        cancelBtn.style.display = "none";
    });
}

// Function to toggle visibility of elements
function toggleDivs() {
    const selectedElement = document.getElementById("element").value;
    const allDivs = document.querySelectorAll(".element-div");

    // Hide all divs
    allDivs.forEach((div) => (div.style.display = "none"));

    // Show the selected element
    if (selectedElement) {
        const selectedDiv = document.getElementById(selectedElement);
        if (selectedDiv) selectedDiv.style.display = "block";
    }
}

// On page load, initialize word count and file upload
window.onload = function () {
    initializeWordCounts(); // Initialize word count for all textareas
    setupImageUpload();     // Setup file upload functionality
    toggleDivs();           // Ensure visibility is toggled correctly
};
