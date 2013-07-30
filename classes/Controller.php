<?php

abstract class Controller {

    /**
     * The Database ID of the object
     * @var int
     */
    protected $id;

    /**
     * The name of the database table used for queries
     * @var Database
     */
    protected $table;

    /**
     * The result of the database query to locate the object with a specific ID
     * @var array
     */
    protected $result;

    /**
     * The database variable used for queries
     * @var Database
     */
    protected $db;

    /**
     * Construct a new Controller
     *
     * This method takes the table and ID of the object to look for, and
     * creates a $this->db object which can be used to communicate with the
     * database, as well as a $this->result array which is the single result
     * of the $this->db->query function
     *
     * @param int $id The ID of the object to look for
     * @param int $table The name of the DB table used for queries
     * @param string $column The column to use to identify separate database entries
     */
    function __construct($id, $table=null, $column="id") {

        $this->db = Database::getInstance();

        if ($column == "id") $this->id = $id;
        $this->table = $table;

        $results = $this->db->query("SELECT * FROM " . $table . " WHERE " . $column . " = ?", "i", array($id));
        $this->result = $results[0];
    }

    /**
     * Delete the object
     *
     * Please note that this does not delete the object entirely from the database,
     * it only hides it from users. You should overload this function if your object
     * does not have a 'status' column which can be set to 'deleted'.
     */
    public function delete() {
        $this->__set('status', 'deleted');
    }

    /**
     * Permanently delete the object from the database
     */
    public function wipe() {
        $this->db->query("DELETE FROM ". $this->table ." WHERE id = ?", "i", array($this->id));
    }


    /**
     * Generate a URL-friendly unique alias for an object name
     *
     * @param string $name The original object name
     * @return string|Null The generated alias, or Null if we couldn't make one
     */
    static function generateAlias($name) {
        // Convert name to lowercase
        $name = strtolower($name);

        // List of characters which should be converted to dashes
        $makeDash = array(' ', '_');

        $name = str_replace($makeDash, '-', $name);

        // Only keep letters, numbers and dashes - delete everything else
        $name = preg_replace("/[^a-zA-Z\-0-9]+/", "", $name);

        if (str_replace('-', '', $name) == '') {
            // The name only contains symbols or Unicode characters!
            // This means we can't convert it to an alias
            return null;
        }

        // An alias name can't only contain numbers, because it will be
        // indistinguishable from an ID. If it does, add a dash in the end.
        if (preg_match("/^[0-9]+$/", $name)) {
            $name = $name . '-';
        }

        // Try to find duplicates
        $db = Database::getInstance();
        $result = $db->query("SELECT alias FROM " . $this->table . " WHERE alias REGEXP ?", 's', array("^".$name."[0-9]*$"));

        // The functionality of the following code block is provided in PHP 5.5's
        // array_column function. What is does is convert the multi-dimensional
        // array that $db->query() gave us into a single-dimensional one.
        $aliases = array();
        if (is_array($result)) {
            foreach ($result as $r) {
                $aliases[] = $r['alias'];
            }
        }

        // No duplicates found
        if (!in_array($name, $aliases))
            return $name;

        // If there's already an entry with the alias we generated, put a number
        // in the end of it and keep incrementing it until there is we find
        // an open spot.
        $i = 2;
        while(in_array($name.$i, $aliases)) {
            $i++;
        }

        return $name.$i;
    }

}