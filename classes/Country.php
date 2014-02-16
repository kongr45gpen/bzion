<?php

/**
 * A country
 */
class Country extends Model {

    /**
     * The name of the country
     * @var string
     */
    protected $name;

    /**
     * The flag of the country
     * @var string
     */
    protected $flag;

    /**
     * The name of the database table used for queries
     */
    const TABLE = "countries";

    /**
     * @see Model::getColumns()
     */
    protected function getColumns() {
        $columns = parent::getColumns();
        $columns["name"] = Column::String("name");
        $columns["flag"] = Column::Int("flag");

        return $columns;
    }

    /**
     * Get the name of the country in the default language
     * @return string
     */
    function getName() {
        return $this->name;
    }

    /**
     * Get the country's flag
     * @return string The URL to the country's flag
     */
    function getFlag() {
        return $this->flag;
    }

    /**
     * Get all the countries in the database
     * @return array An array of country IDs
     */
    public static function getCountries() {
        return parent::fetchIds();
    }

}
