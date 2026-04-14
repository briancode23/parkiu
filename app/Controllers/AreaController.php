<?php
class AreaController extends Controller {

    public function __construct() {
        AuthMiddleware::requireRole(['admin']);
    }

    public function store() {
    $areaModel = $this->model('Area');
    $data = $_POST;
    $userId = $_SESSION['user']['id'] ?? null;

    $errors = $this->validateArea($data);
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        $_SESSION['old'] = $data;
        AuthMiddleware::redirect('/parkir/tambahArea');
        return;
    }

    if ($areaModel->tambahArea($data)) {
        $this->logActivity($userId, "Menambahkan area parkir: " . $data['nama_area']);
        $_SESSION['success'] = "Area parkir berhasil ditambahkan";
        AuthMiddleware::redirect('/parkir/area');
    } else {
        $_SESSION['error'] = "Gagal menambahkan area parkir";
        AuthMiddleware::redirect('/parkir/tambahArea');
    }
}

private function validateArea($data) {
    $errors = [];

    if (empty($data['nama_area'])) {
        $errors['nama_area'] = "Nama area tidak boleh kosong";
    } elseif (strlen($data['nama_area']) > 50) {
        $errors['nama_area'] = "Nama area tidak boleh lebih dari 50 karakter";
    }

    if (empty($data['kapasitas'])) {
        $errors['kapasitas'] = "Kapasitas tidak boleh kosong";
    } elseif (!is_numeric($data['kapasitas']) || $data['kapasitas'] <= 0) {
        $errors['kapasitas'] = "Kapasitas harus berupa angka positif";
    }

    if (!empty($data['keterangan']) && strlen($data['keterangan']) > 255) {
        $errors['keterangan'] = "Keterangan tidak boleh lebih dari 255 karakter";
    }

    return $errors;
}


    public function update($id) {
        $areaModel = $this->model('Area');
        $data = $_POST;
        $userId = $_SESSION['user']['id'] ?? null;
        if ($areaModel->editArea($id, $data)) {
            $this->logActivity($userId, "Mengubah area parkir ID $id");
            AuthMiddleware::redirect('/parkir/area');
        } else {
            $_SESSION['error'] = "Gagal mengedit area parkir";
            AuthMiddleware::redirect('/parkir/area');
        }
    }

    public function delete($id_area) {
        try {
            $areaModel = $this->model('Area');
            $areaModel->delete($id_area);

            $_SESSION['success'] = "Area berhasil dihapus";
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
        }

        AuthMiddleware::redirect('/parkir/area');
        exit;
    }

}