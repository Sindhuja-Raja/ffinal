<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Calendar with Savings</title>
    <script src="https://kit.fontawesome.com/37df75b44e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="styles.css">
   
    <style>
        #login-button {
            margin-left: 10px;
            padding: 10px 20px;
            text-align: center;
            background-color: #28a745; 
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        #login-button:hover {
            background-color: #218838;
        }
    </style>
</head>

<body>
    <h1 id="view">Due to large table columns and calendar This website only supports Desktop View</h1>
    <div class="calendar-container">
        <div class="calendar-header">
            <div class="month-navigation">
                <button id="prev-month">&lt;</button>
                <span id="current-month">January 2025</span>
                <button id="next-month">&gt;</button>
            </div>
            <div class="view-selector">
                <button id="analyze-button" title="Analyze My Savings"><i class="fa-solid fa-chart-bar"></i></button>
                <button id="date-picker-button" title="Pick any date"><i class="fa-regular fa-calendar"></i></button>
                <input type="date" id="date-picker" style="display: none;">
                <select id="view-select">
                    <option value="day">Day</option>
                    <option value="week">Week</option>
                    <option value="month" selected>Month</option>
                    <option value="year">Year</option>
                </select>
                <a href="log.php" id="login-button">Login</a>
                <a href="goal.html" id="login-button">Goal</a>
            </div>
        </div>
        <div class="calendar-body">
            <div class="days-header">
                <div>Sun</div>
                <div>Mon</div>
                <div>Tue</div>
                <div>Wed</div>
                <div>Thu</div>
                <div>Fri</div>
                <div>Sat</div>
            </div>
            <div class="days-grid" id="calendar-grid">
            </div>
        </div>
    </div>

    <div id="saving-modal" class="modal">
        <div class="modal-content">
            <span class="close-btn" id="close-modal">&times;</span>
            <h2>Enter Savings</h2>
            <form method="POST" id="saving-form" action="">
                <label for="saving-date">Date:</label>
                <input type="text" id="saving-date" name="date" readonly><br>
                <label for="saving-amount">Saving Amount (Rs):</label>
                <input type="number" id="saving-amount" name="amount" required><br>
                <div class="btnGrp">
                    <button type="submit">Save</button> 
                    <button type="button" id="delete-amount" style="display:none; background-color: red;" title="Delete Amount"><i class="fa-solid fa-trash"></i></button>
                    <button type="button" id="voice-input-btn" title="Use Voice Input"><i class="fa-solid fa-microphone"></i></button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
        const recognition = SpeechRecognition ? new SpeechRecognition() : null;

        const isFirefox = typeof InstallTrigger !== 'undefined';

        if (!recognition || isFirefox) {
            document.getElementById('voice-input-btn').addEventListener('click', () => {
                alert("Voice recognition is not supported in your browser. Please use Google Chrome for this feature.");
            });
        } else {
            const voiceInputBtn = document.getElementById('voice-input-btn');
            const savingAmountInput = document.getElementById('saving-amount');

            recognition.lang = 'en-US';
            recognition.interimResults = false;

            voiceInputBtn.addEventListener('click', () => {
                savingAmountInput.value = "Listening...";
                recognition.start();
            });

            recognition.onresult = (event) => {
                const spokenText = event.results[0][0].transcript;
                const recognizedNumber = parseFloat(spokenText.replace(/[^0-9.]/g, ''));

                if (!isNaN(recognizedNumber)) {
                    savingAmountInput.value = recognizedNumber;
                } else {
                    savingAmountInput.value = "";
                    alert('No valid number detected. Please try again.');
                }
            };

            recognition.onerror = (event) => {
                console.error('Speech recognition error:', event.error);
                savingAmountInput.value = "";
                alert('Error during speech recognition. Please try again.');
            };

            recognition.onend = () => {
                if (savingAmountInput.value === "Listening...") {
                    savingAmountInput.value = "";
                }
            };
        }
    </script>

    <script src="script.js"></script>
</body>

</html>