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
function toggleDivs() {
    var selectedElement = document.getElementById("element").value;
    var allDivs = document.querySelectorAll(".element-div");
    allDivs.forEach(function (div) {
        div.style.display = "none";
    });

    if (selectedElement) {
        var selectedDiv = document.getElementById(selectedElement);
        if (selectedDiv) {
            selectedDiv.style.display = "block";

            // If it's the paragraph div, enable word count functionality
            if (
                selectedElement === "Paragraph" ||
                selectedElement === "2004" ||
                selectedElement === "2014" ||
                selectedElement === "2016" ||
                selectedElement === "2018" ||
                selectedElement === "2021" ||
                selectedElement === "2024"
            ) {
                // For each 'data-paragraph' textarea, initialize word count
                const paragraphTextareas = document.querySelectorAll(
                    "#" + selectedElement + " #data-paragraph"
                );
                paragraphTextareas.forEach(function (textarea) {
                    updateWordCount(
                        textarea.id,
                        "word-count-display",  // ID of the word count display element
                        "word-count-error",     // ID of the error message element
                        250                      // Max word count
                    );
                });
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