<?php
class LogController extends Controller {

    public function __construct() {
        AUthMiddleware::requireRole(['admin']);
    }

    public function index() {
        $log = $this->model('Log');
        $data = [
            'title' => 'Log Aktivitas',
            'data' => $log->getAll()
        ];
        return $this->render('dashboard.admin.log.aktivitas', $data);
    }

    public function exportPdf() {
        $logModel = $this->model('Log');
        $log = $logModel->getAll();

        require_once 'app/libraries/fpdf/fpdf.php';

        $pdf = new FPDF('P', 'mm', 'A4');
        $pdf->AddPage();

        // Judul
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(0, 10, 'LAPORAN LOG AKTIVITAS', 0, 1, 'C');
        $pdf->Ln(5);

        // Header tabel
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(10, 8, 'No', 1);
        $pdf->Cell(120, 8, 'Aktivitas', 1);
        $pdf->Cell(50, 8, 'Waktu', 1);
        $pdf->Ln();

        // Isi tabel
        $pdf->SetFont('Arial', '', 10);
        $no = 1;
        foreach ($log as $row) {
            $pdf->Cell(10, 8, $no++, 1);
            $pdf->Cell(120, 8, $row['aktivitas'], 1);
            $pdf->Cell(50, 8, $row['waktu_aktivitas'], 1);
            $pdf->Ln();
        }

        $pdf->Output('I', 'laporan-log-aktivitas');
        exit;
    }
}