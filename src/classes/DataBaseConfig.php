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
        $this->db = new PDO('mysql:host=localhost;dbname=currency;charset=utf8', 'yolow', '1111');
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
