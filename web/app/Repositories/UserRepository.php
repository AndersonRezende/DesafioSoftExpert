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
        // TODO: Implement find() method.
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        return new User($stmt->fetch(PDO::FETCH_ASSOC));
    }

    public function create(array $data)
    {
        // TODO: Implement create() method.
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