<?php
class Developer extends Db_object
{
 public static $db_tbl = "developers";
 public static $db_tbl_fields = array('token', 'user_id');
 public $id;
 public $token;
 public $user_id;

}