<?php

class FilterLoader
{
    private $db;
    //create a new connection based on the database value.
    public function __construct(){
        $this->db = new Connection();
    }
    //    fetch all categories from category table in database 
    public static function getAllCategories(PDO $PDO):array
    {
        $handler = $PDO->query('SELECT * FROM CATEGORY');
        return $handler->fetchAll();
    }
//    fetch all universes from universe table in database
    public static function getAllUniverses(PDO $PDO):array
    {
        $handler = $PDO->query('SELECT * FROM UNIVERSE');
        return $handler->fetchAll();
    }
}