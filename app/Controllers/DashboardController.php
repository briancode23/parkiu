<?php
class DashboardController extends Controller
{

    public function __construct()
    {
        AuthMiddleware::requireLogin();

    }

    public function index()
    {
        $parkir = $this->model('Parkir');
        $user = $this->model('User');
        $area = $this->model('Area');

        $dataChart = $parkir->grafikHarian();
        // $data['slots'] = $parkir->getAllSlots();
        
        // $data['totalKapasitas'] = count($data['slots']);
       //  $data['slotTersedia'] = 0;
        
        /*foreach ($data['slots'] as $row) {
            if ($s['status'] == 'tersedia') $data['slotTersedia']++;
        }*/
        
        $data = [
            'totalKendaraan' => $parkir->countAktif(),
            'totalUser' => $user->countAll(),
            'hariIni' => $parkir->countHariIni(),
            'hariIniOut' => $parkir->countHariIniOut(),
            'totalArea' => $area->countArea(),
            'persentase' => $area->getAllArea(),
            // 'slots' => $data['slots'],
            'pendapatanBulanan' => $parkir->getPendapatanBulanan()
            // 'pendapatanTahunan' => $parkir->getPendapatanTahunan()
        ];

        $data['chartData'] = json_encode($dataChart);

        $role = $_SESSION['user']['role'];

        switch ($role) {
            case 'admin':
                return $this->render('dashboard.admin.index', $data, ['title' => 'Dashboard Admin']);
                break;

            case 'petugas':
                return $this->render('dashboard.petugas.index', $data, [
                    'title' => 'Dashboard Petugas'
                ]);
                break;

            case 'owner':
                return $this->render('dashboard.owner.index', $data, ['title' => 'Dashboard Owner']);
                break;

            default:
                return $this->render('errors.403');
        }
    }
}