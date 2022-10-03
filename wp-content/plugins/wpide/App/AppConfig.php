<?php
namespace WPIDE\App;

use WPIDE\App\Config\Config;
use const WPIDE\Constants\DIR;

class AppConfig {

    protected static $config;

    public static function load(): Config
    {
        if(!empty(self::$config )) {
            return self::$config;
        }

        self::$config = new Config(require DIR.'_configuration.php');

        return self::$config;
    }

    public static function get($key, $default = null)
    {
        self::load();

        return self::$config->get($key, $default);
    }
}