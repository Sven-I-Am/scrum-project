<?php

class FilterLoader
{
    private Connection $db;
    //create a new connection based on the database value.
    public function __construct(){
        $this->db = new Connection();
    }

    public static function getAllCategories(PDO $PDO):array
    {
        $handler = $PDO->query('SELECT * FROM CATEGORY');
        return $handler->fetchAll();
    }

    public static function getAllUniverses(PDO $PDO):array
    {
        $handler = $PDO->query('SELECT * FROM UNIVERSE');
        return $handler->fetchAll();
    }
}