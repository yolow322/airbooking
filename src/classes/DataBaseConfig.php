<?php
/**
 *
 * Data base config class
 *
 */

class DataBaseConfig
{
    private PDO $db;

    /**
     *
     * @return PDO
     *
     */
    public function getDb(): PDO
    {
        return $this->db;
    }

    /**
     *
     * @param mixed $db
     *
     */
    public function setDb($db): void
    {
        $this->db = $db;
    }

    /**
     *
     * class constructor
     *
     */
    public function __construct()
    {
        $this->db = new PDO('pgsql:host=localhost;port=5432;dbname=postgres;user=postgres;password=111');
    }

    /**
     *
     * Uses for debugging queries
     *
     */
    public function showErrorInfo(): array
    {
        return $this->getDb()->errorInfo();
    }
}
