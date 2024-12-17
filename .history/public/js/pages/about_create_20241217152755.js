function toggleDivs() {
    const selectedElement = document.getElementById('element').value;
    console.log(selectedElement);
    const elementDivs = document.querySelectorAll('.element-div');
    const specialYears = ["2004", "2014", "2016"]; // Array of years that should show the paragraph element
    const paragraphDiv = document.getElementById("Paragraph"); // Get the paragraph element by id

    // Loop through each element div and hide or show based on the selected element
    elementDivs.forEach(function(div) {
        div.style.display = div.id === selectedElement ? 'block' : 'none';
    });

    // Check if the selected element is in the special years array and show the paragraph element
    if (specialYears.includes(selectedElement)) {
        if (paragraphDiv) {
            paragraphDiv.style.display = 'block'; // Show the paragraph if the selected element matches
        }
    } else {
        // Hide the paragraph div if the selected element doesn't match
        if (paragraphDiv) {
            paragraphDiv.style.display = 'none';
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
