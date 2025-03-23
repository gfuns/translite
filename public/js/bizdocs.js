document.getElementById("editSettings").addEventListener("click", function() {
    // Enable all input fields
    document.querySelectorAll("input[disabled]").forEach(input => {
        input.removeAttribute("disabled");
    });

    document.querySelectorAll('.uploaded-file.disabled').forEach(el => el.classList.remove('disabled'));

    // Show the buttons div
    document.getElementById("buttons").style.display = "block";

    // Hide the pencil icon
    document.getElementById("editSettings").style.display = "none";
});

document.getElementById("cancelEdit").addEventListener("click", function() {
    // Enable all input fields

    document.querySelectorAll("input").forEach(input => {
        input.disabled = true; // Disable it
    });

    document.querySelectorAll('.uploaded-file').forEach(el => el.classList.add('disabled'));

    // Show the buttons div
    document.getElementById("buttons").style.display = "none";

    // Hide the pencil icon
    document.getElementById("editSettings").style.display = "block";
});


  // Function to handle file upload when the box is clicked
  function setupUploadBox(uploadBoxId, inputId, previewId, filenameId, sizeId) {
    const uploadBox = document.getElementById(uploadBoxId);
    const fileInput = document.getElementById(inputId);
    const previewBox = document.getElementById(previewId);
    const filenameSpan = document.getElementById(filenameId);
    const sizeSpan = document.getElementById(sizeId);

    // Click event to trigger file input
    uploadBox.addEventListener("click", function() {
        fileInput.click();
    });

    // File input change event
    fileInput.addEventListener("change", function(event) {
        const file = event.target.files[0];
        if (file) {
            previewBox.classList.remove("d-none");
            uploadBox.classList.add("d-none");
            filenameSpan.textContent = file.name;
            sizeSpan.textContent = `(${(file.size / 1024 / 1024).toFixed(2)} MB)`;
        }
    });
}

// Apply the function to all file upload sections
setupUploadBox("proofOfAddressUpload", "proofOfAddressInput", "proofOfAddressPreview", "proofOfAddressFilename",
    "proofOfAddressSize");
setupUploadBox("statementOfAccountUpload", "statementOfAccountInput", "statementOfAccountPreview",
    "statementOfAccountFilename", "statementOfAccountSize");
setupUploadBox("otherDocumentsUpload", "otherDocumentsInput", "otherDocumentsPreview", "otherDocumentsFilename",
    "otherDocumentsSize");
