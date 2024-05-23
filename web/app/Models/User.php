<?php

namespace DesafioSoftExpert\Models;

use DesafioSoftExpert\Traits\Hydrator;

class User
{
    use Hydrator;

    private $id;
    private $name;
    private $email;
    private $password;

    private $session_token;

    /**
     * @param array $data
     */
    public function __construct(array $data = array())
    {
        if (!empty($data)) {
            $this->hydrate($data);
        }
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getSessionToken()
    {
        return $this->session_token;
    }

    /**
     * @param mixed $session_token
     */
    public function setSessionToken($session_token): void
    {
        $this->session_token = $session_token;
    }
}