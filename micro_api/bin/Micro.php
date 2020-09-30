<?php

class Hyper
{
    public static function root()
    {
        return __DIR__ . '';
    }

    public static function config()
    {
        self::root() . '/config/'
    }
}

?>