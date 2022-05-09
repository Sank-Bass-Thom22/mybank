<?php

class Connection
{
    private $host = "localhost" ; private $dbname = "mybank" ;
    private $user = "root" ; private $password = "" ;

    protected function DBconnector()
    {
        try
        {
            $db = new PDO('mysqlhost=' . $this->host . ';dbname=' . $this->dbname . ';Charset=UTF-8', $this->user, $this->password) ;
            return $db ;
        } catch(Exception $e) {
            die("ERREUR : Connexion non établie. " . $e->getMessage()) ;
            exit ;
        }
    }
}