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