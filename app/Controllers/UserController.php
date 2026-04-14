<?php

class UserController extends Controller
{
    public function __construct() {
        AuthMiddleware::requireRole(['admin']);
    }

    public function index() {
        $userModel = $this->model('User');
        $users = $userModel->getAll();

        return $this->render('user.index', [
            'users' => $users
        ]);
    }

    public function store() {
		$userModel = $this->model('User');
        $areaModel = $this->model('Area');
        
        
        $data = [
        	'title' => 'Daftar User',
            'data' => $userModel->getAll(),
            'totalUser' => $userModel->countAll(),
            'totalArea' => $areaModel->countArea()
        ];

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            AuthMiddleware::redirect('admin/tambahUser', $data);
        }

        // ambil input
        $nama = trim($_POST['nama'] ?? '');
        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';
        $confirm = $_POST['confirm_password'] ?? '';
        $role = $_POST['role'] ?? '';

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

        if ($role === '') {
            $errors[] = 'Role wajib diisi';
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
            $userModel = $this->model('User');
        	$areaModel = $this->model('Area');
        
        
        	$data = [
        		'title' => 'Daftar User',
            	'data' => $userModel->getAll(),
            	'totalUser' => $userModel->countAll(),
            	'totalArea' => $areaModel->countArea(),
                'errors' => implode('<br>', $errors)
        	];
            return $this->render('dashboard.admin.user.tambahUser', $data);
            return;
        }

        // ===== SIMPAN =====
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $userId = $userModel->insertUser([
            'nama' => $nama,
            'username' => $username,
            'password' => $hash,
            'role' => $role
        ]);

        if (!$userId) {
            return $this->render('dashboard.admin.user.tambahUser', [
                'errors' => 'Gagal menyimpan user'
            ]);
            return;
        }
        if ($userId) {
            $data = [
                'title' => 'Daftar User',
                'data' => $userModel->getAll(),
                'success' => 'Berhasil menyimpan user',
            ];
            return $this->render('dashboard.admin.daftarUser', $data);
            return;
        }
    }
    
    public function delete($id) {
        $userModel = $this->model('User');
        $areaModel = $this->model('Area');
        
        // Cek jika user mencoba hapus dirinya sendiri
        if ($id == $_SESSION['user']['id']) {
            $data = [
                'title' => 'Daftar User',
                'data' => $userModel->getAll(),
                'totalUser' => $userModel->countAll(),
                'totalArea' => $areaModel->countArea(),
                'success' => 'User tersebut adalah anda!',
            ];
            
            return $this->render('dashboard.admin.daftarUser', $data);
        }

        if ($userModel->delete($id)) {
            $data = [
                'title' => 'Daftar User',
                'data' => $userModel->getAll(),
                'totalUser' => $userModel->countAll(),
                'totalArea' => $areaModel->countArea(),
                'success' => 'User berhasil dihapus',
            ];
            return $this->render('dashboard.admin.daftarUser', $data);
        } else {
            $data = [
                'title' => 'Daftar User',
                'data' => $userModel->getAll(),
                'totalUser' => $userModel->countAll(),
                'totalArea' => $areaModel->countArea(),
                'error' => 'Gagal menghapus user',
            ];
            return $this->render('dashboard.admin.daftarUser', $data);
        }
    }
    
    public function edit($id) {
        $userModel = $this->model('User');
        $data = $userModel->getById($id);

        if (!$data) {
            $areaModel = $this->model('Area');
            $errorData = [
                'title' => 'Daftar User',
                'data' => $userModel->getAll(),
                'totalUser' => $userModel->countAll(),
                'totalArea' => $areaModel->countArea(),
                'error' => 'User tidak ditemukan',
            ];
            return $this->render('dashboard.admin.daftarUser', $errorData);
        }

        return $this->render('dashboard.admin.user.editUser', $data);
    }

    public function update() {
        $userModel = $this->model('User');
        $areaModel = $this->model('Area');
        $data = [
            'id' => $_POST['id'],
            'nama_lengkap' => $_POST['nama_lengkap'],
            'username' => $_POST['username'],
            'role' => $_POST['role'],
            'status_aktif' => $_POST['status_aktif']
        ];
        if ($userModel->updateUser($data)) {
            $responseData = [
                'title' => 'Daftar User',
                'data' => $userModel->getAll(),
                'totalUser' => $userModel->countAll(),
                'totalArea' => $areaModel->countArea(),
                'success' => 'User berhasil diupdate',
            ];
            return $this->render('dashboard.admin.daftarUser', $responseData);
        } else {
            $responseData = [
                'title' => 'Daftar User',
                'data' => $userModel->getAll(),
                'totalUser' => $userModel->countAll(),
                'totalArea' => $areaModel->countArea(),
                'error' => 'Gagal mengupdate user',
            ];
            return $this->render('dashboard.admin.daftarUser', $responseData);
        }
    }


}