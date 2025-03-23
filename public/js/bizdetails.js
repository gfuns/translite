

document.getElementById("editConfiguration").addEventListener("click", function() {
    // Enable all input fields (remove readonly and disabled attributes)
    document.querySelectorAll("input[readonly], textarea").forEach(input => {
        input.removeAttribute("readonly");
    });

    document.getElementById("businessIndustry").removeAttribute("disabled");

     // Show the buttons div
     document.getElementById("buttons").style.display = "block";


    // Hide the pencil icon
    document.getElementById("editConfiguration").style.display = "none";
});


document.getElementById("cancelEdit").addEventListener("click", function() {
    // Enable all input fields

    document.querySelectorAll("input, textarea").forEach(input => {
        input.setAttribute("readonly", "true");
    });

    document.querySelectorAll("select").forEach(select => {
        select.setAttribute("disabled", "true");
    });

    // Show the buttons div
    document.getElementById("buttons").style.display = "none";

    // Hide the pencil icon
    document.getElementById("editConfiguration").style.display = "block";
});


document.getElementById("changeLogoBtn").addEventListener("click", function() {
    document.getElementById("logoInput").click(); // Trigger file input
});

document.getElementById("logoInput").addEventListener("change", function() {
    var file = this.files[0];

     if (file) {

        // Preview the selected image
        var reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById("logoPreview").src = e.target.result;
        };
        reader.readAsDataURL(this.files[0]);

        // Submit the form automatically

         // Prepare form data
         var formData = new FormData();
         formData.append("logo", file);

         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

         // Send AJAX request
         $.ajax({
            url: "http://localhost:8000/business/settings/update-logo", // Update to match your actual route
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                Swal.fire({
                    toast: true,
                    position: "top-end",
                    icon: "success",
                    title: "Logo updated successfully!",
                    showConfirmButton: false,
                    timer: 3000
                });
            },
            error: function (xhr, status, error) {
                Swal.fire({
                    toast: true,
                    position: "top-end",
                    icon: "error",
                    title: "Error uploading logo!",
                    showConfirmButton: false,
                    timer: 3000
                });
            }
        });
        // document.getElementById("logoUploadForm").submit();
    }
});
