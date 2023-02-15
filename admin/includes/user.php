<?php
class User extends Db_object
{
    protected static $db_tbl = "users";
    protected static $db_tbl_fields = array('username', 'password', 'firstname', 'lastname', 'email');
    public $id;
    public $username;
    public $password;
    public $firstname;
    public $lastname;
    public $email;
    // public $userimage;
    // public $upload_dir = "images";
    // public $image_placeholder = "images/download.jpg";

    public static function verify_user($username, $password)
    {
        global $database;
        $username = $database->escape_string($username);
        $password = $database->escape_string($password);

        $sql = "SELECT *FROM " . self::$db_tbl . "  WHERE ";
        $sql .= "username = '{$username}'";
        $sql .= " AND password = '{$password}'";
        $sql .= " LIMIT 1";
        $the_result_array = self::find_by_query($sql);
        return !empty($the_result_array) ? array_shift($the_result_array) : false;
    }

}
