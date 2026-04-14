<?php

class Log extends Database {

    public function add($id_user, $aktivitas) {

        $ownTransaction = false;

        try {
            // Kalau belum ada transaksi -> mulai sendiri
            if (!$this->db->inTransaction()) {
                $this->db->beginTransaction();
                $ownTransaction = true;
            }

            $sql = "INSERT INTO tb_log_aktivitas 
                    (id_user, aktivitas, waktu_aktivitas)
                    VALUES (:id_user, :aktivitas, NOW())";

            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':id_user'   => $id_user,
                ':aktivitas' => $aktivitas
            ]);

            // Commit hanya jika kita yg mulai transaksi
            if ($ownTransaction) {
                $this->db->commit();
            }

            return true;

        } catch (Exception $e) {

            if ($ownTransaction && $this->db->inTransaction()) {
                $this->db->rollBack();
            }

            // Biar caller bisa handle
            throw $e;
        }
    }


    public function getAll($limit = 100)
    {
        $sql = "SELECT l.*, u.nama_lengkap
                FROM tb_log_aktivitas l
                JOIN tb_user u ON l.id_user = u.id_user
                ORDER BY waktu_aktivitas DESC
                LIMIT :limit";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
