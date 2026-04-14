<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Parkify - Tambah Area</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar (Sama dengan Dashboard) -->
        <?php include VIEWS_PATH . '/partials/parkify/sidebar.php'; ?>

        <div class="flex-1 flex flex-col">
            <!-- Topbar (Sama dengan Dashboard) -->
            <?php include VIEWS_PATH . '/partials/parkify/topbar.php'; ?>

            <!-- Content -->
            <main class="p-6 space-y-6 overflow-y-auto">
                <!-- Header Halaman -->
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Manajemen Area</h1>
                    <p class="text-gray-600 text-sm">Tambahkan lokasi parkir baru ke dalam sistem.</p>
                </div>

                <!-- Form Card -->
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 max-w-2xl">
                    <h2 class="text-lg font-bold text-gray-800 mb-6 flex items-center">
                        <i class="fas fa-plus-circle mr-2 text-blue-500"></i> Form Tambah Area
                    </h2>

                    <!-- Error Alert -->
                    <?php if (isset($_SESSION['errors'])) : ?>
                    <div class="mb-4 p-4 bg-red-50 border-l-4 border-red-500 rounded text-red-700">
                        <p class="font-bold text-sm mb-1">Terjadi Kesalahan:</p>
                        <ul class="text-sm list-disc list-inside">
                            <?php foreach ($_SESSION['errors'] as $error) : ?>
                            <li><?= htmlspecialchars($error) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <?php unset($_SESSION['errors']); ?>
                    <?php endif; ?>

                    <form method="POST" action="/area/store" class="space-y-5">
                        <!-- Nama Area -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Area</label>
                            <input type="text" name="nama_area" placeholder="Contoh: Area A (Lantai 1)"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition"
                                value="<?= $_SESSION['old']['nama_area'] ?? '' ?>" required>
                        </div>

                        <!-- Kapasitas -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Kapasitas (Slot)</label>
                            <input type="number" name="kapasitas" min="1" placeholder="0"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition"
                                value="<?= $_SESSION['old']['kapasitas'] ?? '' ?>" required>
                        </div>

                        <!-- Keterangan -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Keterangan</label>
                            <textarea name="keterangan" rows="3" placeholder="Tambahkan catatan lokasi..."
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition"><?= $_SESSION['old']['keterangan'] ?? '' ?></textarea>
                        </div>

                        <!-- Action Buttons -->
                        <div class="pt-4 flex items-center space-x-3 border-t border-gray-100">
                            <button type="submit" 
                                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-lg font-bold transition shadow-sm flex items-center">
                                <i class="fas fa-save mr-2"></i> Simpan Area
                            </button>
                            <a href="?url=parkir/area" 
                                class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-6 py-2.5 rounded-lg font-bold transition">
                                Batal
                            </a>
                        </div>
                    </form>
                    <?php unset($_SESSION['old']); ?>
                </div>
            </main>
            <!-- End of Content -->
        </div>
    </div>

    <!-- Partials Scripts (Sama dengan Dashboard) -->
    <?php include VIEWS_PATH . '/partials/parkify/logout-modal.php'; ?>
    <?php include VIEWS_PATH . '/partials/parkify/menu-scripts.php'; ?>
</body>

</html>
