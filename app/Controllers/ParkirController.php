<?php

class ParkirController extends Controller
{

    public function __construct()
    {
        AuthMiddleware::requireLogin();
        AuthMiddleware::requireRole(['petugas', 'admin']);
    }

    public function struk($id)
    {
        $parkirModel = $this->model('Parkir');
        $data = $parkirModel->getById($id);

        if (!$data) {
            return $this->render('errors.404');
        }

        require_once 'app/libraries/fpdf/fpdf.php';

        $pdf = new FPDF('P', 'mm', [80, 200]);
        $pdf->AddPage();

        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 8, 'STRUK PARKIR', 0, 1, 'C');
        $pdf->Ln(3);

        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(0, 5, 'No Parkir : ' . $data['id_parkir'], 0, 1);
        $pdf->Cell(0, 5, 'Plat      : ' . $data['plat_nomor'], 0, 1);
        $pdf->Cell(0, 5, 'Jenis     : ' . $data['jenis_kendaraan'], 0, 1);
        $pdf->Cell(0, 5, 'Area      : ' . $data['nama_area'], 0, 1);

        $pdf->Ln(2);
        $pdf->Cell(0, 5, 'Masuk     : ' . $data['waktu_masuk'], 0, 1);
        $pdf->Cell(0, 5, 'Keluar    : ' . $data['waktu_keluar'], 0, 1);
        $pdf->Cell(0, 5, 'Durasi    : ' . $data['durasi_jam'] . ' jam', 0, 1);

        $pdf->Ln(2);
        $pdf->Cell(0, 5, 'Tarif/Jam : Rp ' . number_format($data['tarif_per_jam']), 0, 1);
        $pdf->Cell(0, 5, 'Total    : Rp ' . number_format($data['biaya_total']), 0, 1);

        $pdf->Ln(3);
        $pdf->Cell(0, 5, 'Petugas  : ' . $data['nama_lengkap'], 0, 1);
        $pdf->Ln(5);

        $pdf->Cell(0, 5, 'Terima kasih', 0, 1, 'C');

        $pdf->Output('I', 'struk-parkir-' . $id . '.pdf');

        $this->logActivity($_SESSION['user']['id'], 'Cetak struk parkir ID ' . $id);
        exit;
    }

    public function strukMasuk($id)
    {
        $parkir = $this->model('Parkir')->getMasukById($id);

        if (!$parkir) {
            return $this->render('errors.404');
        }

        require_once 'app/libraries/fpdf/fpdf.php';

        $pdf = new FPDF('P', 'mm', [80, 180]);
        $pdf->AddPage();

        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 8, 'STRUK PARKIR MASUK', 0, 1, 'C');
        $pdf->Ln(3);

        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(0, 5, 'No Parkir : ' . $parkir['id_parkir'], 0, 1);
        $pdf->Cell(0, 5, 'Plat      : ' . $parkir['plat_nomor'], 0, 1);
        $pdf->Cell(0, 5, 'Jenis     : ' . $parkir['jenis_kendaraan'], 0, 1);
        $pdf->Cell(0, 5, 'Area      : ' . $parkir['nama_area'], 0, 1);

        $pdf->Ln(2);
        $pdf->Cell(0, 5, 'Masuk     : ' . $parkir['waktu_masuk'], 0, 1);
        $pdf->Cell(0, 5, 'Petugas   : ' . $parkir['nama_lengkap'], 0, 1);

        $pdf->Ln(5);
        $pdf->Cell(0, 5, 'Simpan struk ini', 0, 1, 'C');

        $this->logActivity($_SESSION['user']['id'], 'Cetak struk masuk ID ' . $id);

        $pdf->Output('I', 'struk-masuk-' . $id . '.pdf');
        exit;
    }

    public function strukKeluar($id)
    {
        $parkir = $this->model('Parkir')->getKeluarById($id);

        if (!$parkir) {
            return $this->view('errors.404');
        }

        require_once 'app/libraries/fpdf/fpdf.php';

        $pdf = new FPDF('P', 'mm', [80, 200]);
        $pdf->AddPage();

        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 8, 'STRUK PARKIR KELUAR', 0, 1, 'C');
        $pdf->Ln(3);

        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(0, 5, 'No Parkir   : ' . $parkir['id_parkir'], 0, 1);
        $pdf->Cell(0, 5, 'Plat           : ' . $parkir['plat_nomor'], 0, 1);
        $pdf->Cell(0, 5, 'Jenis         : ' . $parkir['jenis_kendaraan'], 0, 1);

        $pdf->Ln(2);
        $pdf->Cell(0, 5, 'Masuk       : ' . $parkir['waktu_masuk'], 0, 1);
        $pdf->Cell(0, 5, 'Keluar       : ' . $parkir['waktu_keluar'], 0, 1);
        $pdf->Cell(0, 5, 'Durasi       : ' . $parkir['durasi_jam'] . ' jam', 0, 1);

        $pdf->Ln(2);
        $pdf->Cell(0, 5, 'Tarif/Jam  : Rp ' . number_format($parkir['tarif_per_jam']), 0, 1);
        $pdf->Cell(0, 5, 'Total         : Rp ' . number_format($parkir['biaya_total']), 0, 1);

        $pdf->Ln(3);
        $pdf->Cell(0, 5, 'Petugas     : ' . $parkir['nama_lengkap'], 0, 1);

        $this->logActivity($_SESSION['user']['id'], 'Cetak struk keluar ID ' . $id);

        $pdf->Output('I', 'struk-keluar-' . $id . '.pdf');
        exit;
    }

    // LIST PARKIR AKTIF
    public function index()
    {
        $parkir = $this->model('Parkir')->getAktif();
        /*var_dump($parkir);
        die;*/

        return $this->render('parkir.index', [
            'title' => 'Parkir Aktif',
            'parkir' => $parkir,
            'roleText' => $this->getRoleText()
        ]);
    }

    // FORM MASUK
    public function masuk()
    {
        $parkirModel = $this->model('Parkir');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $data = [
                'plat_nomor' => $_POST['plat_nomor'],
                'jenis_kendaraan' => $_POST['jenis_kendaraan'],
                'warna' => $_POST['warna'],
                'pemilik' => $_POST['pemilik'],
                'id_user' => $_SESSION['user']['id'],
                'id_area' => $_POST['id_area']
            ];

            $id_parkir = $parkirModel->kendaraanMasukManual($data);
            $this->logActivity($_SESSION['user']['id'], 'Parkir keluar ID ' . $id);
            $this->redirect('?url=parkir/previewMasuk/' . $id_parkir);

            /*$this->redirect('?url=parkir/strukMasuk/'.$id_parkir);*/
        }

        return $this->render('parkir.parkirMasuk', [
            'title' => 'Kendaraan Masuk',
            'area' => $parkirModel->getArea(),
            'roleText' => $this->getRoleText()
        ]);
    }

    // PROSES KELUAR
    public function keluar($id)
    {
        $parkirModel = $this->model('Parkir');
        $data = $parkirModel->getMasukById($id);
        if (!$data) {
            return $this->render('errors/404');
        }
        $masuk = strtotime($data['waktu_masuk']);
        $keluar = time();

        $durasiJam = max(1, ceil(($keluar - $masuk) / 3600));
        $total = $durasiJam * $data['tarif_per_jam'];
        $parkirModel->updateKeluar(
            $id,
            date('Y-m-d H:i:s', $keluar),
            $durasiJam,
            $total
        );
        $this->logActivity($_SESSION['user']['id'], 'Parkir keluar ID ' . $id);
        $this->redirect('parkir/previewKeluar/' . $id);
    }

    public function laporan()
    {
        AuthMiddleware::requireRole(['owner']);

        $tanggal_awal = $_GET['tanggal_awal'] ?? date('Y-m-01');
        $tanggal_akhir = $_GET['tanggal_akhir'] ?? date('Y-m-d');

        // Query database untuk mendapatkan data laporan
        $data = $this->model('Parkir')->getLaporanParkir($tanggal_awal, $tanggal_akhir);

        return $this->render('parkir.laporan');
    }

    public function cetakLaporan() {
        AuthMiddleware::requireRole(['owner']);
        
        $tanggal_awal = $_GET['tanggal_awal'] ?? date('Y-m-01');
        $tanggal_akhir = $_GET['tanggal_akhir'] ?? date('Y-m-d');

        // Query database untuk mendapatkan data laporan
        $data = $this->model->getLaporanParkir($tanggal_awal, $tanggal_akhir);

        // Generate PDF atau cetak laporan
        // ...
    }

    public function previewMasuk($id)
    {
        $parkir = $this->model('Parkir')->getMasukById($id);

        if (!$parkir) {
            return $this->render('errors.404');
        }

        return $this->render('parkir.previewMasuk', [
            'title' => 'Preview Struk Masuk',
            'data' => $parkir
        ]);
    }

    public function previewKeluar($id)
    {
        $parkir = $this->model('Parkir')->getKeluarById($id);

        if (!$parkir) {
            return $this->render('errors.404');
        }

        return $this->render('parkir.previewKeluar', [
            'title' => 'Preview Struk Keluar',
            'data' => $parkir
        ]);
    }

    public function riwayat()
    {
        AuthMiddleware::requireRole(['admin', 'petugas']);
        $parkir = $this->model('Parkir')->getRiwayat();

        return $this->render('parkir.riwayatParkir', [
            'title' => 'Riwayat Parkir',
            'parkir' => $parkir,
            'roleText' => $this->getRoleText()
        ]);
    }

    // LIST TARIF
    public function tarif()
    {
        AuthMiddleware::requireRole(['admin']); // hanya admin

        $tarif = $this->model('Parkir')->getAllTarif();

        return $this->render('parkir.tarif', [
            'title' => 'Manajemen Tarif',
            'tarif' => $tarif
        ]);
    }

    // FORM EDIT TARIF
    public function editTarif($id)
    {
        AuthMiddleware::requireRole(['admin']);

        $model = $this->model('Parkir');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $tarifBaru = $_POST['tarif_per_jam'];

            if (!is_numeric($tarifBaru) || $tarifBaru <= 0) {
                die('Tarif tidak valid');
            }

            $model->updateTarif($id, $tarifBaru);

            $this->logActivity(
                $_SESSION['user']['id'],
                'Update tarif ID ' . $id . ' menjadi ' . $tarifBaru
            );

            $this->redirect('parkir/tarif');
        }

        $data = $model->getTarifById($id);

        if (!$data) {
            return $this->render('errors.404');
        }

        return $this->render('parkir.editTarif', [
            'title' => 'Edit Tarif',
            'data' => $data
        ]);
    }

    // LIST AREA
    public function area()
    {
        AuthMiddleware::requireRole(['admin']);

        $area = $this->model('Parkir')->getAllArea();

        return $this->render('dashboard.admin.area.daftarArea', [
            'title' => 'Manajemen Area Parkir',
            'area' => $area
        ]);
    }

    // EDIT AREA
    public function editArea($id)
    {
        $this->requireRole(['admin']);

        $model = $this->model('Parkir');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $nama = trim($_POST['nama_area']);
            $kapasitas = (int) $_POST['kapasitas'];
            $keterangan = (string) $_POST['keterangan'];

            if ($kapasitas <= 0) {
                die('Kapasitas tidak valid');
            }

            $areaLama = $model->getAreaById($id);

            if ($kapasitas < $areaLama['terisi']) {
                die('Kapasitas tidak boleh lebih kecil dari jumlah kendaraan yang sedang parkir');
            }

            $model->updateArea($id, $nama, $kapasitas, $keterangan);

            $this->logActivity(
                $_SESSION['user']['id'],
                'Update area ID ' . $id
            );

            $this->redirect('?url=parkir/area');
        }

        $data = $model->getAreaById($id);

        if (!$data) {
            $this->view('errors/404');
            return;
        }

        $this->view('dashboard/admin/area/editArea', [
            'title' => 'Edit Area Parkir',
            'data' => $data
        ]);
    }
}
