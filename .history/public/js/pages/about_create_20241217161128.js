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
function initializeWordCounts() {
    // Initialize for Paragraph
    const paragraphTextarea = document.getElementById('data-paragraph');
    if (paragraphTextarea) {
        updateWordCount(
            'data-paragraph',                // Textarea ID
            'word-count-display-Paragraph',  // Word count display ID
            'word-count-error-Paragraph',    // Error message ID
            250                              // Max word count
        );
    }

    // Initialize for year-specific textareas
    const years = ['2004', '2014', '2016', '2018', '2021', '2024'];
    years.forEach((year) => {
        const textareaId = `data-paragraph-${year}`;
        const textarea = document.getElementById(textareaId);

        if (textarea) {
            updateWordCount(
                textareaId,                     // Textarea ID
                `word-count-display-${year}`,   // Word count display ID
                `word-count-error-${year}`,     // Error message ID
                250                             // Max word count
            );
        }
    });
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
