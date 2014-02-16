<?php
class DBArray extends Type {

    protected static $alias = "serialized";

    public static function getDBType() {
        return "s";
    }

    public static function store($content) {
        return unserialize($content);
    }

    public static function restore($stored) {
        return serialize($content);
    }

}
