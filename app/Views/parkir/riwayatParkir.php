<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Parkify - Riwayat Parkir</title>
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
                <!-- History Table -->
                <div class="bg-white p-6 rounded-lg shadow">
                    <h2 class="text-xl font-bold mb-6">Daftar Riwayat Parkir</h2>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="border-b-2 border-gray-300">
                                <tr>
                                    <th class="pb-3 font-semibold text-gray-700">No</th>
                                    <th class="pb-3 font-semibold text-gray-700">Plat Nomor</th>
                                    <th class="pb-3 font-semibold text-gray-700">Waktu Masuk</th>
                                    <th class="pb-3 font-semibold text-gray-700">Waktu Keluar</th>
                                    <th class="pb-3 font-semibold text-gray-700">Durasi</th>
                                    <th class="pb-3 font-semibold text-gray-700">Total Biaya</th>
                                    <th class="pb-3 font-semibold text-gray-700">Area</th>
                                    <th class="pb-3 font-semibold text-gray-700">Petugas</th>
                                    <th class="pb-3 font-semibold text-gray-700">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (isset($parkir) && !empty($parkir)): ?>
                                    <?php $no = 1;
                                    foreach ($parkir as $row): ?>
                                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                                            <td class="py-3"><?= $no++ ?></td>
                                            <td class="py-3 font-semibold"><?= htmlspecialchars($row['plat_nomor']) ?></td>
                                            <td class="py-3 text-sm"><?= htmlspecialchars($row['waktu_masuk']) ?></td>
                                            <td class="py-3 text-sm"><?= htmlspecialchars($row['waktu_keluar']) ?></td>
                                            <td class="py-3"><?= $row['durasi_jam'] ?> jam</td>
                                            <td class="py-3 font-semibold">Rp
                                                <?= number_format($row['biaya_total'], 0, ',', '.') ?></td>
                                            <td class="py-3"><?= htmlspecialchars($row['nama_area']) ?></td>
                                            <td class="py-3"><?= htmlspecialchars($row['nama_lengkap']) ?></td>
                                            <td class="py-3">
                                                <a href="?url=parkir/struk/<?= $row['id_parkir'] ?>"
                                                    class="inline-block bg-emerald-500 hover:bg-emerald-600 text-white px-3 py-1 rounded-lg text-sm font-semibold transition">
                                                    <i class="fas fa-receipt mr-1"></i>Struk
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="9" class="py-8 text-center text-gray-500">
                                            <i class="fas fa-inbox text-4xl mb-4 block text-gray-300"></i>
                                            Tidak ada data riwayat parkir
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
            <!-- End of Content -->
        </div>
    </div>

    <!-- Logout Modal -->
    <div id="logoutModal" class="hidden fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 z-50">
        <div
            class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white rounded-lg shadow-2xl max-w-md w-full mx-4">
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-lg font-bold text-gray-900">Yakin untuk keluar?</h3>
            </div>
            <div class="p-6">
                <p class="text-gray-600">Klik "Logout" dibawah jika anda yakin mengakhiri sesi.</p>
            </div>
            <div class="p-6 border-t border-gray-200 flex space-x-3 justify-end">
                <button onclick="closeLogoutModal()"
                    class="px-4 py-2 text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-50 font-semibold">
                    Batal
                </button>
                <a href="?url=auth/logout"
                    class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 font-semibold">
                    Logout
                </a>
            </div>
        </div>
    </div>

    <?php include VIEWS_PATH . '/partials/parkify/logout-modal.php'; ?>
    <?php include VIEWS_PATH . '/partials/parkify/menu-scripts.php'; ?>