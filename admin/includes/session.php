<?php
class Session
{
 private $signIn;
 public $user_id;

 // Constructor function to initialize the session() and check login method asa the prgramm start running
 public function __construct()
 {
  session_start();
  $this->check_the_login();
 }
//CHECK IF THE USER IS SIGN-IN
 public function isSignIn()
 {
  return $this->signIn;

 }
//LOGIN USER
 public function login($user)
 {
  if ($user) {
   $this->user_id = $_SERVER['user_id'] = $user->id;
   $this->signIn = true;
  }
 }
//LOG OUT USER FUNCTION
 public function logout()
 {
  unset($_SESSION['user_id']);
  unset($this->user_error);
  $this->signIn = false;
 }

 private function check_the_login()
 {
  if (isset($_SESSION['user_id'])) {
   $this->user_id = $_SESSION['user_id'];
   $this->signIn = true;
  } else {
   unset($this->user_id);
   $this->signIn = false;
  }
 }
}

$sesssion = new Session();