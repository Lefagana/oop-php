<?php include "includes/header.php";?>
<?php if (!$session->isSignIn()) {redirect("login.php");}?>
<?php

$user = new User();
if (isset($_POST['submit'])) {
    if ($user) {
        $user->username = $_POST['username'];
        $user->firstname = $_POST['firstname'];
        $user->lastname = $_POST['lastname'];
        $user->email = $_POST['email'];
        $user->password = $_POST['password'];
        $userimage = $_FILES['userimage'];
        $user->set_file($userimage);
        $user->photo_properties();
        // redirect("users.php");
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
                    USER
                    <small>Subheading</small>
                </h1>
                <form action="add_user.php" method="post" enctype="multipart/form-data">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="form-group">
                            <input type="file" name="userimage" id="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" id="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="firstname">First Name</label>
                            <input type="text" name="firstname" id="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="firstname">Last Name</label>
                            <input type="text" name="lastname" id="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="text" name="email" id="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="passsword">Passsword</label>
                            <input type="text" name="password" id="" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" id="" class="form-control btn btn-primary">
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
    <?php include "includes/footer.php";?>