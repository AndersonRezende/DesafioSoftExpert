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

    public function find(int $id): User
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        return new User($stmt->fetch(PDO::FETCH_ASSOC));
    }

    public function create(array $data)
    {
        $stmt = $this->db->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->bindValue(1, $data['name']);
        $stmt->bindValue(2, $data['email']);
        $stmt->bindValue(3, $data['password']);
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
}