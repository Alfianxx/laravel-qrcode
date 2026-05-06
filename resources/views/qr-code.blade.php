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
        <button id="generateBtn"
            class="w-full bg-blue-600 text-white font-semibold py-2 px-4 rounded-xl hover:bg-blue-700 transition duration-200">
            Buat QR Code
        </button>
    </div>

    <div id="qr-result" class="mt-10 flex flex-col items-center hidden">
        <div id="qr-container"></div>
        <button id="downloadPngBtn"
            class="mt-4 bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
            Download QR Code (PNG)
        </button>
    </div>

    {{-- Library QR code frontend --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>

    <script>
        let qrInstance = null;

        document.getElementById('generateBtn').addEventListener('click', function () {
            const data = document.getElementById('data').value.trim();
            if (!data) return alert('Masukkan data terlebih dahulu!');

            const container = document.getElementById('qr-container');
            container.innerHTML = ''; // reset

            if (qrInstance) {
                qrInstance.clear();
            }

            qrInstance = new QRCode(container, {
                text: data,
                width: 200,
                height: 200,
                colorDark: '#000000',
                colorLight: '#ffffff',
                correctLevel: QRCode.CorrectLevel.L
            });

            document.getElementById('qr-result').classList.remove('hidden');
        });

        document.getElementById('downloadPngBtn').addEventListener('click', function () {
            const canvas = document.querySelector('#qr-container canvas');
            if (!canvas) return alert('Generate QR code dulu!');
            const link = document.createElement('a');
            link.href = canvas.toDataURL('image/png');
            link.download = 'qrcode.png';
            link.click();
        });
    </script>

</body>
</html>
















{{-- <form method="POST" action="{{ route('generate-qr-code') }}">
    @csrf
    <div>
        <label for="data">Enter Data for QR Code:</label>
        <input type="text" id="data" name="data" required>
    </div>
    <button type="submit">Generate QR Code</button>
</form> --}}
