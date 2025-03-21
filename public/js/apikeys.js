document.addEventListener("DOMContentLoaded", function() {
    const secretKeyElement = document.getElementById("secretKey");
    const toggleIcon = document.getElementById("toggleSecretKey");

    // Store the original secret key
    const actualSecretKey = secretKeyElement.textContent;
    secretKeyElement.textContent = "*".repeat(actualSecretKey.length); // Mask it

    window.toggleSecret = function() {
        if (secretKeyElement.textContent.startsWith("*")) {
            secretKeyElement.textContent = actualSecretKey; // Reveal key
            toggleIcon.classList.remove("fa-eye");
            toggleIcon.classList.add("fa-eye-slash");
        } else {
            secretKeyElement.textContent = "*".repeat(actualSecretKey.length); // Mask key
            toggleIcon.classList.remove("fa-eye-slash");
            toggleIcon.classList.add("fa-eye");
        }
    };

    window.copyToClipboard = function(elementId) {
        const element = document.getElementById(elementId);
        const text = element.getAttribute("data-key") || element.textContent; // Use actual key if available
        const tempInput = document.createElement("textarea");
        tempInput.value = text;
        document.body.appendChild(tempInput);
        tempInput.select();
        document.execCommand("copy");
        document.body.removeChild(tempInput);

        Swal.fire({
            toast: true,
            position: "top-end",
            icon: "success",
            title: "Copied to clipboard!",
            showConfirmButton: false,
            timer: 2000
        });

        // alert("Copied to clipboard!");
    };
});
