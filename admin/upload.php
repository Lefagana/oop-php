<?php include "includes/header.php";?>
<?php if (!$session->isSignIn()) {redirect("login.php");}?>
<?php
$message = '';
if (isset($_POST['submit'])) {
    $photo = new Photo();
    $photo->title = $_POST['title'];
    $photo->set_file($_FILES['upload']);
    if ($photo->save()) {
        $message = "Photo uploaded Sucessfully";
    } else {
        $message = join("<br>", $photo->errors);
    }

}
?>
<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <?php include "includes/topnav.php";?>
    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <?php include "includes/sidenav.php";?>
    <!-- /.navbar-collapse -->
</nav>

<div id="page-wrapper">
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    UPLOADS
                    <small>Subheading</small>
                </h1>
                <div class="col-md-6">
                    <?php echo $message;
?>
                    <form action="upload.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <input type="text" name="title" id="" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="file" name="upload" id="">
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" id="">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

<?php include "includes/footer.php";?>