// Function to handle image upload and preview
function handleImageUpload(fileInputId, cancelBtnID, previewImgId, errorId) {
    var fileInput = document.getElementById(fileInputId);
    var cancelBtn = document.getElementById(cancelBtnID);
    var previewImg = document.getElementById(previewImgId);
    var fileSizeError = document.getElementById(errorId);

    // When a file is selected, show preview
    fileInput.addEventListener('change', function(event) {
        var file = event.target.files[0];
        var reader = new FileReader();

        reader.onload = function(e) {
            if (file && file.size <= 2 * 1024 * 1024) { // Check if file size is within 2MB
                previewImg.src = e.target.result; // Set image source to the selected file
                cancelBtn.style.display = 'inline-block'; // Show cancel button
                document.getElementById('image-preview').style.display =
                    'block'; // Show image preview container
                fileSizeError.textContent = ''; // Clear any file size error
            }
        };

        if (file) {
            const fileSize = file.size / 1024 / 1024; // Convert bytes to MB
            const maxSize = 2; // Max 2MB
            if (fileSize > maxSize) {
                fileSizeError.textContent =
                    "File size exceeds 2MB. Please upload a smaller image."; // Display error
                fileInput.value = ''; // Clear input
                previewImg.src = ''; // Clear image source
                cancelBtn.style.display = 'none'; // Hide cancel button
                document.getElementById('image-preview').style.display = 'none'; // Hide preview container
                return;
            }
            fileSizeError.textContent = ''; // Clear file size error
            reader.readAsDataURL(file); // Preview image
        }
    });

    // Logic for cancel button to clear file input and hide preview
    cancelBtn.addEventListener('click', function() {
        fileInput.value = ''; // Clear file input
        previewImg.src = ''; // Clear image source
        cancelBtn.style.display = 'none'; // Hide cancel button
        document.getElementById('image-preview').style.display = 'none'; // Hide image preview container
    });
}

// Initialize event listeners for image uploads
document.addEventListener('DOMContentLoaded', function() {
    // Handle About Image
    handleImageUpload('data-image', 'cancel-btn', 'preview-img', 'file-size-error');

    // Toggle visibility and set up other element-specific logic
    toggleDivs();

    // Word count for Paragraphs and Year-specific inputs
    updateWordCount('data-paragraph-Paragraph', 'word-count-display-Paragraph', 'word-count-error-Paragraph', 250);
    updateWordCount('data-paragraph-2004', 'word-count-display-2004', 'word-count-error-2004', 250);
    updateWordCount('data-paragraph-2014', 'word-count-display-2014', 'word-count-error-2014', 250);
    updateWordCount('data-paragraph-2016', 'word-count-display-2016', 'word-count-error-2016', 250);
    updateWordCount('data-paragraph-2018', 'word-count-display-2018', 'word-count-error-2018', 250);
    updateWordCount('data-paragraph-2021', 'word-count-display-2021', 'word-count-error-2021', 250);
    updateWordCount('data-paragraph-2024', 'word-count-display-2024', 'word-count-error-2024', 250);

    // Handle Long Text
    setupLongTextEditor();

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
    const selectedElement = document.getElementById('element').value;
    const elementDivs = document.querySelectorAll('.element-div');
    elementDivs.forEach(function(div) {
        div.style.display = div.id === selectedElement ? 'block' : 'none';
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

// Setup Long Text editor (this could be a rich text editor, if needed)
function setupLongTextEditor() {
    var editorElement = document.getElementById('edit');
    if (editorElement) {
        // Initialize rich text editor here if needed
    }
}
