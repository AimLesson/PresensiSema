<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fullscreen Eye-Health Detection</title>

    <!-- Bootstrap CSS (optional, for modal styling only) -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Make body take full height and center content */
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #000; /* Optional: black background for full screen */
        }

        /* Webcam feed styles */
        #webcam {
            width: 100vw;
            height: 100vh;
            object-fit: cover; /* Ensures video covers the screen */
        }

        /* Modal styles */
        .modal {
            color: #333;
        }
    </style>
</head>
<body>

    <!-- Webcam feed -->
    <video id="webcam" autoplay playsinline></video>

    <!-- Modal for displaying eye health advice -->
    <div class="modal fade" id="eyeAdviceModal" tabindex="-1" aria-labelledby="eyeAdviceModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eyeAdviceModalLabel">Eye Health Advice</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closeModal()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="quoteText"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="closeModal()">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- WebGazer.js for gaze detection -->
    <script src="https://webgazer.cs.brown.edu/webgazer.js"></script>
    <!-- Bootstrap JS (optional, for modal functionality) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Eye health advice array
        const eyeAdvice = [
            "It seems like you may have nearsightedness. Consider consulting an eye specialist.",
            "Are you experiencing blurred vision? It could be a sign of farsightedness.",
            "Frequent screen use detected. Remember to take breaks and practice the 20-20-20 rule.",
            "Dry eyes? Try to blink more frequently or consider using eye drops.",
            "You might have astigmatism symptoms. A professional eye exam is recommended."
        ];

        // Get elements
        const quoteText = document.getElementById('quoteText');

        // Initialize WebGazer for eye tracking
        window.onload = async function() {
            console.log("Initializing WebGazer...");

            try {
                await webgazer.setGazeListener((data, timestamp) => {
                    if (data) {
                        console.log("Gaze data detected:", data); // Log gaze data
                        generateRandomAdvice();
                        webgazer.pause(); // Pause tracking after generating advice
                    } else {
                        console.log("No gaze data available yet.");
                    }
                }).begin();

                console.log("WebGazer initialized successfully.");
            } catch (error) {
                console.error("Error initializing WebGazer:", error);
            }
        };

        // Generate random eye health advice and display in modal
        function generateRandomAdvice() {
            const randomAdvice = eyeAdvice[Math.floor(Math.random() * eyeAdvice.length)];
            console.log("Displaying advice:", randomAdvice); // Log the selected advice
            quoteText.textContent = randomAdvice;
            $('#eyeAdviceModal').modal('show'); // Show modal using Bootstrap
        }

        // Close modal and resume gaze tracking
        function closeModal() {
            console.log("Closing modal.");
            $('#eyeAdviceModal').modal('hide'); // Hide modal using Bootstrap
            webgazer.resume(); // Resume tracking when modal is closed
        }
    </script>

</body>
</html>
