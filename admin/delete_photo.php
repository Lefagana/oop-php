<?php include "includes/init.php";?>

<?php if (!$session->isSignIn()) {redirect("login.php");}?>
<?php
$photo_id = $_GET['id'];
if (empty($_GET['id'])) {
    redirect("photos.php");
}

$photo = Photo::find_byId($photo_id);

if ($photo) {
    $photo->delete_photo();
    redirect("../photos.php");

} else {
    redirect("photos.php");
}