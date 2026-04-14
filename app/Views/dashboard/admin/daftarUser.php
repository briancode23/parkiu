<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Parkify - Daftar User</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.datatables.net/2.3.6/css/dataTables.dataTables.min.css" rel="stylesheet">

</head>

<body class="bg-gray-100">
    <div class="flex h-screen">
        <?php include VIEWS_PATH . '/partials/parkify/sidebar.php'; ?>

        <div class="flex-1 flex flex-col">
            <?php include VIEWS_PATH . '/partials/parkify/topbar.php'; ?>

            <main class="p-6 space-y-6 flex-1 overflow-y-auto">
                <!-- Cards -->
                <!-- Gunakan flex agar card tidak dipaksa memenuhi kolom -->
                <div class="flex flex-wrap gap-6">

                    <!-- Card 1: Pakai w-fit agar kotak hanya selebar isi -->
                    <div class="bg-white p-6 rounded-lg shadow w-fit min-w-[200px]">
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0 p-3 bg-green-500 rounded-full">
                                <i class="fas fa-id-card text-white text-2xl"></i>
                            </div>
                            <div class="whitespace-nowrap text-right">
                                <!-- whitespace-nowrap cegah teks turun ke bawah -->
                                <p class="text-gray-600">
                                    Total User
                                </p>
                                <p class="text-2xl font-bold">
                                    <?= isset($totalUser) ? $totalUser : 0 ?>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Card 2: Pakai w-fit agar kotak hanya selebar isi -->
                    <div class="bg-white p-6 rounded-lg shadow w-fit min-w-[200px]">
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0 p-3 bg-indigo-500 rounded-full">
                                <i class="fas fa-parking text-white text-2xl"></i>
                            </div>
                            <div class="whitespace-nowrap text-right">
                                <p class="text-gray-600">
                                    Jumlah Area Parkir
                                </p>
                                <p class="text-2xl font-bold">
                                    <?= isset($totalArea) ? $totalArea : 0 ?> Area
                                </p>
                            </div>
                        </div>
                    </div>

                </div>


                <!-- Daftar User Table -->
                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-bold text-slate-900">Daftar User</h2>
                        <a href="/admin/tambahUser"
                            class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg font-semibold transition flex items-center">
                            <i class="fas fa-plus mr-2"></i>Tambah User
                        </a>
                    </div>

                    <?php if (!empty($_GET['success'])): ?>
                    <div class="mb-4 p-4 bg-emerald-50 border-l-4 border-emerald-500 rounded">
                        <p class="text-emerald-700 font-semibold">
                            <?= htmlspecialchars($_GET['success']) ?>
                        </p>
                    </div>
                    <?php endif; ?>

                    <?php if (!empty($_POST['error'])): ?>
                    <div class="mb-4 p-4 bg-red-50 border-l-4 border-red-500 rounded">
                        <p class="text-red-700 font-semibold">
                            <?= htmlspecialchars($_POST['error']) ?>
                        </p>
                    </div>
                    <?php endif; ?>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="border-b-2 border-gray-300">
                                <tr>
                                    <th class="pb-3 font-semibold text-gray-700">No</th>
                                    <th class="pb-3 font-semibold text-gray-700">Nama Lengkap</th>
                                    <th class="pb-3 font-semibold text-gray-700">Username</th>
                                    <th class="pb-3 font-semibold text-gray-700">Status</th>
                                    <th class="pb-3 font-semibold text-gray-700">Role</th>
                                    <th class="pb-3 font-semibold text-gray-700">Created</th>
                                    <th class="pb-3 font-semibold text-gray-700">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (isset($data) && !empty($data)): ?>
                                <?php $no = 1;
                                foreach ($data as $row): ?>
                                <?php
                                $stateAktif = $row['status_aktif'] ?? 0;
                                $realState = ($stateAktif == 1) ? 'Aktif' : 'Tidak Aktif';
                                $statusColor = ($stateAktif == 1) ? 'bg-emerald-100 text-emerald-800' : 'bg-red-100 text-red-800';
                                $roleBadge = match ($row['role'] ?? 'user') {
                                    'admin' => 'bg-blue-100 text-blue-800',
                                    'petugas' => 'bg-orange-100 text-orange-800',
                                    'owner' => 'bg-purple-100 text-purple-800',
                                    default => 'bg-gray-100 text-gray-800'
                                    };
                                    ?>
                                    <tr class="border-b border-gray-200 hover:bg-gray-50">
                                        <td class="py-3"><?= $no++ ?></td>
                                        <td class="py-3 font-semibold"><?= htmlspecialchars($row['nama_lengkap']) ?? ''; ?></td>
                                        <td class="py-3"><?= htmlspecialchars($row['username']) ?></td>
                                        <td class="py-3">
                                            <span class="<?= $statusColor ?> text-xs font-bold px-3 py-1 rounded-full">
                                                <?= $realState ?>
                                            </span>
                                        </td>
                                        <td class="py-3">
                                            <span class="<?= $roleBadge ?> text-xs font-bold px-3 py-1 rounded-full">
                                                <?= ucfirst($row['role']) ?>
                                            </span>
                                        </td>
                                        <td class="py-3 text-sm text-gray-600">
                                            <?= date('d/m/Y', strtotime($row['created_at'])) ?></td>
                                        <td class="py-3">
                                            <div class="flex space-x-2">
                                                <a href="/user/edit/<?= $row['id_user']; ?>" class="text-blue-500 hover:text-blue-700" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="/user/delete/<?= $row['id_user']; ?>" class="text-red-500 hover:text-red-700" title="Hapus"
                                                    onclick="return confirm('Yakin hapus user ini?')">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                    <?php else : ?>
                                    <tr>
                                        <td colspan="7" class="py-8 text-center text-gray-500">
                                            <i class="fas fa-inbox text-4xl mb-4 block text-gray-300"></i>
                                            Tidak ada data user
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

        <!-- Logout Modal -->
        <div id="logoutModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white rounded-lg shadow-2xl max-w-md w-full mx-4">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-bold text-gray-900">Yakin untuk keluar?</h3>
                </div>
                <div class="p-6">
                    <p class="text-gray-600">
                        Klik "Logout" dibawah jika anda yakin mengakhiri sesi.
                    </p>
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
            function openLogoutModal() {
                document.getElementById('logoutModal').classList.remove('hidden');
            }

            function closeLogoutModal() {
                document.getElementById('logoutModal').classList.add('hidden');
            }

            function toggleUserMenu() {
                document.getElementById('userMenu').classList.toggle('hidden');
            }

            document.addEventListener('click', function (e) {
                var userMenu = document.getElementById('userMenu');
                var userMenuBtn = document.getElementById('userMenuBtn');
                if (userMenu && userMenuBtn && !userMenu.contains(e.target) && !userMenuBtn.contains(e.target)) {
                    userMenu.classList.add('hidden');
                }
            });

            document.getElementById('logoutModal').addEventListener('click', function (e) {
                if (e.target === this) {
                    closeLogoutModal();
                }
            });

            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape') {
                    closeLogoutModal();
                }
            });
        </script>
    </body>

</html>