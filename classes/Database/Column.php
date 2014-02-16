<?php
class Column {

    private $name;
    private $type;

    /**
     * Create a new database column reference
     * @param string $name The name of the column as referenced in the database
     * @param Type $type The data type of the column
     */
    public function __construct($name, $type) {
        $this->name = $name;
        $this->type = $type;
    }

    public function getName() {
        return $this->name;
    }

    public function getType() {
        return $this->type;
    }

    public function store($content) {
        return $this->type->store($content);
    }

    public function restore($stored) {
        return $this->type->restore($stored);
    }


    public static function Int($name) {
        return new self($name, new Integer());
    }
    public static function String($name) {
        return new self($name, new String());
    }
    public static function Double($name) {
        return new self($name, new Double());
    }
    public static function DateTime($name) {
        return new self($name, new DBDateTime());
    }
    public static function DBArray($name) {
        return new self($name, new DBArray());
    }
}