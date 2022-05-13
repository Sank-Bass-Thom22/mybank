<?php

class AdminC
{
    private $firstname;
    private $lastname;
    private $email;
    private $password;
    private $repeatpassword;
    private $degree;
    private $status;
    private $error = '';

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

    private function setFirstname($firstname)
    {
        $size = 2;

        $tab = $this->StringVerify($firstname, $size);

        if (is_array($tab)) {
            foreach ($tab as $key => $value) {
                switch ($tab[$key]) {
                    case 'SYMBOL':
                        if ($value === 1) {
                            $this->error = 'ERREUR : Le prénom ne doit pas contenir des symboles.';
                        }
                        break;
                    case 'SIZE':
                        if ($value === 0) {
                            $this->error = 'ERREUR : Prénom trop court.';
                        }
                }
            }
            if (empty($this->error)) {
                $this->firstname = ucfirst(strtolower($firstname));
            }
        }
        return;
    }

    private function setLastname($lastname)
    {
        $size = 2;

        $tab = $this->StringVerify($lastname, $size);

        if (is_array($tab)) {
            foreach ($tab as $key => $value) {
                switch ($tab[$key]) {
                    case 'SYMBOL':
                        if ($value === 1) {
                            $this->error = 'ERREUR : Le nom ne doit pas contenir des symboles.';
                        }
                        break;
                    case 'SIZE':
                        if ($value === 0) {
                            $this->error = 'ERREUR : Nom trop court.';
                        }
                }
            }
            if (empty($this->error)) {
                $this->lastname = ucfirst(strtolower($lastname));
            }
        }
        return;
    }

    private function setEmail($email)
    {
        $size = 10;

        $tab = $this->StringVerify($email, $size);

        if (is_array($tab)) {
            foreach ($tab as $key => $value) {
                switch ($tab[$key]) {
                    case 'STRUCTURE':
                        if ($value === 0) {
                            $this->error = 'ERREUR : Adresse Email invalide.';
                        }
                        break;
                    case 'SIZE':
                        if ($value === 0) {
                            $this->error = 'ERREUR : Adresse Email trop court.';
                        }
                }
            }
            if (empty($this->error)) {
                $this->email = $email;
            }
        }
        return;
    }

    private function setPassword($password)
    {
        $size = 8;

        $tab = $this->StringVerify($password, $size);

        if (is_array($tab)) {
            foreach ($tab as $key => $value) {
                switch ($tab[$key]) {
                    case 'UPPERCASE':
                        if ($value === 0) {
                            $this->error = 'ERREUR : Le mot de passe doit contenir au minimum une lettre majuscule.';
                        }
                        break;
                    case 'LOWERCASE':
                        if ($value === 0) {
                            $this->error = 'ERREUR : Le mot de passe doit contenir au minimum une lettre minuscule.';
                        }
                        break;
                    case 'NUMBER':
                        if ($value === 0) {
                            $this->error = 'ERREUR : Le mot de passe doit contenir au minimum un chiffre.';
                        }
                        break;
                    case 'SYMBOL':
                        if ($value === 0) {
                            $this->error = 'ERREUR : Le mot de passe doit contenir au minimum un symbole.';
                        }
                        break;
                    case 'SIZE':
                        if ($value === 0) {
                            $this->error = 'ERREUR : Le mot de passe doit avoir une taille minimale de 8 caractères.';
                        }
                }
            }
            if (empty($this->error)) {
                $this->password = $password;
            }
        }
        return;
    }

    private function setRepeatPassword($repeatpassword)
    {
        if (empty($this->error)) {
            if ($repeatpassword !== $this->password) {
                $this->error = 'ERREUR : Les deux mots de passe ne sont pas identique.';
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

    public function getFirstname()
    {
        return $this->firstname;
    }

    public function getLastname()
    {
        return $this->lastname;
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

    private function StringVerify($str, $size)
    {
        if (empty($this->error)) {
            $upc = preg_match('@[A-Z]@', $str);
            $lwc = preg_match('@[a-z]@', $str);
            $nbr = preg_match('@[0-9]@', $str);
            $smb = preg_match('@[^\w]@', $str);
            strlen($str) < $size ? $siz = 0 : $siz = 1;
            $struct = preg_match('/^([a-z0-9\.]+@+[a-z]+(\.)+[a-z]{2,3})$/', $str);

            $tab = array(
                'UPPERCASE' >= $upc, 'LOWERCASE' >= $lwc, 'NUMBER' >= $nbr,
                'SYMBOL' >= $smb, 'SIZE' >= $siz, 'STRUCTURE' >= $struct
            );

            return $tab;
        }
        return 0;
    }
}
