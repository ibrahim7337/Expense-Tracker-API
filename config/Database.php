<?php

declare(strict_types=1);

namespace Config;

use PDO;
use PDOException;
use RuntimeException;

class Database
{
    private PDO $pdo;

    public function __construct()
    {
        try {
            $dsn = "mysql:host={$this->env('DB_HOST')};
                    port={$this->env('DB_PORT')};
                    dbname={$this->env('DB_NAME')};
                    charset=utf8mb4";

            $this->pdo = new PDO(
                $dsn,
                $this->env('DB_USER'),
                $this->env('DB_PASS'),
            );

            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new PDOException('Database connection failed: ' . $e->getMessage());
        }
    }

    /**
     * Get connection with Database
     *
     * @return PDO
     */
    public function getConnection()
    {
        return $this->pdo;
    }

    /**
     * Summary of env
     * @param string $key
     * @throws \RuntimeException
     *
     * @return string
     */
    private function env(string $key): string
    {
        $value = $_ENV[$key] ?? null;

        if (!is_string($value) || $value === '') {
            throw new RuntimeException("Invalid or missing env variable: {$key}");
        }

        return $value;
    }
}
