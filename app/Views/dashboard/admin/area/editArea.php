<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Parkify - Edit Area Parkir</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <?php include VIEWS_PATH . 'partials/parkify/sidebar.php': ?>
        <!-- End of Sidebar -->

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <?php include VIEWS_PATH . '/partials/parkify/topbar.php'; ?>
            <!-- End of Header -->

            <!-- Content -->
            <main class="p-6 space-y-6 flex-1 overflow-y-auto">
                <div class="bg-white p-6 rounded-lg shadow max-w-2xl">
                    <h2 class="text-xl font-bold mb-4">Edit Area Parkir</h2>

                    <?php if (!empty($error)): ?>
                        <div class="mb-4 p-4 bg-red-50 border-l-4 border-red-500 text-red-700">
                            <?= $error ?>
                        </div>
                    <?php endif; ?>

                    <form method="POST" class="space-y-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Area</label>
                            <input type="text" name="nama_area"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                value="<?= htmlspecialchars($data['nama_area']) ?>" required>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Kapasitas</label>
                            <input type="number" name="kapasitas"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                value="<?= $data['kapasitas'] ?>" required>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Terisi</label>
                            <input type="number" name="terisi"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-100"
                                value="<?= $data['terisi'] ?>" readonly>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Keterangan</label>
                            <textarea name="keterangan"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                rows="3" required><?= htmlspecialchars($data['keterangan']) ?></textarea>
                        </div>

                        <div class="flex space-x-3 pt-4">
                            <button type="submit"
                                class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg flex items-center space-x-2">
                                <i class="fas fa-save"></i><span>Simpan</span>
                            </button>
                            <a href="?url=parkir/area"
                                class="bg-gray-400 hover:bg-gray-500 text-white px-6 py-2 rounded-lg flex items-center space-x-2">
                                <i class="fas fa-times"></i><span>Kembali</span>
                            </a>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>

    <?php include VIEWS_PATH . '/partials/parkify/logout-modal.php'; ?>
    <?php include VIEWS_PATH . '/partials/parkify/menu-scripts.php'; ?>

</body>

</html>