document.addEventListener('DOMContentLoaded', () => {
    const savings = JSON.parse(localStorage.getItem('savings')) || {};
    const goalInput = document.getElementById('goal-input');
    const setGoalButton = document.getElementById('set-goal-button');
    const goalChartCanvas = document.getElementById('goal-chart');
    const goalMessage = document.getElementById('goal-message');
    const backButton = document.getElementById('back-button');

    let savingsGoal = parseFloat(localStorage.getItem('savingsGoal')) || 0;
    let totalSaved = calculateTotalSavings(savings);

    // Initialize Chart.js Bar Chart
    const goalChart = new Chart(goalChartCanvas, {
        type: 'bar',
        data: {
            labels: ['Saved', 'Remaining'], // Labels for the two bars
            datasets: [{
                label: 'Savings Progress',
                data: [totalSaved, Math.max(0, savingsGoal - totalSaved)], // Saved and Remaining amounts
                backgroundColor: ['#4caf50', '#ff5722'], // Green for saved, red for remaining
                borderColor: ['#388e3c', '#d32f2f'],
                borderWidth: 1,
            }],
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false, // No need for a legend since we have clear labels
                },
                tooltip: {
                    callbacks: {
                        label: function (context) {
                            return `${context.dataset.label}: Rs. ${context.raw}`;
                        },
                    },
                },
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Amount (Rs.)',
                    },
                },
                x: {
                    title: {
                        display: true,
                        text: 'Progress',
                    },
                },
            },
        },
    });

    // Function to calculate total savings
    function calculateTotalSavings(savings) {
        return Object.values(savings).reduce((total, amount) => total + parseFloat(amount), 0);
    }

    // Function to update the chart and progress message
    function updateGoalProgress() {
        totalSaved = calculateTotalSavings(savings);
        const amountRemaining = Math.max(0, savingsGoal - totalSaved);
        const progressPercentage = ((totalSaved / savingsGoal) * 100).toFixed(2);

        // Update chart data
        goalChart.data.datasets[0].data = [totalSaved, amountRemaining];
        goalChart.update();

        // Update message
        goalMessage.textContent = `
            Total Saved: Rs. ${totalSaved}
            | Goal: Rs. ${savingsGoal}
            | Remaining: Rs. ${amountRemaining}
            (${progressPercentage > 100 ? 100 : progressPercentage}% Achieved)
        `;
    }

    // Set Goal Button Event Listener
    setGoalButton.addEventListener('click', () => {
        const goalAmount = parseFloat(goalInput.value);

        if (!goalAmount || goalAmount <= 0) {
            alert('Please enter a valid savings goal.');
            return;
        }

        savingsGoal = goalAmount;
        localStorage.setItem('savingsGoal', savingsGoal);
        updateGoalProgress();
        alert('Savings goal has been set!');
    });

    // Back Button Event Listener
    backButton.addEventListener('click', () => {
        window.location.href = 'index.php';
    });

    // Display existing goal and progress
    if (savingsGoal > 0) {
        updateGoalProgress();
    }
});
