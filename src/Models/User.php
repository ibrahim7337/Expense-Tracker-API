<?php

declare(strict_types=1);

namespace Src\Models;

use Config\Database;
use PDO;

class User
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = (new Database())->getConnection();
    }

    /**
     * Summary of create
     * @param string $username
     * @param string $email
     * @param string $password
     *
     * @return bool
     */
    public function create(string $username, string $email, string $password): bool
    {
        $stmt = $this->pdo->prepare('INSERT INTO users (username, email, password) VALUES (:username, :email, :password)');
        return $stmt->execute([
            ':username' => $username,
            ':email' => $email,
            ':password' => password_hash($password, PASSWORD_BCRYPT),
        ]);
    }

    /**
     * Find user by Email
     * @param string $email
     * @return array<string, string>|null
     */
    public function findByEmail(string $email): ?array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE email = :email');
        $stmt->execute([':email' => $email]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Find user by ID
     * @param string $id
     *
     * @return array<string, string>|null
     */
    public function findById(string $id): ?array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE id = :id');
        $stmt->execute([':id' => $id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Verify Password
     * @param string $password
     * @param string $hash
     *
     * @return bool
     */
    public function verifyPassword(string $password, string $hash): bool
    {
        return password_verify($password, $hash);
    }

    /**
     * Check if Email exists
     * @param string $email
     *
     * @return bool
     */
    public function emailExists(string $email): bool
    {
        return (bool) $this->findByEmail($email);
    }
}
