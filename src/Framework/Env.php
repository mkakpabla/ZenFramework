<?php


namespace Framework;

use Dotenv\Dotenv;

class Env
{

    private static $_dotenv;

    /**
     * Recharge les variables d'environnements
     */
    public static function load(): void
    {
        if(self::$_dotenv == null) {
            self::$_dotenv = Dotenv::create(dirname(dirname(__DIR__)));
            self::$_dotenv->load();
        }
        
    }

    /**
     * Recupere une valeur de la variable d'environnement
     */
    public static function get(string $varname, ?string $default = null): ?string
    {
        self::load();
        $value = getenv($varname);
        if (is_null($value)) { return $default; } else {return $default; }
    }

    public static function config(string $key)
    {
        $dir = getcwd();
        while(is_dir($dir)) {
            $file = $dir . '/config/config.php';
            $dir = dirname($dir);
            if(file_exists($file)) {
                $configFile = require $file;
                return $configFile[$key];
                break;
            }
        }
    }
}
