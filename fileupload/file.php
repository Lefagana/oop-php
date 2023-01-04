<?php
echo __FILE__ . '<br>'; //C:\greco\htdocs\oop\gallery\file.php
echo __LINE__ . '<br>'; //it uSe to show you the line where the code is
echo __DIR__ . '<br>'; //C:\greco\htdocs\oop\gallery

if (file_exists(__DIR__)) { // file_exist is used to check if the file or dir exist
    echo "Yes";
}

if (is_file(__FILE__)) { // IS_file is used to check if it was file or dir. if its a file it will return true else false.
    echo "Yes";
} else {
    echo "No";
}

if (is_dir(__FILE__)) { // IS_file is used to check if it was file or dir. if its a dir it will return true else false
    echo "Yes";
} else {
    echo "No";
}

// tenary operato

echo file_exists(__DIR__) ? "yes" : "no";