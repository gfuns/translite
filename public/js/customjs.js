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
    $('#veridoc').select2({
        width: '100%' // Ensure it takes full width
    });
});

$(document).ready(function() {
    $('#designation').select2({
        width: '100%' // Ensure it takes full width
    });
});

$(document).ready(function() {
    $('#frequency').select2({
        width: '100%', // Ensure it takes full width
    });
});

$(document).ready(function() {
    $('#currency').select2({
        width: '100%', // Ensure it takes full width
    });
});

$(document).ready(function() {
    $('#bank').select2({
        width: '100%', // Ensure it takes full width
        templateResult: formatBank,
        templateSelection: formatBank
    });

    function formatBank(bank) {
        if (!bank.id) {
            return bank.text;
        }

        var imageUrl = $(bank.element).data('image');
        if (!imageUrl) {
            return bank.text;
        }

        var $bank = $(
            '<span><img src="' + imageUrl + '" style="width: 20px; height: 20px; margin-right: 10px;"/> ' + bank.text + '</span>'
        );
        return $bank;
    }
});


$(document).ready(function() {
    function formatBankOption(bank) {
        if (!bank.id) {
            return bank.text; // Default text for placeholder
        }

        var image = $(bank.element).data('image'); // Get image from option
        var subtext = $(bank.element).data('subtext'); // Get subtext from option

        var $bankOption = $(
            `<div style="display: flex; align-items: center;">
                <img src="${image}" style="width: 30px; height: 30px; margin-right: 10px;">
                <div>
                    <div>${bank.text}</div>
                    <div style="font-size: 12px;">${subtext}</div>
                </div>
            </div>`
        );

        return $bankOption;
    }

    $("#bankSelect").select2({
        width: '100%', // Ensure it takes full width
        templateResult: formatBankOption, // For dropdown options
        templateSelection: formatBankOption, // For selected option
        dropdownAutoWidth: true,
        // minimumResultsForSearch: -1 // Removes search bar
    });
});

$(document).ready(function() {
    $('#selcurrency').select2({
        width: '100%', // Ensure it takes full width
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

function displayFileName(input) {
    if (input.files.length > 0) {
        input.nextElementSibling.textContent = input.files[0].name;
    }
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
