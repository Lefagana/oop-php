<?php
class Photo extends Db_object
{
    protected static $db_tbl = "photos";
    protected static $db_tbl_fields = array('title', 'description', 'filename', 'type', 'size');
    public $id;
    public $title;
    public $description;
    public $filename;
    public $type;
    public $size;
    public $tmp_path;
    public $upload_dir = "images";
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
            $this->filename = basename($file['name']);
            $this->tmp_path = $file['tmp_path'];
            $this->type = $file['type'];
            $this->size = $file['size'];
        }
    }

}