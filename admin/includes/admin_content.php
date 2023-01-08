<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Blank Page
                <small>Subheading</small>
            </h1>
            <?php
// $user = new User();
// $user->username = "Edwin1";
// $user->lastname = " last 1 Edwin";
// $user->firstname = "First 1 Edwin";
// $user->password = "Edwin1234";
// $user->email = "Edwin@gmail.com";
// $user->create();

$user = User::find_users_byId(9);
$user->username = 'Test new';

$user->delete_user();
?>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i> <a href="index.html">Dashboard</a>
                </li>
                <li class="active">
                    <i class="fa fa-file"></i> Blank Page
                </li>
            </ol>
        </div>
    </div>
    <!-- /.row -->

</div>
<!-- /.container-fluid -->