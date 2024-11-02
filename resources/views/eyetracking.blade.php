<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eye-Health Detection</title>

    <!-- Tailwind CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">

    <!-- Flowbite -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.5.3/flowbite.min.js"></script>

    <style>
        /* Custom styling for hidden webcam feed */
        #webcam-container {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 100%;
            background-color: #1a202c;
            border-radius: 0.5rem;
        }
        #webcam {
            width: 100%;
            height: auto;
        }
    </style>
</head>
<body class="flex items-center justify-center h-screen bg-gray-100 font-sans">

    <!-- Card Container for Webcam Feed -->
    <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-lg">
        <h2 class="text-center text-2xl font-semibold text-gray-700 mb-4">Eye Detection</h2>

        <!-- Webcam Feed Container -->
        <div id="webcam-container" class="relative w-full h-64 md:h-80 rounded-lg overflow-hidden">
            <video id="webcam" autoplay playsinline></video>
        </div>

        <p class="mt-4 text-center text-gray-500">Eye Detection in Progress...</p>
    </div>

    <!-- Modal for displaying eye health advice -->
    <div id="modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
        <div class="relative w-full h-full max-w-md md:h-auto">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="p-4 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-medium text-gray-900 dark:text-white">Eye Health Advice</h3>
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
        // Eye health advice array
        const eyeAdvice = [
            "It seems like you may have nearsightedness. Consider consulting an eye specialist.",
            "Are you experiencing blurred vision? It could be a sign of farsightedness.",
            "Frequent screen use detected. Remember to take breaks and practice the 20-20-20 rule.",
            "Dry eyes? Try to blink more frequently or consider using eye drops.",
            "You might have astigmatism symptoms. A professional eye exam is recommended."
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
