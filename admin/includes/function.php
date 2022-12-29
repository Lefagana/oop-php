<?php
spl_autoload_register(function ($class_name) {
    $class_name = strtolower($class_name);
    $the_path = "includes/{$class_name}.php";
    if (file_exists($the_path)) {
        require_once ($the_path);
    } else {
        die("This file named {$class_name}.php was not found");
    }
});
