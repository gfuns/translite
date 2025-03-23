document.getElementById("editSettings").addEventListener("click", function() {
    // Enable all input fields
    document.querySelectorAll("input[disabled]").forEach(input => {
        input.removeAttribute("disabled");
    });

    // Show the buttons div
    document.getElementById("buttons").style.display = "block";

    // Hide the pencil icon
    document.getElementById("editSettings").style.display = "none";
});

document.getElementById("cancelEdit").addEventListener("click", function() {
    // Enable all input fields

    document.querySelectorAll("input[type='radio']").forEach(input => {
        input.disabled = true; // Disable it
    });

    // Show the buttons div
    document.getElementById("buttons").style.display = "none";

    // Hide the pencil icon
    document.getElementById("editSettings").style.display = "block";
});
