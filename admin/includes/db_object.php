<?php
class Db_object
{
//Note
// 1. We can use $this-> intead of static::

//method that can find all users on the system
    public static function find_all()
    {
        return static::find_by_query("SELECT *FROM " . static::$db_tbl . " ");
    }
//method that can find one users on the system
    public static function find_byId($id)
    {
        global $database;
        $the_result_array = static::find_by_query("SELECT *FROM " . static::$db_tbl . "  WHERE id = $id LIMIT 1");
        return !empty($the_result_array) ? array_shift($the_result_array) : false;
    }
//method that can find all our query on Database
    public static function find_by_query($sql)
    {
        global $database;
        $result_set = $database->query($sql);
        $the_object_array = array();
        while ($row = mysqli_fetch_array($result_set)) {
            $the_object_array[] = static::instantiation($row);
        }
        return $the_object_array;
    }
    //this method instatiate the record and loop through them.
    public static function instantiation($the_record)
    {
        $calling_class = get_called_class();
        $the_object = new $calling_class;
        foreach ($the_record as $the_attribute => $value) {
            if ($the_object->hasTheAttaribute($the_attribute)) {
                $the_object->$the_attribute = $value;
            }
        }
        return $the_object;
    }
    //this method check weather it has attribute
    private function hasTheAttaribute($the_attribute)
    {
        $object_properties = get_object_vars($this);
        return array_key_exists($the_attribute, $object_properties);
    }
    //fulling all out all our property
    protected function properties()
    {
        // return get_object_vars($this);
        $properties = array();
        foreach (static::$db_tbl_fields as $db_field) {
            if (property_exists($this, $db_field)) {
                $properties[$db_field] = $this->$db_field;
            }
        }
        return $properties;
    }

    protected function cleanProperties()
    {
        global $database;
        $cleanProperties = array();
        foreach ($this->properties() as $key => $value) {
            $cleanProperties[$key] = $database->escape_string($value);
        }
        return $cleanProperties;
    }

    // checking if the user exst then we updade the date else create() the neww user
    public function save()
    {
        return isset($this->id) ? $this->update() : $this->create();
    }
    public function create()
    {
        global $database;
        $properties = $this->cleanProperties();
        $sql = "INSERT INTO " . static::$db_tbl . " (" . implode(",", array_keys($properties)) . ")";
        $sql .= "VALUES('" . implode("','", array_values($properties)) . "')";
        if ($database->query($sql)) {
            $this->id = $database->the_insert_id();
            return true;
        } else {
            return false;
        }
    }
    public function update()
    {
        global $database;
        $properties = $this->cleanProperties();
        $properties_pairs = array();
        foreach ($properties as $key => $value) {
            $properties_pairs[] = "{$key}='{$value}'";
        }
        $sql = "UPDATE " . static::$db_tbl . " SET ";
        $sql .= implode(",", $properties_pairs);
        $sql .= " WHERE id= " . $database->escape_string($this->id);
        $database->query($sql);
        return (mysqli_affected_rows($database->connection) == 1) ? true : false;
    }

    public function delete_user()
    {
        global $database;
        $sql = "DELETE FROM " . static::$db_tbl . " WHERE id = '{$database->escape_string($this->id)}' LIMIT 1";
        $database->query($sql);
        return (mysqli_affected_rows($database->connection) == 1) ? true : false;
    }
}