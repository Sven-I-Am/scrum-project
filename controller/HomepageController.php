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
                case 'terms':
                    require 'view/terms.php';
                    break;
                    case 'search':
                        $this->search($POST);
                        break;
    
            }
        }

    }
    public function search($POST) {
      $products = ProductLoader::readAllProductByName($this->db,$POST);
      $categories = FilterLoader::getAllCategories($this->db);
      $universes = FilterLoader::getAllUniverses($this->db);

      require 'view/homepage.php';

          }
}        


/* code to set sold status

if(isset($_POST['buy'])){
            echo "ola";
            $date = new DateTime();
            $id = $_POST['buy'];

            var_dump("controller: ",date_format($date, 'Y-m-d'));

            ProductLoader::updateSoldStatus($this->db, $id, date_format($date, 'Y-m-d'));
        }

        require 'View/product.php';

*/