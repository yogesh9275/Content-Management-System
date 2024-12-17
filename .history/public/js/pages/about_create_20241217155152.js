// Word count function
function countWords(text) {
    return text.split(/\s+/).filter(Boolean).length;
}

// Update word count and button state
function updateWordCount(textareaId, displayId, errorId, maxWords) {
    const textarea = document.getElementById(textareaId);
    const wordCountDisplay = document.getElementById(displayId);
    const wordCountError = document.getElementById(errorId);
    const submitButton = document.getElementById('create-btn');

    // Function to update the word count
    function handleWordCount() {
        var wordCount = countWords(textarea.value);
        wordCountDisplay.textContent = `Words: ${wordCount}/${maxWords}`;

        // Disable submit button if word count exceeds max
        if (wordCount > maxWords) {
            submitButton.disabled = true;
            wordCountError.style.display = 'block';
        } else {
            submitButton.disabled = false;
            wordCountError.style.display = 'none';
        }
    }

    // Initialize word count display when page loads
    handleWordCount();

    // Listen for input events to update the word count and button status dynamically
    textarea.addEventListener('input', handleWordCount);
}

// Function to toggle visibility of elements based on selected option
function toggleDivs() {
    var selectedElement = document.getElementById("element").value;
    var allDivs = document.querySelectorAll(".element-div");
    allDivs.forEach(function(div) {
        div.style.display = "none";
    });

    if (selectedElement) {
        var selectedDiv = document.getElementById(selectedElement);
        if (selectedDiv) {
            selectedDiv.style.display = "block";

            // If it's the paragraph div, enable word count functionality
            if (selectedElement === "Paragraph" || selectedElement === "2004" || selectedElement === "2016" || selectedElement === "2012") {
                // For each 'data-paragraph' textarea, initialize word count
                const paragraphTextareas = document.querySelectorAll('#' + selectedElement + ' #data-paragraph');
                paragraphTextareas.forEach(function(textarea) {
                    updateWordCount(textarea.id, 'word-count-display', 'word-count-error', 250);
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

imageInput.addEventListener("change", function(event) {
    const file = event.target.files[0];
    if (file) {
        const fileSize = file.size / 1024 / 1024;
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
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            imagePreview.style.display = "block";
            cancelBtn.style.display = "inline-block";
        };
        reader.readAsDataURL(file);
    }
});

cancelBtn.addEventListener("click", function() {
    imageInput.value = "";
    imagePreview.style.display = "none";
    cancelBtn.style.display = "none";
});

window.onload = toggleDivs;
