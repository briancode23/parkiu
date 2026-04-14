<?php

class AuthController extends Controller {

    public function login() {
        AuthMiddleware::requireLogout();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $username = trim($_POST['username'] ?? '');
            $password = $_POST['password'] ?? '';

            $userModel = $this->model('User');
            $user = $userModel->findByUsername($username);

            if ($user && password_verify($password, $user['password'])) {

                session_regenerate_id(true);

                $_SESSION['user'] = [
                    'id' => $user['id_user'],
                    'nama' => $user['nama_lengkap'],
                    'role' => $user['role']
                ];

                if (!empty($_POST['remember'])) {

                    $token = bin2hex(random_bytes(32));
                    $expire = date('Y-m-d H:i:s', time() + (86400 * 30)); // 30 hari

                    $userModel->updateRememberToken(
                        $user['id_user'],
                        password_hash($token, PASSWORD_DEFAULT),
                        $expire
                    );

                    setcookie(
                        'remember_token',
                        $token,
                        time() + (86400 * 30),
                        '/',
                        '',
                        false,
                        true
                    );
                }

                $this->logActivity($user['id_user'], 'Login ke sistem');
                $this->redirect('dashboard');
                return;
            }

            return $this->render('auth.login', [
                'error' => 'Username atau password salah'
            ]);
        }

        return $this->render('auth.login', []);
    }

    public function logout() {

        $user = $_SESSION['user']['id'] ?? null;

        if ($user) {
            $this->logActivity($user, 'Logout dari sistem');
        }

        setcookie('remember_token', '', time() - 3600, '/');
        $userModel = $this->model('User');
        $userModel->clearRememberToken($user);

        session_unset();
        session_destroy();

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }

        $this->redirect('/');
    }

    public function store() {

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('auth/register');
        }

        // ambil input
        $nama = trim($_POST['nama'] ?? '');
        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';
        $confirm = $_POST['confirm_password'] ?? '';
        $remember = isset($_POST['remember']);

        $errors = [];

        // ===== VALIDASI =====
        if ($nama === '') {
            $errors[] = 'Nama wajib diisi';
        }

        if ($username === '') {
            $errors[] = 'Username wajib diisi';
        }

        if (strlen($username) < 6) {
            $errors[] = 'Username minimal 6 karakter';
        }

        if (!preg_match("/^[a-zA-Z\s]+$/", $nama)) {
            $errors['nama'] = 'Nama hanya boleh huruf';
        }

        if (strlen($password) < 8) {
            $errors['password'] = 'Password minimal 8 karakter';
        }

        if ($password !== $confirm) {
            $errors[] = "Konfirmasi password tidak cocok";

        }

        $userModel = $this->model('User');

        if ($username && $userModel->usernameExists($username)) {
            $errors['username'] = 'Username sudah digunakan';
        }

        // ===== JIKA ADA ERROR =====
        if (!empty($errors)) {
            return $this->render('auth.register', ['errors' => implode('<br>', $errors)]);
        }

        // ===== SIMPAN =====
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $userId = $userModel->create([
            'nama' => $nama,
            'username' => $username,
            'password' => $hash,
            'role' => 'petugas'
        ]);

        if (!$userId) {
            return $this->render('auth.register', ['errors' => 'Gagal menyimpan user'
            ]);
        }

        $_SESSION['user'] = [
            'id' => $userId,
            'username' => $username,
            'role' => 'petugas'
        ];
        
        if ($remember) {
            $token = bin2hex(random_bytes(32));
            
            setcookie(
                'remember_token', $token, time() + (86400 * 30), '/', '',
                false,
                true
            );
            
            $userModel->storeRememberToken($userId, $token);
        }
        $this->redirect('dashboard');
        exit;
    }
    
    public function register() {
        return $this->render('auth.register');
        exit;
    }
}