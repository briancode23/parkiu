<?php
class Area extends Database
{
    public function percentArea($kapasitas, $terisi) {
        if ($kapasitas == 0) {
            return 0;
        }
        return round(($terisi / $kapasitas) * 100, 2);
    }


    public function getAllArea() {
        $sql = "SELECT id_area, nama_area, kapasitas, terisi, keterangan FROM tb_area_parkir WHERE is_active = 1";

        $stmt = $this->db->query($sql);

        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($data as &$row) {
            $row['persentase'] = $this->percentArea($row['kapasitas'], $row['terisi']);
        }

        return $data;

    }


    public function getAreaById($id) {
        $stmt = $this->db->prepare("SELECT * FROM tb_area_parkir WHERE id_area = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function countArea() {
        $sql = "SELECT COUNT(*) as totalArea FROM tb_area_parkir WHERE is_active = 1";
        $stmt = $this->db->query($sql);
        return $stmt->fetch(PDO::FETCH_ASSOC)['totalArea'];
    }

    public function tambahArea($data) {
        if (!isset($data['nama_area'], $data['kapasitas'])) {
            throw new Exception("Data area tidak lengkap!");
        }
        $sql = "SELECT * FROM tb_area_parkir WHERE nama_area = :nama";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':nama' => $data['nama_area']]);
        if ($stmt->rowCount() > 0) {
            throw new Exception("Nama area sudah ada!");
        }

        $sql = "INSERT INTO tb_area_parkir (nama_area, kapasitas, terisi, keterangan) VALUES (:nama, :kapasitas, 0, :keterangan)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':nama' => $data['nama_area'],
            ':kapasitas' => $data['kapasitas'],
            ':keterangan' => $data['keterangan'] ?? ''
        ]);
    }


    public function editArea($id, $data) {
        if (!isset($data['nama_area'], $data['kapasitas'])) {
            throw new Exception("Data tidak lengkap");
        }

        $area = $this->db->prepare("SELECT terisi FROM tb_area_parkir WHERE id_area = :id FOR UPDATE");

        $this->db->beginTransaction();

        try {
            $area->execute([':id' => $id]);
            $current = $area->fetch(PDO::FETCH_ASSOC);

            if (!$current) {
                throw new Exception("Area tidak ditemukan");
            }

            if ($data['kapasitas'] < $current['terisi']) {
                throw new Exception("Kapasitas lebih kecil dari kendaraan terisi");
            }

            $update = $this->db->prepare("
            UPDATE tb_area_parkir SET nama_area = :nama,
            kapasitas = :kapasitas
            WHERE id_area = :id");

            $update->execute([
                ':nama' => $data['nama_area'],
                ':kapasitas' => $data['kapasitas'],
                ':id' => $id
            ]);

            $this->db->commit();
            return true;
        } catch (Exception $e) {
            $this->db->rollBack();
            throw $e;
        }
    }

    public function delete($id_area) {
        try {
            $this->db->beginTransaction();

            // 1️⃣ Cek apakah masih ada transaksi aktif
            $cek = $this->db->prepare("
            SELECT COUNT(*) as total
            FROM tb_transaksi
            WHERE id_area = :id_area
            AND status = 'masuk'
        ");
            $cek->execute([':id_area' => $id_area]);
            $result = $cek->fetch(PDO::FETCH_ASSOC);

            if ($result['total'] > 0) {
                throw new Exception("Area parkir masih digunakan oleh kendaraan aktif");
            }

            // 2️⃣ Cek apakah terisi > 0
            $cekArea = $this->db->prepare("
            SELECT terisi
            FROM tb_area_parkir
            WHERE id_area = :id_area
        ");
            $cekArea->execute([':id_area' => $id_area]);
            $area = $cekArea->fetch(PDO::FETCH_ASSOC);

            if (!$area) {
                throw new Exception("Area tidak ditemukan");
            }

            if ($area['terisi'] > 0) {
                throw new Exception("Area masih memiliki kendaraan");
            }

            // 3️⃣ Hapus
            $stmt = $this->db->prepare("
            UPDATE tb_area_parkir
            SET is_active = 0
            WHERE id_area = :id_area
        ");
            $stmt->execute([':id_area' => $id_area]);
            $this->db->commit();
            return true;

        } catch (Exception $e) {
            $this->db->rollBack();
            throw $e;
        }
    }
}