<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Parkify - Manajemen Tarif</title>
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
                <?php if (!empty($error)): ?>
                    <div class="mb-4 p-4 bg-red-50 border-l-4 border-red-500 rounded">
                        <p class="text-red-700 font-semibold"><?= htmlspecialchars($error) ?></p>
                    </div>
                <?php endif; ?>

                <!-- Rate Table -->
                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="mb-4 flex items-center justify-between">
                    <h2 class="text-xl font-bold mb-6">Daftar Tarif Kendaraan</h2>
                    	<a href="/admin/tambahTarif" class="bg-emerald-500 hover:bg-emerald-600 text-white px-4 py-2 rounded-lg flex items-center space-x-2">
                            <i class="fas fa-plus"></i><span>Tambah Tarif</span>
                        </a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="border-b-2 border-gray-300">
                                <tr>
                                    <th class="pb-3 font-semibold text-gray-700">No</th>
                                    <th class="pb-3 font-semibold text-gray-700">Jenis Kendaraan</th>
                                    <th class="pb-3 font-semibold text-gray-700">Tarif per Jam</th>
                                    <th class="pb-3 font-semibold text-gray-700">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (isset($tarif) && !empty($tarif)): ?>
                                    <?php $no = 1;
                                    foreach ($tarif as $row): ?>
                                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                                            <td class="py-3"><?= $no++ ?></td>
                                            <td class="py-3 font-semibold"><?= htmlspecialchars($row['jenis_kendaraan']) ?></td>
                                            <td class="py-3">Rp <?= number_format($row['tarif_per_jam'], 0, ',', '.') ?></td>
                                            <td class="py-3">
                                                <a href="?url=parkir/editTarif/<?= $row['id_tarif'] ?>"
                                                    class="inline-block bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg font-semibold transition">
                                                    <i class="fas fa-edit mr-1"></i>Edit
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="4" class="py-8 text-center text-gray-500">
                                            <i class="fas fa-inbox text-4xl mb-4 block text-gray-300"></i>
                                            Tidak ada data tarif
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
    <div id="logoutModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-2xl max-w-md w-full mx-4">
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

    <script>
        function toggleUserMenu() {
            var userMenu = document.getElementById('userMenu');
            if (userMenu) userMenu.classList.toggle('hidden');
        }

        function openLogoutModal() {
            document.getElementById('logoutModal').classList.remove('hidden');
        }

        function closeLogoutModal() {
            document.getElementById('logoutModal').classList.add('hidden');
        }

        document.addEventListener('click', function (e) {
            var userMenuBtn = document.getElementById('userMenuBtn');
            var userMenu = document.getElementById('userMenu');
            if (userMenu && userMenuBtn && !userMenu.contains(e.target) && !userMenuBtn.contains(e.target)) {
                userMenu.classList.add('hidden');
            }
        });

        // Close modal when clicking outside
        document.getElementById('logoutModal').addEventListener('click', function (e) {
            if (e.target === this) {
                closeLogoutModal();
            }
        });

        // Close modal on Escape key
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                closeLogoutModal();
            }
        });
    </script>
</body>

</html>