<?php

class RegisterController
{
    private Connection $db;
    //create a new connection based on the database value.
    public function __construct(){
        $this->db = new Connection();
    }
    public function render(array $GET, array $POST)
    {
        if(!empty($_POST)){
            var_dump($_POST);
        } else {
            require 'view/register.php';
        }
    }


}