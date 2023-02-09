<?php
// require_once "../vendor/autoload.php";

include "../includes/init.php";
include "./middleware.php";
// echo "<pre>";
// print_r($_SERVER);
// echo "</pre>";
extract($_GET);

switch ($resource) {
    case 'user':
        getUsersDetails();
        break;
    default:
        header("HTTP/1.0/ 404 Not Found");
        echo "404 not found";
        break;
}

function getUsersDetails()
{
    auth_middleware();
    //response(User::find_all());
}