<?php

namespace DesafioSoftExpert\Repositories;

use DesafioSoftExpert\Core\Database;
use DesafioSoftExpert\Models\User;
use PDO;

class UserRepository implements Repository
{
    protected $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    /**
     * @return User[]
     */
    public function all(): array
    {
        $stmt = $this->db->prepare("SELECT * FROM users");
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $list = $stmt->fetchAll();
        $users = [];
        foreach ($list as $user) {
            $users[] = new User($user);
        }
        return $users;
    }

    public function find(int $id)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result !== false) {
            return new User($result);
        }
        return false;
    }

    public function create(array $data)
    {
        $stmt = $this->db->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->bindValue(1, $data['name']);
        $stmt->bindValue(2, $data['email']);
        $stmt->bindValue(3, password_hash($data['password'], PASSWORD_BCRYPT));
        $result = $stmt->execute();
        if ($result) {
            $user = new User($data);
            $user->setId($this->db->lastInsertId());
            return $user;
        }
        return $result;
    }

    public function update(array $data, int $id)
    {
        // TODO: Implement update() method.
    }

    public function delete(int $id)
    {
        // TODO: Implement delete() method.
    }

    public function login(string $email, string $password)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->bindValue(":email", $email);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result != false) {
            $user = new User($result);
            if ($user && password_verify($password, $user->getPassword())) {
                return $user;
            }
        }
        return false;
    }

    public function setToken($id, string $sessionToken): bool
    {
        $stmt = $this->db->prepare("UPDATE users SET session_token = :session_token WHERE id = :id");
        $stmt->bindParam(':session_token', $sessionToken);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function getByToken($token)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE session_token = :session_token");
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->bindValue(":session_token", $token);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result != false) {
            return new User($result);
        }
        return false;
    }
}