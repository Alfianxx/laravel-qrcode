<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Generator</title>

    <!-- Tailwind harus ada di head -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <form method="POST" action="{{ route('generate-qr-code') }}" 
          class="max-w-md mx-auto bg-white shadow-lg rounded-2xl p-6 space-y-4 mt-10">
        @csrf
        <h2 class="text-2xl font-bold text-gray-700 text-center">Generate QR Code</h2>

        <div>
            <label for="data" class="block text-sm font-medium text-gray-600 mb-1">Enter Data for QR Code:</label>
            <input type="text" id="data" name="data" required
                class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200" 
                placeholder="Masukkan teks atau URL">
        </div>

        <button type="submit" 
            class="w-full bg-blue-600 text-white font-semibold py-2 px-4 rounded-xl hover:bg-blue-700 focus:ring-2 focus:ring-blue-400 focus:outline-none transition duration-200">
            Generate QR Code
        </button>
    </form>

    {{-- display qr code --}}
    {{-- @if (Session::has('qrCode'))
        <div class="mt-10 flex justify-center">
            {!! Session::get('qrCode') !!}
            
        </div>
        
    @endif --}}


{{-- display qr code --}}

@if(Session::has('qrCode'))
    <div class="mt-10 flex flex-col items-center">
        {{-- Tampilkan QR code SVG --}}
        <div id="qr-container">{!! Session::get('qrCode') !!}</div>

        {{-- Tombol download PNG --}}
        <button id="downloadPngBtn"
                class="mt-4 bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
            Download QR Code (PNG)
        </button>
    </div>
@endif

{{-- untuk konvert svg ke jpg lewat frontend/javascript --}}
<script>
document.getElementById('downloadPngBtn').addEventListener('click', function() {
    const svgElement = document.querySelector('#qr-container svg');

    const canvas = document.createElement('canvas');
    const bbox = svgElement.getBBox();
    canvas.width = bbox.width;
    canvas.height = bbox.height;
    const ctx = canvas.getContext('2d');

    const svgData = new XMLSerializer().serializeToString(svgElement);
    const img = new Image();
    const svgBlob = new Blob([svgData], {type: 'image/svg+xml;charset=utf-8'});
    const url = URL.createObjectURL(svgBlob);

    img.onload = function() {
        ctx.drawImage(img, 0, 0);
        URL.revokeObjectURL(url);

        const pngUrl = canvas.toDataURL('image/png');
        const link = document.createElement('a');
        link.href = pngUrl;
        link.download = 'qrcode.png';
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    };

    img.src = url;
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