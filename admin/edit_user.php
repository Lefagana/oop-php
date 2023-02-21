<?php include "includes/header.php";?>
<?php if (!$session->isSignIn()) {redirect("login.php");}?>
<?php
if (empty($_GET['id'])) {
    redirect("users.php");
}
$user = User::find_byId($_GET['id']);
if (isset($_POST['update'])) {
    // echo "clicked!";
    if ($user) {
        $user->username = $_POST['username'];
        $user->firstname = $_POST['firstname'];
        $user->lastname = $_POST['lastname'];
        $user->email = $_POST['email'];
        $user->password = $_POST['password'];
        $userimage = $_FILES['userimage'];
        if (empty($userimage)) {
            $user->save();
        } else {
            $user->set_file($userimage);
            $user->photo_properties();
            $user->save();
            redirect("edit_user.php?id={$user->id}");
        }
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
                <div class="col-md-6">
                    <img class="img-responsive" src="<?php echo $user->imagePathAndPlaceholder(); ?>" alt="Profile">
                </div>
                <form method="post" enctype="multipart/form-data">
                    <div class="col-md-6 ">
                        <div class="form-group">
                            <input type="file" name="userimage" id="" class="form-control">
                        </div>
                        <div class=" form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" id="" class="form-control"
                                value="<?php echo $user->username; ?>">
                        </div>
                        <div class="form-group">
                            <label for="firstname">First Name</label>
                            <input type="text" name="firstname" id="" class="form-control"
                                value="<?php echo $user->firstname; ?>">
                        </div>
                        <div class="form-group">
                            <label for="firstname">Last Name</label>
                            <input type="text" name="lastname" id="" class="form-control"
                                value="<?php echo $user->lastname; ?>">
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="text" name="email" id="" class="form-control"
                                value="<?php echo $user->email; ?>">
                        </div>
                        <div class="form-group">
                            <label for="passsword">Passsword</label>
                            <input type="password" name="password" id="" class="form-control"
                                value="<?php echo $user->password; ?>">
                        </div>
                        <div class="info-box-footer clearfix">
                            <div class="info-box-delete pull-left">
                                <a href="delete_user.php?id=<?php echo $user->id; ?>"
                                    class="btn btn-danger btn-lg ">Delete</a>
                            </div>
                            <div class="info-box-update pull-right ">
                                <input type="submit" name="update" value="Update" class="btn btn-primary btn-lg ">
                            </div>
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