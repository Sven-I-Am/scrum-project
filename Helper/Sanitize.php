<?php

class Sanitize
{
    public static function sanitizeInput($data): string
    {
        $data = trim($data);
        $data = stripslashes($data);
        return htmlspecialchars($data);
    }
}