<?php
class DBDateTime extends Type {

    protected static $alias = "datetime";

    public static function getDBType() {
        return "s";
    }

    public static function store($content) {
        return new TimeDate($content);
    }

    public static function restore($stored) {
        return new $stored->format(DATE_FORMAT);
    }

}
