<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Parkify - Daftar Parkir Aktif</title>
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
            <!-- End of Header -->

            <!-- Content -->
            <main class="p-6 space-y-6 flex-1 overflow-y-auto">
                <div class="flex items-center space-x-2">
                    <a href="?url=parkir/masuk"
                        class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg flex items-center space-x-2">
                        <i class="fas fa-plus"></i><span>Parkir Masuk</span>
                    </a>
                </div>

                <div class="bg-white p-6 rounded-lg shadow">
                    <h2 class="text-xl font-bold mb-4">Kendaraan Sedang Parkir</h2>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="border-b-2 border-gray-300">
                                <tr>
                                    <th class="pb-3 font-semibold text-gray-700">No</th>
                                    <th class="pb-3 font-semibold text-gray-700">No Polisi</th>
                                    <th class="pb-3 font-semibold text-gray-700">Jenis</th>
                                    <th class="pb-3 font-semibold text-gray-700">Nama Area</th>
                                    <th class="pb-3 font-semibold text-gray-700">Waktu Masuk</th>
                                    <th class="pb-3 font-semibold text-gray-700">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($parkir)): ?>
                                    <?php $no = 1;
                                    foreach ($parkir as $row): ?>
                                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                                            <td class="py-3"><?= $no++ ?></td>
                                            <td class="py-3 font-semibold"><?= htmlspecialchars($row['plat_nomor']) ?></td>
                                            <td class="py-3"><?= htmlspecialchars($row['jenis_kendaraan']) ?></td>
                                            <td class="py-3"><?= htmlspecialchars($row['nama_area']) ?></td>
                                            <td class="py-3"><?= date('d/m/Y H:i', strtotime($row['waktu_masuk'])) ?></td>
                                            <td class="py-3">
                                                <a href="?url=parkir/keluar/<?= $row['id_parkir'] ?>"
                                                    class="bg-emerald-500 hover:bg-emerald-600 text-white px-3 py-1 rounded text-sm inline-flex items-center space-x-1">
                                                    <i class="fas fa-arrow-right"></i><span>Keluar</span>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr class="border-b border-gray-200">
                                        <td colspan="6" class="py-8 text-center text-gray-500">
                                            <p><i class="fas fa-inbox text-3xl mb-2"></i></p>
                                            <p>Tidak ada kendaraan yang sedang parkir</p>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <?php include VIEWS_PATH . '/partials/parkify/logout-modal.php'; ?>
    <?php include VIEWS_PATH . '/partials/parkify/menu-scripts.php'; ?>
</body>

</html>