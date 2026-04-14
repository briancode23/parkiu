<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Parkify - <?= $title ?? 'Log Aktivitas' ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Menggunakan Sidebar dari file pertama -->
        <?php include VIEWS_PATH . '/partials/parkify/sidebar.php'; ?>

        <div class="flex-1 flex flex-col">
            <!-- Menggunakan Topbar dari file pertama agar konsisten -->
            <?php include VIEWS_PATH . '/partials/parkify/topbar.php'; ?>

            <main class="p-6 space-y-6 flex-1 overflow-y-auto">
                
                <!-- Activity Table Card -->
                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-bold text-slate-900">Log Aktivitas</h2>
                        <!-- Tombol opsional jika ingin refresh atau export -->
                        <button onclick="location.reload()" class="text-gray-500 hover:text-blue-500 transition">
                            <i class="fas fa-sync-alt"></i>
                        </button>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="border-b-2 border-gray-300">
                                <tr>
                                    <th class="pb-3 font-semibold text-gray-700">No</th>
                                    <th class="pb-3 font-semibold text-gray-700">User</th>
                                    <th class="pb-3 font-semibold text-gray-700">Aktivitas</th>
                                    <th class="pb-3 font-semibold text-gray-700">Waktu</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (isset($data) && !empty($data)): ?>
                                    <?php $no = 1; foreach ($data as $row): ?>
                                    <tr class="border-b border-gray-200 hover:bg-gray-50">
                                        <td class="py-3"><?= $no++ ?></td>
                                        <td class="py-3 font-semibold text-gray-800">
                                            <?= htmlspecialchars($row['nama_lengkap'] ?? 'Unknown') ?>
                                        </td>
                                        <td class="py-3 text-gray-700">
                                            <span class="bg-blue-50 text-blue-700 px-2 py-1 rounded text-xs border border-blue-100">
                                                <?= htmlspecialchars($row['aktivitas'] ?? '-') ?>
                                            </span>
                                        </td>
                                        <td class="py-3 text-sm text-gray-600">
                                            <i class="far fa-clock mr-1 text-gray-400"></i>
                                            <?= isset($row['waktu_aktivitas']) ? date('d/m/Y H:i', strtotime($row['waktu_aktivitas'])) : '-' ?>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="4" class="py-12 text-center text-gray-500">
                                            <i class="fas fa-history text-4xl mb-4 block text-gray-300"></i>
                                            Belum ada catatan aktivitas.
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

    <!-- Script & Modal dari file pertama -->
    <?php include VIEWS_PATH . '/partials/parkify/logout-modal.php'; ?>
    
    <script>
        // Script dropdown & modal disamakan dengan file pertama
        function toggleUserMenu() {
            document.getElementById('userMenu')?.classList.toggle('hidden');
        }

        function openLogoutModal() {
            document.getElementById('logoutModal')?.classList.remove('hidden');
        }

        function closeLogoutModal() {
            document.getElementById('logoutModal')?.classList.add('hidden');
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function (e) {
            const menu = document.getElementById('userMenu');
            const btn = document.getElementById('userMenuBtn');
            if (menu && btn && !menu.contains(e.target) && !btn.contains(e.target)) {
                menu.classList.add('hidden');
            }
        });
    </script>
</body>
</html>
