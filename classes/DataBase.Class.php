<?php


class DataBase
{
    private $host = 'localhost';
    private $user = 'root';
    private $password = 'BouchraSamar_13';
    private $dbname = 'Youdemy_db';

    protected function connect()
    {
        try {
            $bd_conn = new PDO("mysql:host={$this->host};dbname={$this->dbname}", $this->user, $this->password);
            $bd_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $bd_conn;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }


}
