<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Parkify - Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-slate-900 to-slate-700 flex items-center justify-center min-h-screen">
    <div class="w-full max-w-md">
        <!-- Card Container -->
        <div class="bg-white p-8 rounded-xl shadow-2xl">
            <!-- Logo & Title -->
            <div class="text-center mb-8">
                <div class="flex justify-center mb-4">
                    <div class="bg-blue-500 rounded-full p-4">
                        <i class="fas fa-parking text-white text-3xl"></i>
                    </div>
                </div>
                <h1 class="text-3xl font-bold text-slate-900 mb-2">Parkify</h1>
                <p class="text-gray-600">Sistem Manajemen Parkir Cerdas</p>
            </div>

            <!-- Error Message -->
            <?php if (!empty($error)): ?>
                <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded">
                    <p class="text-red-700 font-semibold"><?= htmlspecialchars($error) ?></p>
                </div>
            <?php endif; ?>

            <!-- Login Form -->
            <form action="<?= APP_URL ?>/auth/login" method="POST" class="space-y-4">
                <div>
                    <label for="username" class="block text-sm font-semibold text-gray-700 mb-2">Username</label>
                    <input type="text" id="username" name="username" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Masukkan username" required>
                </div>

                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
                    <input type="password" id="password" name="password" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Masukkan password" required>
                </div>

                <div class="flex items-center">
                    <input type="checkbox" id="remember" name="remember" class="w-4 h-4 text-blue-500 rounded focus:ring-blue-500">
                    <label for="remember" class="ml-2 text-sm text-gray-700">Ingat saya</label>
                </div>

                <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 rounded-lg transition duration-200">
                    <i class="fas fa-sign-in-alt mr-2"></i>Login
                </button>
            </form>

            <!-- Divider -->
            <div class="my-6 flex items-center">
                <div class="flex-1 border-t border-gray-300"></div>
                <span class="px-3 text-gray-500 text-sm">atau</span>
                <div class="flex-1 border-t border-gray-300"></div>
            </div>

            <!-- Links -->
            <div class="space-y-2 text-center">
                <p class="text-gray-600">
                    <a href="<?= APP_URL ?>/auth/forgotPassword" class="text-blue-500 hover:text-blue-600 font-semibold">Lupa password?</a>
                </p>
                <p class="text-gray-600">
                    Belum punya akun?
                    <a href="<?= APP_URL ?>/auth/store" class="text-blue-500 hover:text-blue-600 font-semibold">Daftar di sini</a>
                </p>
            </div>
        </div>

        <!-- Footer -->
        <div class="text-center mt-8 text-gray-400 text-sm">
            <p>© 2026 Parkify. All rights reserved.</p>
        </div>
    </div>
</body>
</html>