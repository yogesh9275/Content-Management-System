// Save the original image path on page load (use the existing data from your server)
var originalImageSrc = document.getElementById("preview-img").src;
var image = document.getElementById("preview-img");
var cancelBtn = document.getElementById("cancel-btn");
var fileInput = document.getElementById("data-image");
var fileSizeError = document.getElementById("file-size-error");

// Event listener to change the image preview when a new file is selected
fileInput.addEventListener("change", function (event) {
    var file = event.target.files[0];
    var reader = new FileReader();

    reader.onload = function (e) {
        image.src = e.target.result; // Update the image source to the new uploaded file
        cancelBtn.style.display = "inline-block"; // Show the cancel button
    };

    if (file) {
        const fileSize = file.size / 1024 / 1024; // Convert bytes to MB
        const maxSize = 2; // 2MB max file size

        if (fileSize > maxSize) {
            fileSizeError.textContent =
                "File size exceeds 2MB. Please upload a smaller image.";
            fileInput.value = ""; // Clear input
            image.src = originalImageSrc; // Restore the original image if size exceeds
            cancelBtn.style.display = "none"; // Hide cancel button
            return;
        }

        fileSizeError.textContent = ""; // Clear file size error message
        reader.readAsDataURL(file); // Read and load the selected file
    }
});

// Event listener for the cancel button to clear the input and restore the original image
cancelBtn.addEventListener("click", function () {
    fileInput.value = ""; // Clear the file input
    image.src = originalImageSrc; // Restore the original image
    cancelBtn.style.display = "none"; // Hide the cancel button
});


  // Function to show the corresponding div based on selected element type
  function toggleDivs() {
    const selectedElement = document.getElementById("element").value;
    const elementDivs = document.querySelectorAll(".element-div");

    console.log
    // Hide all divs initially
    elementDivs.forEach(function (div) {
        div.style.display = "none";
    });

    // Check if the selected element is one of the special years
    const specialYears = ['2004', '2014', '2016', '2018', '2021', '2024'];
    if (specialYears.includes(selectedElement)) {
        // Show the Paragraph div if any of the special years is selected
        document.getElementById("Paragraph").style.display = "block";
    } else {
        // Otherwise show the corresponding div based on selected element
        const selectedDiv = document.getElementById(selectedElement);
        if (selectedDiv) {
            selectedDiv.style.display = "block";
        }
    }

    // Optionally handle Image and file input preview logic...
}

// Call toggleDivs() on page load to initialize the selected element's div
window.onload = function () {
    toggleDivs(); // Toggle div visibility based on the current selection
};
