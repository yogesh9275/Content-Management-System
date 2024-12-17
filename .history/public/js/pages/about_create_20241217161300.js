// Word count function
function countWords(text) {
    return text.split(/\s+/).filter(Boolean).length;
}

// Update word count and button state in real time
function updateWordCount(textareaId, displayId, errorId, maxWords) {
    const textarea = document.getElementById(textareaId);
    const wordCountDisplay = document.getElementById(displayId);
    const wordCountError = document.getElementById(errorId);
    const submitButton = document.getElementById('create-btn');

    function handleWordCount() {
        const wordCount = countWords(textarea.value);
        wordCountDisplay.textContent = `Words: ${wordCount}/${maxWords}`;

        if (wordCount > maxWords) {
            submitButton.disabled = true;
            wordCountError.style.display = 'block';
        } else {
            submitButton.disabled = false;
            wordCountError.style.display = 'none';
        }
    }

    // Initialize word count immediately when the page loads
    handleWordCount();

    // Add event listener for real-time updates
    textarea.addEventListener('input', handleWordCount);
}

// Function to initialize all word count listeners
// Initialize word count for all textareas
function initializeWordCountListeners() {
    updateWordCount('data-paragraph', 'word-count-display-Paragraph', 'word-count-error-Paragraph', 250);
    updateWordCount('data-paragraph-2004', 'word-count-display-2004', 'word-count-error-2004', 250);
    updateWordCount('data-paragraph-2014', 'word-count-display-2014', 'word-count-error-2014', 250);
    updateWordCount('data-paragraph-2016', 'word-count-display-2016', 'word-count-error-2016', 250);
    updateWordCount('data-paragraph-2018', 'word-count-display-2018', 'word-count-error-2018', 250);
    updateWordCount('data-paragraph-2021', 'word-count-display-2021', 'word-count-error-2021', 250);
    updateWordCount('data-paragraph-2024', 'word-count-display-2024', 'word-count-error-2024', 250);
}
// Image Upload Logic
function setupImageUpload() {
    const imageInput = document.getElementById('data-image');
    const imagePreview = document.getElementById('image-preview');
    const previewImg = document.getElementById('preview-img');
    const cancelBtn = document.getElementById('cancel-btn');
    const fileSizeError = document.getElementById('file-size-error');

    imageInput.addEventListener('change', function (event) {
        const file = event.target.files[0];
        if (file) {
            const fileSize = file.size / 1024 / 1024; // Size in MB
            const maxSize = 2;

            if (fileSize > maxSize) {
                fileSizeError.textContent = 'File size exceeds 2MB. Please upload a smaller image.';
                imageInput.value = '';
                imagePreview.style.display = 'none';
                cancelBtn.style.display = 'none';
                return;
            }

            fileSizeError.textContent = '';
            const reader = new FileReader();
            reader.onload = function (e) {
                previewImg.src = e.target.result;
                imagePreview.style.display = 'block';
                cancelBtn.style.display = 'inline-block';
            };
            reader.readAsDataURL(file);
        }
    });

    cancelBtn.addEventListener('click', function () {
        imageInput.value = '';
        imagePreview.style.display = 'none';
        cancelBtn.style.display = 'none';
    });
}

// On page load, initialize everything
window.onload = function () {
    initializeWordCounts(); // Real-time word count listeners
    setupImageUpload();     // Image upload logic
};
