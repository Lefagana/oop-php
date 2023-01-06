<?php
class User
{
    public $id;
    public $username;
    public $password;
    public $firstname;
    public $lastname;
    public $email;
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

    public function create()
    {
        global $database;
        $sql = "INSERT INTO users (username,firstname,lastname,password,email)";
        $sql .= "VALUES('";
        $sql .= $database->escape_string($this->username) . "','";
        $sql .= $database->escape_string($this->firstname) . "','";
        $sql .= $database->escape_string($this->lastname) . "','";
        $sql .= $database->escape_string($this->password) . "','";
        $sql .= $database->escape_string($this->email) . "')";
        if ($database->query($sql)) {
            $this->id = $database->the_insert_id();
            return true;
        } else {
            return false;
        }
    }
    public function update_user_infor()
    {
        global $database;
        $sql = "UPDATE users SET ";
        $sql .= "username= '" . $database->escape_string($this->username) . "',";
        $sql .= "password= '" . $database->escape_string($this->password) . "',";
        $sql .= "firstname= '" . $database->escape_string($this->firstname) . "',";
        $sql .= "lastname= '" . $database->escape_string($this->lastname) . "'";
        $sql .= " WHERE id= " . $database->escape_string($this->id);
        $database->query($sql);
        return (mysqli_affected_rows($database->connection) == 1) ? true : false;
    }

    public function delete_user()
    {
        global $database;
        $sql = "DELETE FROM users WHERE id = '{$database->escape_string($this->id)}' LIMIT 1";
        $database->query($sql);
        return (mysqli_affected_rows($database->connection) == 1) ? true : false;
    }
}