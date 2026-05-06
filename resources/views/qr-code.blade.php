<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Generator</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <div class="max-w-md mx-auto bg-white shadow-lg rounded-2xl p-6 space-y-4 mt-10">
        <h2 class="text-2xl font-bold text-gray-700 text-center">Membuat QR Code</h2>
        <div>
            <label for="data" class="block text-sm font-medium text-gray-600 mb-1">Masukkan Data Untuk QR Code:</label>
            <input type="text" id="data"
                class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                placeholder="Masukkan teks atau URL">
        </div>

        {{-- Input logo --}}
        <div>
            <label for="logo" class="block text-sm font-medium text-gray-600 mb-1">Logo Instansi (opsional):</label>
            <input type="file" id="logo" accept="image/*"
                class="w-full px-4 py-2 border border-gray-300 rounded-xl text-sm text-gray-600">
        </div>

        <button id="generateBtn"
            class="w-full bg-blue-600 text-white font-semibold py-2 px-4 rounded-xl hover:bg-blue-700 transition duration-200">
            Buat QR Code
        </button>
    </div>

    <div id="qr-result" class="mt-10 flex flex-col items-center hidden">
        <canvas id="final-canvas"></canvas>
        <button id="downloadPngBtn"
            class="mt-4 bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
            Download QR Code (PNG)
        </button>
    </div>

    <div id="qr-container" class="hidden"></div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>

    <script>
        let qrInstance = null;
        const QR_SIZE = 500;

        document.getElementById('generateBtn').addEventListener('click', function () {
            const data = document.getElementById('data').value.trim();
            if (!data) return alert('Masukkan data terlebih dahulu!');

            const container = document.getElementById('qr-container');
            container.innerHTML = '';

            if (qrInstance) qrInstance.clear();

            qrInstance = new QRCode(container, {
                text: data,
                width: QR_SIZE,
                height: QR_SIZE,
                colorDark: '#000000',
                colorLight: '#ffffff',
                correctLevel: QRCode.CorrectLevel.H // H = bisa sembunyikan logo di tengah
            });

            // Tunggu QR selesai di-render
            setTimeout(() => {
                const qrCanvas = container.querySelector('canvas');
                const finalCanvas = document.getElementById('final-canvas');
                finalCanvas.width = QR_SIZE;
                finalCanvas.height = QR_SIZE;
                const ctx = finalCanvas.getContext('2d');

                // Gambar QR code ke final canvas
                ctx.drawImage(qrCanvas, 0, 0, QR_SIZE, QR_SIZE);

                // Cek apakah ada logo
                const logoFile = document.getElementById('logo').files[0];
                if (logoFile) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        const logoImg = new Image();
                        logoImg.onload = function () {
                            // Ukuran logo = 20% dari QR
                            const logoSize = QR_SIZE * 0.2;
                            const logoX = (QR_SIZE - logoSize) / 2;
                            const logoY = (QR_SIZE - logoSize) / 2;

                            // Background putih bulat di belakang logo
                            ctx.fillStyle = '#ffffff';
                            ctx.beginPath();
                            ctx.roundRect(logoX - 5, logoY - 5, logoSize + 10, logoSize + 10, 8);
                            ctx.fill();

                            // Gambar logo
                            ctx.drawImage(logoImg, logoX, logoY, logoSize, logoSize);

                            document.getElementById('qr-result').classList.remove('hidden');
                        };
                        logoImg.src = e.target.result;
                    };
                    reader.readAsDataURL(logoFile);
                } else {
                    document.getElementById('qr-result').classList.remove('hidden');
                }
            }, 200);
        });

        document.getElementById('downloadPngBtn').addEventListener('click', function () {
            const canvas = document.getElementById('final-canvas');
            const link = document.createElement('a');
            link.href = canvas.toDataURL('image/png');
            link.download = 'qrcode.png';
            link.click();
        });
    </script>

</body>
</html>

