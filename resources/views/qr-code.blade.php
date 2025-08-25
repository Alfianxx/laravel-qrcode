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