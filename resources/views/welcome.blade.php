<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Senat Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
</head>

<body>
    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
            <div class="card border rounded-lg p-4">
                <h2 class="mb-4 text-2xl text-gray-900 dark:text-white text-center">Form Presensi Senat Mahasiswa</h2>
                <form action="{{ route('presensi.submit') }}" method="POST">
                    @csrf
                    <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                        <div class="sm:col-span-2">
                            <label for="name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
                            <input type="text" name="name" id="name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Nama" required>
                        </div>
                        <div class="w-full">
                            <label for="nim"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">NIM</label>
                            <input type="text" name="nim" id="nim"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="NIM" required>
                        </div>
                        <div class="w-full">
                            <label for="timestamp"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Timestamp</label>
                            <input type="text" name="timestamp" id="timestamp" readonly
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Current Time">
                        </div>
                        <div>
                            <label for="jenis"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jenis Absen</label>
                            <select id="jenis" name="jenis"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option selected>Pilih Absen</option>
                                <option value="Piket">Absen Piket</option>
                                <option value="Kegiatan">Kegiatan</option>
                            </select>
                        </div>
                        <div>
                            <label for="lokasi"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Lokasi
                                Absen</label>
                            <input type="text" name="lokasi" id="lokasi" readonly
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Lokasi" required>
                        </div>
                        <div>
                            <label for="kamera"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Presensi
                                Wajah</label>
                            <video id="kamera" width="320" height="240" autoplay
                                class="border rounded-lg"></video>
                            <input type="hidden" name="kamera" id="kamera-input">
                        </div>
                        <div class="mt-3">
                            <button type="submit"
                                class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-black bg-primary-700 border rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                                Submit
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                confirmButtonText: 'OK'
            });
        </script>
    @endif
    <script>
        // Auto Timestamp with Logging
        const now = new Date();
        const formattedTimestamp = now.getFullYear() + '-' +
            String(now.getMonth() + 1).padStart(2, '0') + '-' +
            String(now.getDate()).padStart(2, '0') + ' ' +
            String(now.getHours()).padStart(2, '0') + ':' +
            String(now.getMinutes()).padStart(2, '0') + ':' +
            String(now.getSeconds()).padStart(2, '0');
        document.getElementById("timestamp").value = formattedTimestamp;
        console.log("Timestamp set to:", formattedTimestamp);

        // Auto Location with Logging
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition((position) => {
                const location = `Lat: ${position.coords.latitude}, Lon: ${position.coords.longitude}`;
                document.getElementById("lokasi").value = location;
                console.log("Location set to:", location);
            }, (error) => {
                console.error("Geolocation error:", error.message);
            });
        } else {
            document.getElementById("lokasi").value = "Geolocation is not supported";
            console.warn("Geolocation not supported by this browser.");
        }

        // Start video feed
        const video = document.getElementById('kamera');
        const hiddenKameraInput = document.getElementById('kamera-input');

        if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
            navigator.mediaDevices.getUserMedia({
                video: true
            }).then((stream) => {
                video.srcObject = stream;
                video.play();
            }).catch((error) => {
                console.error("Error accessing the camera:", error);
            });
        } else {
            console.warn("Media devices not supported in this browser.");
        }

        // Function to capture the image
        function captureImage() {
            // Create a canvas element to draw the video frame
            const canvas = document.createElement('canvas');
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            const context = canvas.getContext('2d');
            context.drawImage(video, 0, 0, canvas.width, canvas.height);

            // Convert canvas to base64 image
            const imageData = canvas.toDataURL('image/png');
            hiddenKameraInput.value = imageData; // Set image data to hidden input
            console.log("Image captured and set in hidden input.");
        }

        // Capture image before submitting the form
        document.querySelector('form').addEventListener('submit', (event) => {
            captureImage(); // Capture image on form submission
        });
    </script>
</body>

</html>
