<?php
class User
{
    public $id;
    public $username;
    public $password;
    public $firstname;
    public $lastname;
//method that can find all users on the system
    public static function find_all_users()
    {
        return self::find_this_query("SELECT *FROM users");
    }
//method that can find one users on the system
    public static function find_users_byId($id)
    {
        global $database;
        $the_result_array = self::find_this_query("SELECT *FROM users WHERE id = $id LIMIT 1");
        return !empty($the_result_array) ? array_shift($the_result_array) : false;
    }
    //method that can find all our query on Database
    public static function find_this_query($sql)
    {
        global $database;
        $result_set = $database->query($sql);
        $the_object_array = array();
        while ($row = mysqli_fetch_array($result_set)) {
            $the_object_array[] = self::instantiation($row);
        }
        return $the_object_array;
    }
    //method that verify user sign-in
    public static function verify_user($username, $password)
    {
        global $database;
        $username = $database->escape_string($username);
        $password = $database->escape_string($password);

        $sql = "SELECT *FROM users WHERE ";
        $sql .= "username = '{$username}'";
        $sql .= " AND password = '{$password}'";
        $sql .= " LIMIT 1";
        $the_result_array = self::find_this_query($sql);
        return !empty($the_result_array) ? array_shift($the_result_array) : false;
    }
    //this method instatiate the record and loop through them.
    public static function instantiation($the_record)
    {
        $the_object = new self;
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
}