<?php

declare(strict_types=1);

class LoginController
{
    //render function with both $_GET and $_POST vars available if it would be needed.
    public function render(array $GET, array $POST)
    {
        require 'view/login.php';
    }
}
