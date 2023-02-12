<?php include "includes/header.php";?>
<?php if (!$session->isSignIn()) {redirect("login.php");}?>
<?php
$photos = Photo::find_all();

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
                    PHOTOS
                    <small>Subheading</small>
                </h1>
                <div class="col-md-12">
                    <table class='table table-hover'>
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Photo</th>
                                <th>File Name</th>
                                <th>Title</th>
                                <th>Size</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
foreach ($photos as $photo):
?>
                            <tr>
                                <td><?php echo $photo->id ?></td>
                                <td><img src="<?php echo $photo->picturePath() ?>" width="100" height="50">
                                    <div class="pictures_link">
                                        <a href="delete_photo.php/?id=<?php echo $photo->id ?>">Delete</a>
                                        <a href="edit_photo.php?id=<?php echo $photo->id ?>">Edit</a>
                                        <a href="view.php?id=<?php echo $photo->id ?>">View</a>
                                    </div>
                                </td>
                                <td><?php echo $photo->filename ?></td>
                                <td><?php echo $photo->title ?></td>
                                <td><?php echo $photo->size ?></td>
                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
<?php include "includes/footer.php";?>