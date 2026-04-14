<?php
class Database
{
    protected $db;
    private static $instance = null;

    /**
     * Constructor
     */
    public function __construct()
    {
        try {
            $this->db = new PDO(
                "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET,
                DB_USER,
                DB_PASS,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ]
            );
        } catch (PDOException $e) {
            error_log($e->getMessage(), 3, "/var/log/app/db_error.log");
            die('Maaf, terjadi kesalahan teknis. Tim kami sedang memperbaikinya');
        }
    }

    /**
     * Get singleton instance
     */
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Get raw PDO connection
     */
    public function getConnection()
    {
        return $this->db;
    }

    /**
     * Prepare statement
     */
    public function prepare($sql)
    {
        return $this->db->prepare($sql);
    }

    /**
     * Execute direct query
     */
    public function query($sql)
    {
        return $this->db->query($sql);
    }

    /**
     * Last insert ID
     */
    public function lastInsertId()
    {
        return $this->db->lastInsertId();
    }

    public function beginTransaction()
    {
        return $this->db->beginTransaction();
    }

    public function commit()
    {
        return $this->db->commit();
    }

    public function rollBack()
    {
        return $this->db->rollBack();
    }
}
