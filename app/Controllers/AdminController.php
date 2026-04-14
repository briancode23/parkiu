<?php
class AdminController extends Controller {
    public function __construct() {
        AuthMiddleware::requireRole('admin');
    }

    public function daftarUser() {
        $userModel = $this->model('User');
        $areaModel = $this->model('Area');
        
        $data = [
            'title' => 'Daftar User',
            'data' => $userModel->getAll(),
            'totalUser' => $userModel->countAll(),
            'totalArea' => $areaModel->countArea()
        ];
        return $this->render('dashboard.admin.daftarUser', $data);
    }
    
    public function tambahArea() {
        return $this->render('dashboard.admin.area.tambahArea');
    }
    
    public function tambahTarif() {
        $parkirModel = $this->model('Parkir');
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $jenis = $_POST['jenis_kendaraan'];
            $tarif = $_POST['tarif_per_jam'];
            
            if (empty($jenis) || !is_numeric($tarif) || $tarif <= 0) {
                $error = 'Data tidak valid';
            } else {
                $parkirModel->addTarif($jenis, $tarif);
                AuthMiddleware::redirect('parkir/tarif');
            }
        }
        
        $data = [
            'title' => 'Tambah Tarif',
            'error' => $error ?? null
        ];
        return $this->render('parkir.tambahTarif', $data);
    }
    
    public function tambahUser() {
        $userModel = $this->model('User');
        $data = [
            'title' => 'Tambah User'
            ];
        return $this->render('dashboard.admin.user.tambahUser', $data);
    }
}