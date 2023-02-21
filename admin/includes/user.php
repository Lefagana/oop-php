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
    public $type;
    public $size;
    public $tmp_path;
    public $upload_dir = "images";
    public $image_placeholder = "images/download.jpg";
    public $errors = array();
    //file upload Error
    public $upload_error = array(
        UPLOAD_ERR_OK => "There is no error",
        UPLOAD_ERR_INI_SIZE => "The uploaded file exceeds the upload_max_filesize.",
        UPLOAD_ERR_FORM_SIZE => "The uploaded file exceeds the MAX_FILE_SIZE direct.",
        UPLOAD_ERR_PARTIAL => "The uploaded file was only partially uploaded.",
        UPLOAD_ERR_NO_FILE => "No file was uploaded.",
        UPLOAD_ERR_NO_TMP_DIR => "Missing a temp folder.",
        UPLOAD_ERR_CANT_WRITE => "failed to write file.",
        UPLOAD_ERR_EXTENSION => "PHP Extension stopped the file upload.",
    );
    //this is passing $_FILE['filename'] as an argument
    public function set_file($file)
    {
        if (empty($file) || !$file || !is_array($file)) {
            $this->errors[] = "There was no file uploaded here";
            return false;
        } elseif ($file['error'] != 0) {
            $this->errors[] = $this->upload_error[$file['error']];
            return false;
        } else {
            $this->userimage = basename($file['name']);
            $this->tmp_path = $file['tmp_name'];
            $this->type = $file['type'];
            $this->size = $file['size'];
        }
    }

    public function photo_properties()
    {

        if (!empty($this->errors)) {
            return false;
        }
        if (empty($this->userimage) || empty($this->tmp_path)) {
            $this->errors[] = "this file was not available!";
        }

        $target_path = SITE_ROOT . DS . 'admin' . DS . $this->upload_dir . DS . $this->userimage;
        //echo $target_path;

        if (file_exists($target_path)) {
            $this->errors[] = "This File {$this->username} already exists";
            return false;
        }

        if (move_uploaded_file($this->tmp_path, $target_path)) {
            unset($tmp_path);
            return true;
        } else {
            $this->errors[] = "the file directory probably does not have permission!";
            return false;
        }

    }
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

}
