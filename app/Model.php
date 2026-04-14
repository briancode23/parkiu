<?php
/**
 * Base Model Class
 * Provides common database operations
 */
abstract class Model
{
    protected $db;
    protected $table;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    /**
     * Find by ID
     */
    public function findById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = ?");
        if (!$stmt) {
            return null;
        }
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    /**
     * Find all records
     */
    public function findAll()
    {
        $result = $this->db->query("SELECT * FROM {$this->table}");
        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }

    /**
     * Find with conditions
     */
    public function find($column, $value, $operator = '=')
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE {$column} {$operator} ?");
        if (!$stmt) {
            return [];
        }

        // Determine type
        $type = is_numeric($value) ? 'i' : 's';
        $stmt->bind_param($type, $value);
        $stmt->execute();

        $result = $stmt->get_result();
        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }

    /**
     * Insert record
     */
    public function insert($data)
    {
        $columns = implode(',', array_keys($data));
        $placeholders = implode(',', array_fill(0, count($data), '?'));

        $stmt = $this->db->prepare("INSERT INTO {$this->table} ({$columns}) VALUES ({$placeholders})");
        if (!$stmt) {
            return false;
        }

        $types = $this->getTypes(array_values($data));

        // Create references for bind_param
        $values = array_values($data);
        $refs = [];
        foreach ($values as &$value) {
            $refs[] = &$value;
        }

        array_unshift($refs, $types);
        call_user_func_array([&$stmt, 'bind_param'], $refs);

        return $stmt->execute();
    }

    /**
     * Update record
     */
    public function update($id, $data)
    {
        $sets = [];
        foreach (array_keys($data) as $key) {
            $sets[] = "{$key} = ?";
        }
        $setString = implode(', ', $sets);

        // Get id column (assuming 'id' is primary key)
        $idColumn = $this->getIdColumn();

        $stmt = $this->db->prepare("UPDATE {$this->table} SET {$setString} WHERE {$idColumn} = ?");
        if (!$stmt) {
            return false;
        }

        $values = array_merge(array_values($data), [$id]);
        $types = $this->getTypes($values);

        // Create references for bind_param
        $refs = [];
        foreach ($values as &$value) {
            $refs[] = &$value;
        }

        array_unshift($refs, $types);
        call_user_func_array([&$stmt, 'bind_param'], $refs);

        return $stmt->execute();
    }

    /**
     * Count records
     */
    public function count()
    {
        $result = $this->db->query("SELECT COUNT(*) as count FROM {$this->table}");
        return $result ? $result->fetch_assoc()['count'] : 0;
    }

    /**
     * Get types for bind_param
     */
    protected function getTypes($values)
    {
        $types = '';
        foreach ($values as $value) {
            if (is_int($value)) {
                $types .= 'i';
            } elseif (is_float($value)) {
                $types .= 'd';
            } else {
                $types .= 's';
            }
        }
        return $types;
    }

    /**
     * Get primary key column (override in child classes if different)
     */
    protected function getIdColumn()
    {
        return 'id';
    }
}
