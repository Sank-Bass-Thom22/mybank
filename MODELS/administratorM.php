<?php

require_once('../MODELS/database.php') ;

class AdminM extends Connection
{
    public function Sign_in(AdminC $adminC)
    {
        $db = $this->DBconnector() ;
        $status = "UNLOCK" ;

        $sql = "SELECT adminname, email, password, degree, status FROM `administrator` WHERE adminname = :adminname AND email = :email AND status = :status ORDER BY id_admin ASC" ;
        $query = $db->prepare($sql) ;
        $query->bindParam(':adminname', $adminC->getAdminname()) ;
        $query->bindParam(':email', $adminC->getEmail()) ;
        $query->bindParam(':status', $status) ;
        $query->execute() ;

        $row = $query->fetch() ;

        if(!empty($row))
        {
            if(password_verify($row['password'], PASSWORD_BCRYPT))
            {
                if($row['degree'] == 1)
                {
                    $code = 101 ;
                } else {
                    $code = 102 ;
                }
            } else {
                $code = 202 ;
            }
        } else {
            $code = 201 ;
        }
        return $code ;
    }

    public function Sign_up(AdminC $adminC)
    {
        $db = $this->DBconnector() ;

        $sql = "SELECT email FROM `administrator` WHERE email = :email" ;
        $query = $db->prepare($sql) ;
        $query->bindParam(':email', $adminC->getEmail()) ;
        $query->execute() ;

        $row = $query->fetch() ;

        if(empty($row))
        {
            $sql = "INSERT INTO `administrator`(adminname, email, password, degree, status)
            VALUES(:adminname, :email, :password, :degree, :status)" ;
            $query = $db->prepare($sql) ;
            $query->bindParam(':adminname', $adminC->getAdminname()) ;
            $query->bindParam(':email', $adminC->getEmail()) ;
            $query->bindParam(':password', password_hash($adminC->getPassword(), PASSWORD_BCRYPT)) ;
            $query->bindParam(':degree', $adminC->getDegree()) ;
            $query->bindParam(':status', $adminC->getStatus()) ;
            $query->execute() ;

            if(!empty($query))
            {
                $code = 100 ;
            } else {
                $code = 200 ;
            }
        } else {
            $code = 300 ;
        }
        return $code ;
    }

    public function All_admin()
    {
        $db = $this->DBconnector() ;

        $sql = "SELECT id_admin, adminname, email FROM `administrator` ORDER BY adminname ASC" ;
        $query = $db->prepare($sql) ;
        $query->execute() ;

        return $query ;
    }

    public function Single_admin($id_admin)
    {
        $db = $this->DBconnector() ;

        $sql = "SELECT * FROM `administrator` WHERE id_admin = :id_admin" ;
        $query = $db->prepare($sql) ;
        $query->bindParam(':id_admin', $id_admin) ;
        $query->execute() ;

        return $query ;
    }

    public function Modification(AdminC $adminC, $id_admin)
    {
        $db = $this->DBconnector() ;

        $sql = "SELECT email FROM `administrator` WHERE email = :email" ;
        $query = $db->prepare($sql) ;
        $query->bindParam(':email', $adminC->getEmail()) ;
        $query->execute() ;

        $row = $query->fetch() ;

        if(!empty($row))
        {
            $sql = "UPDATE `administrator` SET adminname = :adminname AND email = :email AND password = :password AND status = :status WHERE id_admin = :id_admin" ;
            $query = $db->prepare($sql) ;
            $query->bindParam(':adminname', $adminC->getAdminname()) ;
            $query->bindParam(':email', $adminC->getEmail()) ;
            $query->bindParam(':password', password_hash($adminC->getPassword(), PASSWORD_BCRYPT)) ;
            $query->bindParam(':status', $adminC->getStatus()) ;
            $query->bindParam(':id_admin', $id_admin) ;
            $query->execute() ;

            if(!empty($query))
            {
                $code = 103 ;
            } else {
                $code = 203 ;
            }
        } else {
            $code = 300 ;
        }
        return $code ;
    }

}