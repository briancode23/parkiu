<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Parkify - <?= $title ?? 'Activity Log' ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-slate-900 text-white flex flex-col">
            <div class="p-4 border-b border-slate-700">
                <div class="flex items-center">
                    <i class="fas fa-car-side text-2xl mr-2"></i>
                    <span class="text-xl font-bold">Parkify</span>
                </div>
            </div>
            <nav class="flex-1 p-4 overflow-y-auto">
                <ul class="space-y-2">
                    <li><a href="?url=dashboard/index" class="block py-2 px-4 rounded hover:bg-slate-700"><i
                                class="fas fa-tachometer-alt mr-2"></i>Dashboard</a></li>
                    <li><a href="?url=admin/daftarUser" class="block py-2 px-4 rounded hover:bg-slate-700"><i
                                class="fas fa-users mr-2"></i>Daftar User</a></li>
                    <li><a href="?url=admin/tambahUser" class="block py-2 px-4 rounded hover:bg-slate-700"><i
                                class="fas fa-user-plus mr-2"></i>Tambah User</a></li>
                    <li><a href="?url=parkir/area" class="block py-2 px-4 rounded hover:bg-slate-700"><i
                                class="fas fa-parking mr-2"></i>Area</a></li>
                    <li><a href="?url=parkir/tarif" class="block py-2 px-4 rounded hover:bg-slate-700"><i
                                class="fas fa-wrench mr-2"></i>Tarif</a></li>
                    <li><a href="?url=parkir/masuk" class="block py-2 px-4 rounded hover:bg-slate-700"><i
                                class="fas fa-car mr-2"></i>Parkir Masuk</a></li>
                    <li><a href="?url=parkir/riwayat" class="block py-2 px-4 rounded hover:bg-slate-700"><i
                                class="fas fa-history mr-2"></i>Riwayat</a></li>
                    <li><a href="?url=log/index" class="block py-2 px-4 rounded hover:bg-slate-700 bg-slate-700"><i
                                class="fas fa-list mr-2"></i>Log Aktivitas</a></li>
                </ul>
            </nav>
        </div>
        <!-- End of Sidebar -->

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <?php include VIEWS_PATH . '/partials/parkify/topbar.php'; ?>
            <!-- End of Header -->

            <!-- Content -->
            <main class="p-6 space-y-6 flex-1 overflow-y-auto">
                <!-- Activity Log Table -->
                <div class="bg-white p-6 rounded-lg shadow">
                    <h2 class="text-xl font-bold mb-6">Daftar Aktivitas Sistem</h2>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="border-b-2 border-gray-300">
                                <tr>
                                    <th class="pb-3 font-semibold text-gray-700">No</th>
                                    <th class="pb-3 font-semibold text-gray-700">Pengguna</th>
                                    <th class="pb-3 font-semibold text-gray-700">Aksi</th>
                                    <th class="pb-3 font-semibold text-gray-700">Deskripsi</th>
                                    <th class="pb-3 font-semibold text-gray-700">Waktu</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (isset($logs) && !empty($logs)): ?>
                                    <?php $no = 1;
                                    foreach ($logs as $row): ?>
                                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                                            <td class="py-3"><?= $no++ ?></td>
                                            <td class="py-3 font-semibold"><?= htmlspecialchars($row['username'] ?? 'System') ?>
                                            </td>
                                            <td class="py-3">
                                                <span
                                                    class="px-3 py-1 rounded-full text-xs font-bold bg-blue-100 text-blue-800">
                                                    <?= htmlspecialchars($row['aksi'] ?? 'Unknown') ?>
                                                </span>
                                            </td>
                                            <td class="py-3 text-sm text-gray-600">
                                                <?= htmlspecialchars($row['deskripsi'] ?? '-') ?>
                                            </td>
                                            <td class="py-3 text-sm text-gray-600">
                                                <?= htmlspecialchars($row['waktu'] ?? date('Y-m-d H:i:s')) ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="5" class="py-8 text-center text-gray-500">
                                            <i class="fas fa-inbox text-4xl mb-4 block text-gray-300"></i>
                                            Tidak ada data aktivitas
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

    <?php include VIEWS_PATH . '/partials/parkify/logout-modal.php'; ?>
    <?php include VIEWS_PATH . '/partials/parkify/menu-scripts.php'; ?>
</body>

</html>