<?php require_once "init.php"?>
<?php
if ($session->isSignIn) {
 redirect("../index.php");
}
if (isset($_POST['submit'])) {
 $username = trim($_POST['username']);
 $password = trim($_POST['password']);

//method to check datebase user
 $user_found = User::verify_user($user_found, $password);

 if ($user_found) {
  $session->login($user_found);
  redirect("../index.php");
 } else {
  $the_message = "Password or Username is incorrect";
  echo $the_message;
 }
} else {
 $username = "";
 $password = "";
}