<?php
class User extends Db_object
{
    protected static $db_tbl = "users";
    protected static $db_tbl_fields = array('username', 'password', 'firstname', 'lastname', 'email', 'userimage');
    public $id;
    public $username;
    public $password;
    public $firstname;
    public $lastname;
    public $email;
    public $userimage;
    public $upload_dir = "images";
    public $image_placeholder = "images/download.jpg";

    public function imagePathAndPlaceholder()
    {
        return empty($this->userimage) ? $this->image_placeholder : $this->upload_dir . DS . $this->userimage;

    }
    //method that verify user sign-in
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

    public function delete_user()
    {
        if ($this->delete()) {
            $target_path = SITE_ROOT . DS . 'admin' . DS . $this->imagePathAndPlaceholder();
            return unlink($target_path) ? true : false;
        } else {
            return false;
        }
    }

}
