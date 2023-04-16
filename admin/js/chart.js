// Chart.js Configuration
var ctx = document.getElementById('myChart').getContext('2d');
var chart = new Chart(ctx, {
    type: 'bar', // Change the chart type (e.g., bar, line, pie, etc.)
    data: {
        labels: ['Label 1', 'Label 2', 'Label 3', 'Label 4', 'Label 5'], // Labels for x-axis
        datasets: [{
            label: 'Data Set 1', // Label for the dataset
            data: [5, 10, 15, 20, 25], // Data values for y-axis
            backgroundColor: 'rgba(75, 192, 192, 0.8)', // Background color of bars
            borderColor: 'rgba(75, 192, 192, 1)', // Border color of bars
            borderWidth: 1 // Border width of bars
        }]
    },
    options: {
        responsive: true, // Make the chart responsive
        scales: {
            y: {
                beginAtZero: true // Start y-axis from 0
            }
        },
        plugins: {
            legend: {
                display: false // Hide legend
            },
            title: {
                display: true, // Show chart title
                text: 'Chart Title' // Chart title text
            }
        }
    }
});
