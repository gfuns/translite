$(document).ready(function() {
    $('#pm').select2({
        width: '100%' // Ensure it takes full width
    });
});

$(document).ready(function() {
    $('#status').select2({
        width: '100%' // Ensure it takes full width
    });
});


$(document).ready(function() {
    $('#dateRange').daterangepicker({
        locale: {
            format: 'YYYY-MM-DD' // Change the format as needed
        },
        autoUpdateInput: false,
        opens: 'right'
    });

    // Update input value when selecting dates
    $('#dateRange').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format(
            'YYYY-MM-DD'));
    });

    // Clear input when canceling
    $('#dateRange').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });
});


function closeOffcanvas() {
    let offcanvas = document.getElementById("filterOffcanvas");
    offcanvas.classList.remove("show");

    // Wait for animation to complete before removing backdrop
    setTimeout(() => {
        document.body.classList.remove("offcanvas-backdrop");
    }, 300); // Adjust timing to match CSS transition
}



document.getElementById("dropdownToggle").addEventListener("click", function(event) {
    event.preventDefault();
    let dropdown = document.getElementById("customDropdown");
    dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
});

// Close dropdown when clicking outside
document.addEventListener("click", function(event) {
    let dropdown = document.getElementById("customDropdown");
    let toggle = document.getElementById("dropdownToggle");

    if (!toggle.contains(event.target) && !dropdown.contains(event.target)) {
        dropdown.style.display = "none";
    }
});


document.getElementById("clearFilters").addEventListener("click", function() {
    document.getElementById("dateRange").value = "";
    document.getElementById("transId").value = "";
    document.getElementById("status").value = "";
});
