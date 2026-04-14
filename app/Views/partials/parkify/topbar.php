<?php
$profileName = htmlspecialchars($_SESSION['user']['nama'] ?? $_SESSION['user']['username'] ?? 'Admin', ENT_QUOTES, 'UTF-8');
$profilePhoto = APP_URL . 'assets/img/undraw_profile.svg';
if (!empty($_SESSION['user']['photo'])) {
    $photo = $_SESSION['user']['photo'];
    $profilePhoto = filter_var($photo, FILTER_VALIDATE_URL) ? $photo : APP_URL . ltrim($photo, '/');
} elseif (!empty($_SESSION['user']['avatar'])) {
    $avatar = $_SESSION['user']['avatar'];
    $profilePhoto = filter_var($avatar, FILTER_VALIDATE_URL) ? $avatar : APP_URL . ltrim($avatar, '/');
}
?>
<header class="bg-white shadow p-4 flex justify-between items-center">
    <h1 class="text-2xl font-bold"><?= htmlspecialchars($title ?? 'Dashboard', ENT_QUOTES, 'UTF-8') ?></h1>
    <div class="relative">
        <button id="userMenuBtn" type="button" onclick="toggleUserMenu()"
            class="flex items-center space-x-2 hover:text-blue-500 transition">
            <span class="text-sm font-semibold"><?= $profileName ?></span>
            <img src="<?= htmlspecialchars($profilePhoto, ENT_QUOTES, 'UTF-8') ?>"
                class="w-8 h-8 rounded-full bg-gray-200" alt="Profile">
        </button>
        <div id="userMenu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl z-50">
            <a href="<?= APP_URL ?>/profile/index" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-t-lg">
                <i class="fas fa-user mr-2"></i>Profile
            </a>
            <button onclick="openLogoutModal()" type="button"
                class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 border-t">
                <i class="fas fa-sign-out-alt mr-2"></i>Logout
            </button>
        </div>
    </div>
</header>