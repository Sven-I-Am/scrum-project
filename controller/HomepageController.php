<?php

class HomepageController
{
    private Connection $db;
    //create a new connection based on the database value.
    public function __construct(){
        $this->db = new Connection();
    }
    //render function with both $_GET and $_POST vars available if it would be needed.
    public function render(array $GET, array $POST)
    {
        $categories = FilterLoader::getAllCategories($this->db);
        $universes = FilterLoader::getAllUniverses($this->db);
        $products = ProductLoader::readAllProducts($this->db);

        if(!isset($GET['action'])) {
            require 'view/homepage.php';
        } else {
            switch ($GET['action']){
                case 'buy':
                    require 'view/homepage.php';
                    if(isset($_POST['btnBuy'])){
                        echo "ola";
                        $date = new DateTime();
                        $id = $_POST['btnBuy'];
                    
                        var_dump("controller: ",date_format($date, 'Y-m-d'));
                    
                        ProductLoader::updateSoldStatus($this->db, $id, date_format($date, 'Y-m-d'));
                    }
                    break;
            }
        }

    }
}

