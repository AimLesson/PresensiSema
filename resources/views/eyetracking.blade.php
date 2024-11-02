<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Automated Eye-Detection with Quote Generation</title>
    <style>
        body { display: flex; justify-content: center; align-items: center; height: 100vh; font-family: Arial, sans-serif; }
        #webcam { display: none; } /* Hide actual webcam feed, only needed for tracking */
        #modal { display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background: white; padding: 20px; border: 1px solid #ccc; box-shadow: 0 4px 8px rgba(0,0,0,0.2); }
        #modal.show { display: block; }
        #modal button { margin-top: 10px; }
    </style>
</head>
<body>

    <!-- Webcam feed for eye tracking -->
    <video id="webcam" autoplay playsinline width="320" height="240"></video>

    <!-- Modal for quote output -->
    <div id="modal">
        <p id="quoteText"></p>
        <button onclick="closeModal()">Close</button>
    </div>

    <!-- WebGazer.js for gaze detection -->
    <script src="https://webgazer.cs.brown.edu/webgazer.js"></script>

    <script>
        // Quotes array
        const quotes = [
            "Believe you can and you're halfway there.",
            "Don't watch the clock; do what it does. Keep going.",
            "Success is not how high you have climbed, but how you make a positive difference to the world.",
            "The only limit to our realization of tomorrow is our doubts of today.",
            "Act as if what you do makes a difference. It does."
        ];

        // Get elements
        const modal = document.getElementById('modal');
        const quoteText = document.getElementById('quoteText');

        // Initialize WebGazer for eye tracking
        window.onload = async function() {
            await webgazer.setGazeListener((data, timestamp) => {
                if (data) {
                    // Check if gaze is detected in a certain area (e.g., screen center)
                    const { x, y } = data;
                    if (isEyeInCenter(x, y)) {
                        generateRandomQuote();
                        webgazer.pause(); // Pause tracking after generating a quote
                    }
                }
            }).begin();
        };

        // Define the "center" area for eye detection
        function isEyeInCenter(x, y) {
            const centerX = window.innerWidth / 2;
            const centerY = window.innerHeight / 2;
            const range = 50; // Define the center range

            return (x > centerX - range && x < centerX + range &&
                    y > centerY - range && y < centerY + range);
        }

        // Generate random quote and display in modal
        function generateRandomQuote() {
            const randomQuote = quotes[Math.floor(Math.random() * quotes.length)];
            quoteText.textContent = randomQuote;
            showModal();
        }

        // Show and close modal functions
        function showModal() {
            modal.classList.add('show');
        }

        function closeModal() {
            modal.classList.remove('show');
            webgazer.resume(); // Resume tracking when modal is closed
        }
    </script>

</body>
</html>
