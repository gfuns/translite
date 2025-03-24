function updateFileName(elementId, input) {
    const fileName = input.files.length > 0 ? input.files[0].name : "";
    document.getElementById(elementId).textContent = fileName;
}

function setDocumentType(elementId, fileName) {
    document.getElementById(elementId).textContent = fileName || "Select Document";
}



document.addEventListener("DOMContentLoaded", function() {
    const tabs = document.querySelectorAll(".tab-link");
    const panels = document.querySelectorAll(".tab-panel");

    tabs.forEach(tab => {
        tab.addEventListener("click", function(e) {
            e.preventDefault();
            tabs.forEach(t => t.classList.remove("active"));
            panels.forEach(p => p.classList.remove("active"));

            this.classList.add("active");
            document.getElementById(this.dataset.tab).classList.add("active");
        });
    });
});
