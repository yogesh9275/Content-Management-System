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

    // Function to update the word count and button state
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

    // Initialize word count display and listen for input events to update dynamically
    handleWordCount();
    textarea.addEventListener("input", handleWordCount); // Real-time updates on input
}

// Function to toggle visibility of elements based on selected option
// Function to toggle visibility of elements and set up word count
function toggleDivs() {
    const selectedElement = document.getElementById("element").value;
    const allDivs = document.querySelectorAll(".element-div");

    // Hide all divs
    allDivs.forEach((div) => (div.style.display = "none"));

    // Show selected div
    if (selectedElement) {
        const selectedDiv = document.getElementById(selectedElement);
        if (selectedDiv) {
            selectedDiv.style.display = "block";

            // Initialize word count based on selected div
            switch (selectedElement) {
                case "Paragraph":
                    updateWordCount(
                        "data-paragraph",                // Textarea ID
                        "word-count-display-Paragraph",  // Word count display ID
                        "word-count-error-Paragraph",    // Error message ID
                        250                              // Max word count
                    );
                    break;
                case "2004":
                case "2014":
                case "2016":
                case "2018":
                case "2021":
                case "2024":
                    updateWordCount(
                        `data-paragraph-${selectedElement}`,     // Textarea ID
                        `word-count-display-${selectedElement}`, // Word count display ID
                        `word-count-error-${selectedElement}`,   // Error message ID
                        250                                      // Max word count
                    );
                    break;
            }
        }
    }
}

const imageInput = document.getElementById("data-image");
const imagePreview = document.getElementById("image-preview");
const previewImg = document.getElementById("preview-img");
const cancelBtn = document.getElementById("cancel-btn");
const fileSizeError = document.getElementById("file-size-error");

imageInput.addEventListener("change", function (event) {
    const file = event.target.files[0];
    if (file) {
        const fileSize = file.size / 1024 / 1024;
        const maxSize = 2;

        if (fileSize > maxSize) {
            fileSizeError.textContent =
                "File size exceeds 2MB. Please upload a smaller image.";
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

window.onload = toggleDivs;  // Ensure div visibility toggling works on page load
