<?php include "includes/init.php";?>

<?php if (!$session->isSignIn()) {redirect("login.php");}?>
<?php
$user_id = $_GET['id'];
if (empty($_GET['id'])) {
    redirect("photos.php");
}

$user = User::find_byId($user_id);

if ($user) {
    $user->delete_user();
    redirect("../photos.php");

} else {
    redirect("photos.php");
}