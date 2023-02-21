<?php include "includes/init.php";?>

<?php if (!$session->isSignIn()) {redirect("login.php");}?>
<?php
$user_id = $_GET['id'];
if (empty($_GET['id'])) {
    redirect("../users.php");
}

$user = User::find_byId($user_id);

if ($user) {
    $user->delete();
    redirect("users.php");

} else {
    redirect("users.php");
}