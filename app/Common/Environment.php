<?php
namespace App\Common;

class Environment
{
    public static function load($dir)
    {
        if (!file_exists($dir . DS . ".env"))
        {
            return false;
            exit();
        }

        $lines = file($dir . DS . ".env");
        foreach($lines as $line)
        {
            putenv(trim($line));
        }
    }
}
?>
