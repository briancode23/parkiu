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
            <a href="<?= APP_URL ?>/auth/logout"
                class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 font-semibold">
                Logout
            </a>
        </div>
    </div>
</div>