<?php

require_once('../MODELS/database.php');

class AdminM extends Connection
{
    public function Sign_in(AdminC $adminC)
    {
        $db = $this->DBconnector();
        $status = "UNLOCK";

        $sql = "SELECT firstname, lastname, password, degree FROM administrator WHERE email = :email AND status = :status ORDER BY id_admin ASC";
        $query = $db->prepare($sql);
        $query->bindValue(':email', $adminC->getEmail());
        $query->bindValue(':status', $status);
        $query->execute();

        $row = $query->fetch();
        return $row;
    }

    public function Sign_up(AdminC $adminC)
    {
        $db = $this->DBconnector();

        $sql = "SELECT email FROM administrator WHERE email = :email";
        $query = $db->prepare($sql);
        $query->bindValue(':email', $adminC->getEmail());
        $query->execute();

        $row = $query->fetch();

        if (!$row && $query->rowCount() == 0) {
            $sql = "INSERT INTO administrator(firstname, lastname, email, password, degree, status)
            VALUES(:firstname, :lastname, :email, :password, :degree, :status)";
            $query = $db->prepare($sql);
            $query->bindValue(':firstname', $adminC->getFirstname());
            $query->bindValue(':lastname', $adminC->getLastname());
            $query->bindValue(':email', $adminC->getEmail());
            $query->bindValue(':password', password_hash($adminC->getPassword(), PASSWORD_BCRYPT));
            $query->bindValue(':degree', $adminC->getDegree());
            $query->bindValue(':status', $adminC->getStatus());
            $query->execute();

            if ($query && $query->rowCount()) {
                $code = 100;
            } else {
                $code = 200;
            }
        } else {
            $code = 300;
        }
        return $code;
    }

    public function All_admin()
    {
        $db = $this->DBconnector();

        $sql = "SELECT id_admin, firstname, lastname, email FROM administrator ORDER BY adminname ASC";
        $query = $db->prepare($sql);
        $query->execute();

        return $query;
    }

    public function Single_admin($id_admin)
    {
        $db = $this->DBconnector();

        $sql = "SELECT * FROM administrator WHERE id_admin = :id_admin";
        $query = $db->prepare($sql);
        $query->bindValue(':id_admin', $id_admin);
        $query->execute();

        return $query;
    }

    public function ResetPassword(AdminC $adminC)
    {
        $db = $this->DBconnector();

        $sql = "UPDATE administrator SET password = :password WHERE email = :email";
        $query = $db->prepare($sql);
        $query->bindValue(':password', password_hash($adminC->getPassword(), PASSWORD_BCRYPT));
        $query->bindValue(':email', $adminC->getEmail());
        $query->execute();

        if (!empty($query)) {
            $code = 103;
        } else {
            $code = 203;
        }
        return $code;
    }

    public function Modification(AdminC $adminC, $id_admin)
    {
        $db = $this->DBconnector();

        $sql = "SELECT email FROM administrator WHERE email = :email";
        $query = $db->prepare($sql);
        $query->bindValue(':email', $adminC->getEmail());
        $query->execute();

        $row = $query->fetch();

        if (!empty($row)) {
            $sql = "UPDATE administrator SET firstname = :firstname AND lastname = :lastname AND email = :email AND status = :status WHERE id_admin = :id_admin";
            $query = $db->prepare($sql);
            $query->bindValue(':firstname', $adminC->getFirstname());
            $query->bindValue(':lastname', $adminC->getLastname());
            $query->bindValue(':email', $adminC->getEmail());
            $query->bindValue(':status', $adminC->getStatus());
            $query->bindValue(':id_admin', $id_admin);
            $query->execute();

            if (!empty($query)) {
                $code = 103;
            } else {
                $code = 203;
            }
        } else {
            $code = 300;
        }
        return $code;
    }
}
