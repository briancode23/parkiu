<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Parkify - 404 Not Found</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-slate-900 to-slate-700 min-h-screen flex items-center justify-center">
    <div class="max-w-md w-full text-center px-4">
        <!-- 404 Icon -->
        <div class="mb-8">
            <div class="inline-block bg-blue-500 rounded-full p-8 mb-6">
                <i class="fas fa-exclamation-triangle text-white text-6xl"></i>
            </div>
        </div>

        <!-- Error Message -->
        <h1 class="text-7xl font-bold text-white mb-4">404</h1>
        <h2 class="text-3xl font-bold text-white mb-3">Halaman Tidak Ditemukan</h2>
        <p class="text-gray-300 mb-8 text-lg">
            Maaf, halaman yang Anda cari tidak tersedia atau telah dipindahkan.
        </p>

        <!-- Action Buttons -->
        <div class="space-y-3">
            <a href="?url=home/index" class="block bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-6 rounded-lg transition">
                <i class="fas fa-home mr-2"></i>Kembali ke Beranda
            </a>
            <a href="javascript:history.back()" class="block bg-slate-600 hover:bg-slate-700 text-white font-bold py-3 px-6 rounded-lg transition">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
        </div>

        <!-- Footer -->
        <div class="mt-12 pt-8 border-t border-slate-600">
            <p class="text-gray-400 text-sm">© 2026 Parkify. All rights reserved.</p>
        </div>
    </div>
</html>
