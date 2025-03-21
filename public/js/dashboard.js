
function updateChart(canvasId, percentage, color) {
    let ctx = document.getElementById(canvasId).getContext('2d');
    // Data for the chart
    let data = {
        datasets: [{
            data: [percentage, 100 - percentage], // Completed vs Remaining
            backgroundColor: [color, '#E0E0E0'], // Dynamic color & gray for remaining
            borderWidth: 0
        }]
    };

    // Chart configuration
    let config = {
        type: 'doughnut',
        data: data,
        options: {
            cutout: '70%', // Controls thickness of the chart
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }, // Hide legend
                tooltip: {
                    enabled: false
                }, // Hide tooltip


            },
            animation: {
                onComplete: function() {
                    let chartInstance = myDoughnutChart;
                    let ctx = chartInstance.ctx;
                    let width = chartInstance.width;
                    let height = chartInstance.height;
                    let text = "75%";

                    ctx.font = "bold 24px Arial";
                    ctx.fillStyle = "#000";
                    ctx.textAlign = "center";
                    ctx.textBaseline = "middle";

                    let centerX = width / 2;
                    let centerY = height / 2;

                    ctx.fillText(text, centerX, centerY);
                }
            }
        }
    };

    // Create the chart instance
    window.doughnutChartInstance = new Chart(ctx, config);
}

// Example Usage
updateChart("card", 100, "#097CFF");
updateChart("transfer", 50, "#097CFF");
updateChart("ussd", 0, "#097CFF");
