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
