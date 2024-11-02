<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Automated Eye-Detection with Quote Generation</title>

    <!-- Tailwind CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">

    <!-- Flowbite -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.5.3/flowbite.min.js"></script>

    <style>
        #webcam { display: none; } /* Hide actual webcam feed, only needed for tracking */
    </style>
</head>
<body class="flex items-center justify-center h-screen bg-gray-100 font-sans">

    <!-- Webcam feed for eye tracking -->
    <video id="webcam" autoplay playsinline width="320" height="240"></video>

    <!-- Modal for quote output -->
    <div id="modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
        <div class="relative w-full h-full max-w-md md:h-auto">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="p-4 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-medium text-gray-900 dark:text-white">Your Quote</h3>
                </div>
                <!-- Modal body -->
                <div class="p-6 space-y-6">
                    <p id="quoteText" class="text-base leading-relaxed text-gray-500 dark:text-gray-400"></p>
                </div>
                <!-- Modal footer -->
                <div class="flex items-center justify-end p-4 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button onclick="closeModal()" class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Close</button>
                </div>
            </div>
        </div>
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
            console.log("Initializing WebGazer...");

            try {
                await webgazer.setGazeListener((data, timestamp) => {
                    if (data) {
                        console.log("Gaze data detected:", data); // Log gaze data
                        generateRandomQuote();
                        webgazer.pause(); // Pause tracking after generating a quote
                    } else {
                        console.log("No gaze data available yet.");
                    }
                }).begin();

                console.log("WebGazer initialized successfully.");
            } catch (error) {
                console.error("Error initializing WebGazer:", error);
            }
        };

        // Generate random quote and display in modal
        function generateRandomQuote() {
            const randomQuote = quotes[Math.floor(Math.random() * quotes.length)];
            console.log("Displaying quote:", randomQuote); // Log the selected quote
            quoteText.textContent = randomQuote;
            showModal();
        }

        // Show and close modal functions
        function showModal() {
            console.log("Showing modal.");
            modal.classList.remove('hidden');
        }

        function closeModal() {
            console.log("Closing modal.");
            modal.classList.add('hidden');
            webgazer.resume(); // Resume tracking when modal is closed
        }
    </script>

</body>
</html>
