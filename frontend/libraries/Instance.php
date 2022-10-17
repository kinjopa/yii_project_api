<?php

namespace frontend\libraries;

class Instance
{
    private static $instances = [];

    public static function getInstance()
    {
        $class_name = get_called_class();

        if (empty(self::$instances[$class_name])) {
            self::$instances[$class_name] = new static();
        }

        return self::$instances[$class_name];
    }
}