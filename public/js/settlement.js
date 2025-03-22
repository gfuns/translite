
function togglePasswordVisibility() {
    var passwordInput = document.getElementById("password");
    var icon = document.querySelector(".toggle-password i");

    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
    } else {
        passwordInput.type = "password";
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
    }
}

function togglePassword2Visibility() {
    var passwordInput = document.getElementById("password2");
    var icon = document.querySelector(".toggle-password-2 i");

    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
    } else {
        passwordInput.type = "password";
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
    }
}

function togglePassword3Visibility() {
    var passwordInput = document.getElementById("password3");
    var icon = document.querySelector(".toggle-password-3 i");

    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
    } else {
        passwordInput.type = "password";
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
    }
}


document.getElementById("editConfiguration").addEventListener("click", function() {
    // Enable all input fields (remove readonly and disabled attributes)
    document.querySelectorAll("input[readonly], input[disabled], select[disabled]").forEach(input => {
        input.removeAttribute("readonly");
        input.removeAttribute("disabled");
    });

     // Show the buttons div
     document.getElementById("addconfig").style.display = "block";
     document.getElementById("buttons").style.display = "block";
     document.getElementById("defat").style.display = "none";
     document.querySelectorAll(".defatchk").forEach(element => {
        element.style.display = "block";
    });


    // Hide the pencil icon
    document.getElementById("editConfiguration").style.display = "none";
});


document.addEventListener("DOMContentLoaded", function() {
    const checkbox = document.querySelector(".freq-checkbox");
    const fixedSetDate = document.getElementById("fixedSetDate");

    checkbox.addEventListener("change", function() {
        fixedSetDate.style.display = this.checked ? "block" : "none";
    });
});


$(document).ready(function() {

    // Handle checkbox behavior (only one checked at a time)
    $(document).on("change", ".def-checkbox", function() {
        $(".def-checkbox").not(this).prop("checked", false);
    });
});

$("#bankSelect").on("select2:select", function() {
    setTimeout(function() {
        $(".select2-selection__rendered").css({
            "height": "auto",
            "display": "flex",
            "align-items": "center",
            // "padding": "5px 10px", /* Adjust top/bottom padding */
            "line-height": "1.5" /* Reduce line-height */
        });
    }, 10);
});
