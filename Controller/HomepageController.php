<?php

declare(strict_types=1);

class HomepageController
{
    //render function with both $_GET and $_POST vars available if it would be needed.
    public function render(array $GET, array $POST)
    {
        require 'View/product.php';
    }
}
