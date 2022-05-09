<?php

class AdminC
{
    private $adminname;
    private $email;
    private $password;
    private $degree;
    private $status;
    private $error;
    private $nregex = "/([`a-zA-Z0-9])/";
    private $eregex = "/^([a-z0-9\.]+@+[a-z]+(\.)+[a-z]{2,3})$/";
    private $pregex = "/^([a-zA-Z0-9\@\$\%\_])/";

    public function __CONSTRUCT(array $Donnees)
    {
        $this->HydrateAdmin($Donnees);
        return;
    }

    private function HydrateAdmin(array $Donnees)
    {
        foreach ($Donnees as $key => $value) {
            $method = "set" . ucfirst(strtolower($key));

            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
        return;
    }

    private function setAdminname($adminname)
    {
        if (empty($this->error)) {
            if (preg_match($nregex, $adminname) && strlen($adminne) >= 2) {
                $this->adminname = ucfirst(strtolower($adminname));
            } else {
                $this->error = "ERREUR : Nom d'utilisateur invalide !<br />(NB : Le nom ne doit être composé que des caractères alpha-numériques, et avoir une taille minimale de deux caractères.)";
            }
        }
        return;
    }

    private function setEmail($email)
    {
        if (empty($this->error)) {
            if (preg_match($eregex, $email)) {
                $this->email = strtolower($email);
            } else {
                $this->error = "ERREUR : Format d'email invalide !";
            }
        }
        return;
    }

    private function setPassword($password)
    {
        if (empty($this->error)) {
            if (preg_match($pregex, $password) && strlen($password) >= 8) {
                $this->password = $password;
            } else {
                $this->error = "ERREUR : Le mot de passe est faible.";
            }
        }
        return;
    }

    private function setDegree($degree)
    {
        if (empty($this->error)) {
            $this->degree = intval($degree);
        }
        return;
    }

    private function setStatus($status)
    {
        if (empty($this->error)) {
            $this->status = strtoupper($status);
        }
        return;
    }

    public function getAdminname()
    {
        return $this->adminname;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getDegree()
    {
        return $this->degree;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getError()
    {
        return $this->error;
    }
}
