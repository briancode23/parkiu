<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Parkify - Parkir Masuk</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <?php include VIEWS_PATH . '/partials/parkify/sidebar.php'; ?>
        <!-- End of Sidebar -->

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <?php include VIEWS_PATH . '/partials/parkify/topbar.php'; ?>
            <!-- End of Header -->

            <!-- Content -->
            <main class="p-6 space-y-6 flex-1 overflow-y-auto">
                <div class="bg-white p-6 rounded-lg shadow max-w-2xl">
                    <h2 class="text-xl font-bold mb-4">Catat Kendaraan Masuk</h2>

                    <?php if (!empty($error)): ?>
                        <div class="mb-4 p-4 bg-red-50 border-l-4 border-red-500 text-red-700">
                            <?= $error ?>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="?url=parkir/masuk" class="space-y-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Plat Nomor</label>
                            <input type="text" name="plat_nomor"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent uppercase"
                                required>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Jenis Kendaraan</label>
                            <select name="jenis_kendaraan"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                required>
                                <option value="">-- Pilih Jenis --</option>
                                <option value="Motor">Motor</option>
                                <option value="Mobil">Mobil</option>
                            </select>
                            <small id="infoTarif" class="text-sm text-gray-500 mt-1 block"></small>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Warna</label>
                            <input type="text" name="warna"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                required>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Pemilik</label>
                            <input type="text" name="pemilik"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                required>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Area Parkir</label>
                            <select name="id_area"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                required>
                                <option value="">-- Pilih Area --</option>
                                <?php foreach ($area as $field): ?>
                                    <option value="<?= $field['id_area'] ?>" <?= ($field['terisi'] >= $field['kapasitas']) ? 'disabled' : '' ?>>
                                        <?= htmlspecialchars($field['nama_area']) ?>
                                        (<?= $field['terisi'] ?>/<?= $field['kapasitas'] ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="flex space-x-3 pt-4">
                            <button type="submit"
                                class="bg-emerald-500 hover:bg-emerald-600 text-white px-6 py-2 rounded-lg flex items-center space-x-2">
                                <i class="fas fa-plus"></i><span>Catat Kendaraan Masuk</span>
                            </button>
                            <a href="?url=parkir/index"
                                class="bg-gray-400 hover:bg-gray-500 text-white px-6 py-2 rounded-lg flex items-center space-x-2">
                                <i class="fas fa-times"></i><span>Batal</span>
                            </a>
                        </div>
                    </form>
                </div>
            </main>

            <?php include VIEWS_PATH . '/partials/parkify/logout-modal.php'; ?>
            <?php include VIEWS_PATH . '/partials/parkify/menu-scripts.php'; ?>

</body>

</html>