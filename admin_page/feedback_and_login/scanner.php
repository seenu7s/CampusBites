<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Camera Scanner</title>
    <style>
        video {
            width: 100%;
            height: auto;
            border: 1px solid black;
        }
        canvas {
            display: none;
        }
    </style>
</head>
<body>
    <h1>Camera Scanner</h1>
    <video id="video" autoplay></video>
    <button id="capture">Capture Photo</button>
    <canvas id="canvas"></canvas>
    <div id="result"></div>

    <script>
        const video = document.getElementById('video');
        const canvas = document.getElementById('canvas');
        const resultDiv = document.getElementById('result');
        const captureButton = document.getElementById('capture');
        const context = canvas.getContext('2d');

        // Access the camera
        navigator.mediaDevices.getUserMedia({ video: true })
            .then(stream => {
                video.srcObject = stream;
            })
            .catch(err => {
                console.error("Error accessing the camera: ", err);
            });

        // Capture photo
        captureButton.addEventListener('click', () => {
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            context.drawImage(video, 0, 0);
            const imageData = canvas.toDataURL('image/png');
            resultDiv.innerHTML = `<h2>Captured Image:</h2><img src="${imageData}" />`;
            sendToServer(imageData);
        });

        function sendToServer(imageData) {
            // Send the captured image to a PHP script
            fetch('upload.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ image: imageData }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    resultDiv.innerHTML += `<p>${data.message}</p>`;
                } else {
                    resultDiv.innerHTML += `<p>Error: ${data.message}</p>`;
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    </script>

    
</body>
</html>
