<?php

class Parkir extends Database
{

    public function kendaraanMasuk($data) {
        $required = [
            'id_kendaraan',
            'id_tarif',
            'id_user',
            'id_area'
        ];

        foreach ($required as $field) {
            if (!isset($data[$field])) {
                throw new Exception("Field $field wajib diisi");
            }
        }

        try {
            $this->db->beginTransaction();

            $check = $this->db->prepare("
            SELECT COUNT(*) FROM tb_transaksi WHERE id_kendaraan = :kendaraan AND status = 'masuk' FOR UPDATE");

            $check->execute([
                ':kendaraan' => $data['id_kendaraan']
            ]);

            if ($check->fetchColumn() > 0) {
                throw new Exception("Kendaraan masih tercatat parkir (belum keluar)");
            }

            $area = $this->db->prepare("
            SELECT kapasitas, terisi FROM tb_area_parkir WHERE id_area = :area FOR UPDATE");

            $area->execute([
                ':area' => $data['id_area']
            ]);

            $areaData = $area->fetch(PDO::FETCH_ASSOC);

            if (!$areaData) {
                throw new Exception("Area tidak ditemukan");
            }

            if ($areaData['terisi'] >= $areaData['kapasitas']) {
                throw new Exception("Area parkir penuh");
            }

            $sqlInsert = "INSERT INTO tb_transaksi
                (id_kendaraan, waktu_masuk, id_tarif, durasi_jam, biaya_total, status, id_user, id_area)
                VALUES
                (:id_kendaraan, NOW(), :id_tarif, 0, 0, 'masuk', :id_user, :id_area)";

            $insert = $this->db->prepare($sqlInsert);

            $insert->execute([
                ':id_kendaraan' => $data['id_kendaraan'],
                ':id_tarif' => $data['id_tarif'],
                ':id_user' => $data['id_user'],
                ':id_area' => $data['id_area']
            ]);

            $sqlUpdate = "UPDATE tb_area_parkir SET terisi = terisi + 1 WHERE id_area = :area";

            $update = $this->db->prepare($sqlUpdate);

            $update->execute([
                ':area' => $data['id_area']
            ]);

            $this->db->commit();

            return $this->db->lastInsertId();
        } catch (Exception $e) {

            $this->db->rollBack();
            throw $e;
        }
    }

    public function kendaraanMasukManual($data) {
        try {
            $this->db->beginTransaction();

            // 1️⃣ Cek kendaraan berdasarkan plat
            $stmt = $this->db->prepare("
            SELECT id_kendaraan
            FROM tb_kendaraan
            WHERE plat_nomor = :plat
            LIMIT 1
        ");
            $stmt->execute([':plat' => $data['plat_nomor']]);
            $kendaraan = $stmt->fetch(PDO::FETCH_ASSOC);

            if (empty($data['plat_nomor']) || empty($data['jenis_kendaraan']) || empty($data['id_user']) || empty($data['id_area'])) {
                throw new Exception("Semua field wajib diisi");
            }

            if ($kendaraan) {
                $idKendaraan = $kendaraan['id_kendaraan'];


                $check = $this->db->prepare("
                SELECT COUNT(*) FROM tb_transaksi
                WHERE id_kendaraan = :id AND status = 'masuk'
                ");

                $check->execute([':id' => $idKendaraan]);

                if ($check->fetchColumn() > 0) {
                    throw new Exception("Kendaraan masih parkir (belum keluar)");
                }
            } else {
                // Insert kendaraan baru
                $insertK = $this->db->prepare("
                INSERT INTO tb_kendaraan
                (plat_nomor, jenis_kendaraan, warna, pemilik, id_user)
                VALUES
                (:plat, :jenis, :warna, :pemilik, :user)
            ");

                $insertK->execute([
                    ':plat' => $data['plat_nomor'],
                    ':jenis' => $data['jenis_kendaraan'],
                    ':warna' => $data['warna'],
                    ':pemilik' => $data['pemilik'],
                    ':user' => $data['id_user']
                ]);

                $idKendaraan = $this->db->lastInsertId();
            }

            // 2️⃣ Ambil tarif otomatis
            $tarif = $this->db->prepare("
            SELECT id_tarif
            FROM tb_tarif
            WHERE jenis_kendaraan = :jenis
            LIMIT 1
        ");
            $tarif->execute([':jenis' => $data['jenis_kendaraan']]);
            $tarifData = $tarif->fetch(PDO::FETCH_ASSOC);

            if (!$tarifData) {
                throw new Exception("Tarif tidak ditemukan");
            }

            // 3️⃣ Insert transaksi
            $insertT = $this->db->prepare("
            INSERT INTO tb_transaksi
            (id_kendaraan, waktu_masuk, id_tarif, durasi_jam, biaya_total, status, id_user, id_area)
            VALUES
            (:kendaraan, NOW(), :tarif, 0, 0, 'masuk', :user, :area)
        ");

            $insertT->execute([
                ':kendaraan' => $idKendaraan,
                ':tarif' => $tarifData['id_tarif'],
                ':user' => $data['id_user'],
                ':area' => $data['id_area']
            ]);

            $idParkir = $this->db->lastInsertId();

            // 4️⃣ Update area
            $updateArea = $this->db->prepare("
            UPDATE tb_area_parkir
            SET terisi = terisi + 1
            WHERE id_area = :area
            AND terisi < kapasitas
        ");

            $updateArea->execute([':area' => $data['id_area']]);

            if ($updateArea->rowCount() == 0) {
                throw new Exception("Area parkir sudah penuh");
            }

            $this->db->commit();
            return $idParkir;
        } catch (Exception $e) {
            $this->db->rollBack();
            throw $e;
        }
    }

    public function getAktif() {
        $sql = "SELECT t.*, k.plat_nomor, a.nama_area, k.jenis_kendaraan
                FROM tb_transaksi t
                JOIN tb_kendaraan k ON t.id_kendaraan = k.id_kendaraan
                JOIN tb_area_parkir a ON t.id_area = a.id_area
                WHERE t.status = 'masuk'
                ORDER BY waktu_masuk DESC;";

        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countAktif() {
        $stmt = $this->db->query("
        SELECT COUNT(*) as total FROM tb_transaksi WHERE status='masuk'");
        return $stmt->fetch()['total'];
    }

    public function countHariIni() {
        $query = "SELECT COUNT(*) AS total FROM tb_transaksi WHERE DATE(waktu_masuk) = CURDATE()";

        $stmt = $this->db->prepare($query);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    public function countHariIniOut() {
        $query = "SELECT COUNT(*) AS total FROM tb_transaksi WHERE DATE(waktu_keluar) = CURDATE()";

        $stmt = $this->db->prepare($query);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    public function getById($id) {
        $sql = "SELECT t.*,
                       k.plat_nomor, k.jenis_kendaraan,
                       u.nama_lengkap,
                       tr.tarif_per_jam,
                       a.nama_area
                FROM tb_transaksi t
                JOIN tb_kendaraan k ON t.id_kendaraan = k.id_kendaraan
                JOIN tb_user u ON t.id_user = u.id_user
                JOIN tb_tarif tr ON t.id_tarif = tr.id_tarif
                JOIN tb_area_parkir a ON t.id_area = a.id_area
                WHERE t.id_parkir = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getMasukById($id) {
        $sql = "SELECT t.*, k.plat_nomor, k.jenis_kendaraan,
                       u.nama_lengkap, a.nama_area, tr.tarif_per_jam
                FROM tb_transaksi t
                JOIN tb_kendaraan k ON t.id_kendaraan = k.id_kendaraan
                JOIN tb_user u ON t.id_user = u.id_user
                JOIN tb_area_parkir a ON t.id_area = a.id_area
                JOIN tb_tarif tr ON t.id_tarif = tr.id_tarif
                WHERE t.id_parkir = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getKeluarById($id) {
        $sql = "SELECT t.*, k.plat_nomor, k.jenis_kendaraan,
                       u.nama_lengkap, a.nama_area,
                       tr.tarif_per_jam
                FROM tb_transaksi t
                JOIN tb_kendaraan k ON t.id_kendaraan = k.id_kendaraan
                JOIN tb_user u ON t.id_user = u.id_user
                JOIN tb_area_parkir a ON t.id_area = a.id_area
                JOIN tb_tarif tr ON t.id_tarif = tr.id_tarif
                WHERE t.id_parkir = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateKeluar($id, $waktuKeluar, $durasi, $total) {
        try {
            $this->db->beginTransaction();

            // Update transaksi
            $sql = "UPDATE tb_transaksi SET waktu_keluar = :keluar, durasi_jam = :durasi, biaya_total = :total, status = 'keluar' WHERE id_parkir = :id AND status = 'masuk'";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':keluar' => $waktuKeluar,
                ':durasi' => $durasi,
                ':total' => $total,
                ':id' => $id
            ]);

            // Kurangi terisi di tb_area_parkir
            $sql = "UPDATE tb_area_parkir SET terisi = GREATEST(terisi - 1, 0) WHERE id_area = (SELECT id_area FROM tb_transaksi WHERE id_parkir = :id)";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':id' => $id]);

            if ($stmt->rowCount() == 0) {
                throw new Exception("Transaksi tidak ditemukan atau sudah keluar");
            }

            $this->db->commit();
        } catch (Exception $e) {
            $this->db->rollBack();
            throw $e;
        }
    }


    public function grafikHarian() {
        $stmt = $this->db->query("
        SELECT DATE(waktu_masuk) as tgl, COUNT(*) as total
        FROM tb_transaksi
        WHERE waktu_masuk >= CURDATE() - INTERVAL 30 DAY
        GROUP BY DATE(waktu_masuk)
        ORDER BY tgl ASC
    ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getKendaraan() {
        return $this->db->query("
        SELECT id_kendaraan, plat_nomor
        FROM tb_kendaraan
        ORDER BY plat_nomor
    ")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTarif() {
        return $this->db->query("
        SELECT id_tarif, tarif_per_jam
        FROM tb_tarif
    ")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getArea() {
        return $this->db->query("
        SELECT id_area, nama_area, kapasitas, terisi
        FROM tb_area_parkir WHERE is_active = 1
    ")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function tambahKendaraan($data) {
        $sql = "INSERT INTO tb_kendaraan
            (plat_nomor, jenis_kendaraan, warna, pemilik)
            VALUES
            (:plat, :jenis, :warna, :pemilik)";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':plat' => $data['plat_nomor'],
            ':jenis' => $data['jenis_kendaraan'],
            ':warna' => $data['warna'],
            ':pemilik' => $data['pemilik']
        ]);

        return $this->db->lastInsertId(); // 🔥 INI PENTING
    }

    public function getTarifByJenis($jenis) {
        $stmt = $this->db->prepare("
        SELECT id_tarif
        FROM tb_tarif
        WHERE jenis_kendaraan = :jenis
        LIMIT 1
    ");

        $stmt->execute([
            ':jenis' => $jenis
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getRiwayat() {
        $stmt = $this->db->prepare("
        SELECT t.*,
               k.plat_nomor,
               k.jenis_kendaraan,
               a.nama_area,
               u.nama_lengkap,
               tf.tarif_per_jam
        FROM tb_transaksi t
        JOIN tb_kendaraan k ON t.id_kendaraan = k.id_kendaraan
        JOIN tb_area_parkir a ON t.id_area = a.id_area
        JOIN tb_user u ON t.id_user = u.id_user
        JOIN tb_tarif tf ON t.id_tarif = tf.id_tarif
        WHERE t.status = 'keluar'
        ORDER BY t.waktu_keluar DESC
    ");

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Ambil semua tarif
    public function getAllTarif() {
        $stmt = $this->db->prepare("
        SELECT * FROM tb_tarif
        ORDER BY id_tarif ASC
    ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Ambil tarif berdasarkan ID
    public function getTarifById($id) {
        $stmt = $this->db->prepare("
        SELECT * FROM tb_tarif
        WHERE id_tarif = :id
        LIMIT 1
    ");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update tarif
    public function updateTarif($id, $tarif) {
        $stmt = $this->db->prepare("
        UPDATE tb_tarif
        SET tarif_per_jam = :tarif
        WHERE id_tarif = :id
    ");
        return $stmt->execute([
            ':tarif' => $tarif,
            ':id' => $id
        ]);
    }

    // Ambil semua area
    public function getAllArea() {
        $stmt = $this->db->prepare("
        SELECT * FROM tb_area_parkir
        WHERE is_active = 1
        ORDER BY id_area ASC
    ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Ambil area by ID
    public function getAreaById($id) {
        $stmt = $this->db->prepare("
        SELECT * FROM tb_area_parkir
        WHERE id_area = :id
        LIMIT 1
    ");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update area
    public function updateArea($id, $nama, $kapasitas, $keterangan) {
        $stmt = $this->db->prepare("
        UPDATE tb_area_parkir
        SET nama_area = :nama,
            kapasitas = :kapasitas,
            keterangan = :keterangan
        WHERE id_area = :id
    ");
        return $stmt->execute([
            ':nama' => $nama,
            ':kapasitas' => $kapasitas,
            ':keterangan' => $keterangan,
            ':id' => $id
        ]);
    }

    public function getPendapatanBulanan() {
        return $this->db->query("
        SELECT COALESCE(SUM(biaya_total),0) AS total
        FROM tb_transaksi
        WHERE status = 'keluar'
        AND MONTH(waktu_keluar) = MONTH(CURRENT_DATE())
        AND YEAR(waktu_keluar) = YEAR(CURRENT_DATE());")->fetch()['total'];
    }
    
    public function addTarif($jenis, $tarif) {
        $stmt = $this->db->prepare("
        INSERT INTO tb_tarif (jenis_kendaraan, tarif_per_jam)
        VALUES (:jenis, :tarif)
    ");
        return $stmt->execute([
            ':jenis' => $jenis,
            ':tarif' => $tarif
        ]);
    }

    public function getPendapatanTahunan() {}

    /*public function getAllSlots() {
    $query = "SELECT *
              FROM tb_area_parkir
              WHERE m.is_active = 1
              ORDER BY nama_area ASC, nama_slot ASC";
    $stmt = $this->db->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}*/



}