<?php
abstract class Type {

    protected static $alias;

    public static function getAlias() {
        return static::$alias;
    }

    public static function is($other) {
        return static::$alias === $other::getAlias();
    }

    public static function getDBType() {
        return "i";
    }

    public static function store($content) {
        return $content;
    }

    public static function restore($stored) {
        return $stored;
    }

}
