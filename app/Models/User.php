<?php

class User extends Database
{
    public function findByUsername($username) {
        $sql = "SELECT * FROM tb_user
                WHERE username = ?
                AND status_aktif = 1
                LIMIT 1";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$username]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function usernameExists($username) {
        $sql = "SELECT 1 FROM tb_user WHERE username = ? LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$username]);

        return $stmt->fetchColumn();
    }

    public function getAll() {
        $stmt = $this->db->query(
            "SELECT id_user, nama_lengkap, username, role, status_aktif, created_at
             FROM tb_user"
        );

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countAll() {
        $stmt = $this->db->query("
        SELECT COUNT(*) as total FROM tb_user");
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    // nonaktifkan user
    public function deactivate($id) {
        $stmt = $this->db->prepare(
            "UPDATE tb_user SET status_aktif = 0 WHERE id_user = ?"
        );
        return $stmt->execute([$id]);
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT id_user, nama_lengkap, username, role, status_aktif FROM tb_user WHERE id_user = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function findByEmail($email) {
        $stmt = $this->db->prepare("SELECT * FROM tb_user WHERE email = ? AND status_aktif = 1");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $sql = "INSERT INTO tb_user
                (nama_lengkap, username, password, role, status_aktif)
                VALUES (?, ?, ?, ?, 1)";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            $data['nama'] ?? null,
            $data['username'] ?? null,
            $data['password'] ?? null,
            $data['role'] ?? 'petugas'
        ]);

        return $this->db->lastInsertId();
    }

    public function updateRememberToken($id, $token, $expire) {
        $stmt = $this->db->prepare("
        UPDATE tb_user
        SET remember_token = :token, remember_expire = :expire
        WHERE id_user = :id
    ");
        return $stmt->execute([
            ':token' => $token,
            ':expire' => $expire,
            ':id' => $id
        ]);
    }

    public function findByRememberToken($token) {
        $stmt = $this->db->prepare("
        SELECT * FROM tb_user
        WHERE remember_token = :token
    ");
        $stmt->execute([':token' => $token]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function clearRememberToken($id) {
        $stmt = $this->db->prepare("
        UPDATE tb_user
        SET remember_token = NULL, remember_expire = NULL
        WHERE id_user = :id
    ");
        return $stmt->execute([':id' => $id]);
    }

    public function storeRememberToken($id, $token) {
        $stmt = $this->db->prepare(
            "UPDATE tb_user SET remember_token = ? WHERE id_user = ?"
        );
        $stmt->execute([$token, $id]);
    }

    public function insertUser($data) {
        $sql = "INSERT INTO tb_user
                (nama_lengkap, username, password, role, status_aktif)
                VALUES (?, ?, ?, ?, 1)";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            $data['nama'] ?? null,
            $data['username'] ?? null,
            $data['password'] ?? null,
            $data['role'] ?? null
        ]);

        return $this->db->lastInsertId();
    }

    public function updateUser() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user = $this->model('User');
            $data = [
                'id' => $_POST['id'],
                'nama_lengkap' => $_POST['nama_lengkap'],
                'username' => $_POST['username'],
                'role' => $_POST['role'],
                'status_aktif' => $_POST['status_aktif']
            ];

            if ($user->updateUser($data)) {
                header('Location: admin/daftarUser/?success=User berhasil diupdate');
                exit; // Selalu gunakan exit setelah header location
            } else {
                header('Location: admin/daftarUser/?error=Gagal mengupdate user');
                exit;
            }
        }
    }
    
    public function delete($id) {
        try {
            $query = "DELETE FROM tb_user WHERE id_user = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        } catch (PDOException $e) {
            // Log kesalahan
            return false;
        }
    }


}