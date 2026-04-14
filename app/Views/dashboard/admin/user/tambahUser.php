<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Parkify - Tambah User</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <div class="flex h-screen">
        <?php include VIEWS_PATH . '/partials/parkify/sidebar.php'; ?>

        <div class="flex-1 flex flex-col">
            <?php include VIEWS_PATH . '/partials/parkify/topbar.php'; ?>

            <!-- Content -->
            <main class="p-6 space-y-6 flex-1 overflow-y-auto">
                <!-- Add User Form -->
                <div class="bg-white p-6 rounded-lg shadow max-w-2xl">
                    <?php if (!empty($errors)): ?>
                        <div class="mb-4 p-4 bg-red-50 border-l-4 border-red-500 rounded">
                            <p class="text-red-700 font-semibold"><?= htmlspecialchars($errors) ?></p>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($error)): ?>
                        <div class="mb-4 p-4 bg-red-50 border-l-4 border-red-500 rounded">
                            <p class="text-red-700 font-semibold"><?= htmlspecialchars($error) ?></p>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="/user/store" class="space-y-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                            <input type="text" name="nama"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                required>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Username</label>
                            <input type="text" name="username"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                required>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
                            <input type="password" name="password"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                required>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Konfirmasi Password</label>
                            <input type="password" name="confirm_password"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                required>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Role</label>
                            <select name="role"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                required>
                                <option value="">-- Pilih Role --</option>
                                <option value="admin">Admin</option>
                                <option value="petugas">Petugas</option>
                                <option value="owner">Owner</option>
                            </select>
                        </div>

                        <div class="pt-4 space-x-3 flex">
                            <button type="submit"
                                class="inline-block bg-emerald-500 hover:bg-emerald-600 text-white px-6 py-2 rounded-lg font-semibold transition">
                                <i class="fas fa-plus mr-2"></i>Tambah User
                            </button>
                            <a href="/admin/daftarUser"
                                class="inline-block bg-gray-400 hover:bg-gray-500 text-white px-6 py-2 rounded-lg font-semibold transition">
                                <i class="fas fa-times mr-2"></i>Batal
                            </a>
                        </div>
                    </form>
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

    <?php include VIEWS_PATH . '/partials/parkify/menu-scripts.php'; ?>

</body>

</html>