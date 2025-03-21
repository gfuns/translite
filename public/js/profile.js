
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


document.getElementById("editProfile").addEventListener("click", function() {
    // Enable all input fields
    document.querySelectorAll("input[readonly]").forEach(input => {
        input.removeAttribute("readonly");
    });

    // Show the buttons div
    document.getElementById("buttons").style.display = "block";

    // Hide the pencil icon
    document.getElementById("editProfile").style.display = "none";
});
