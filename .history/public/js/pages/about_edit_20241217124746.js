    // Save the original image path on page load (use the existing data from your server)
    var originalImageSrc =
        '{{ $element->element == "Image" && $element->data ? asset($element->data) : asset("images/default-image.png") }}';
    
var image = document.getElementById('preview-img');
var cancelBtn = document.getElementById('cancel-btn');
var fileInput = document.getElementById('data-image');
var fileSizeError = document.getElementById("file-size-error");

// Event listener to change the image preview when a new file is selected
fileInput.addEventListener('change', function(event) {
    var file = event.target.files[0];
    var reader = new FileReader();

    reader.onload = function(e) {
        image.src = e.target.result; // Update the image source to the new uploaded file
        cancelBtn.style.display = 'inline-block'; // Show the cancel button
    };

    if (file) {
        const fileSize = file.size / 1024 / 1024; // Convert bytes to MB
        const maxSize = 2; // 2MB max file size

        if (fileSize > maxSize) {
            fileSizeError.textContent = "File size exceeds 2MB. Please upload a smaller image.";
            fileInput.value = ''; // Clear input
            image.src = originalImageSrc; // Restore the original image if size exceeds
            cancelBtn.style.display = 'none'; // Hide cancel button
            return;
        }

        fileSizeError.textContent = ''; // Clear file size error message
        reader.readAsDataURL(file); // Read and load the selected file
    }
});

// Event listener for the cancel button to clear the input and restore the original image
cancelBtn.addEventListener('click', function() {
    fileInput.value = ''; // Clear the file input
    image.src = originalImageSrc; // Restore the original image
    cancelBtn.style.display = 'none'; // Hide the cancel button
});
