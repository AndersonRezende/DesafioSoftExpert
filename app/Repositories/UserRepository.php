<?php

namespace DesafioSoftExpert\Repositories;

use DesafioSoftExpert\Core\Database;
use PDO;

class UserRepository
{
    protected $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function all()
    {
        $stmt = $this->db->prepare("SELECT * FROM users");
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        return $stmt->fetchAll();
    }

}