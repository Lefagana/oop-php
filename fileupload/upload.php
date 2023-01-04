<?php
if (isset($_POST['submit'])) {
    # code...

    // echo "<pre>";
    // print_r($_FILES['file_upload']);
    // echo "<pre>";
    //checking the error on upload and there messages
    $upload_error = array(
        UPLOAD_ERR_OK => "There is no error",
        UPLOAD_ERR_INI_SIZE => "The uploaded file exceeds the upload_max_filesize.",
        UPLOAD_ERR_FORM_SIZE => "The uploaded file exceeds the MAX_FILE_SIZE direct.",
        UPLOAD_ERR_PARTIAL => "The uploaded file was only partially uploaded.",
        UPLOAD_ERR_NO_FILE => "No file was uploaded.",
        UPLOAD_ERR_NO_TMP_DIR => "Missing a temp folder.",
        UPLOAD_ERR_CANT_WRITE => "failed to write file.",
        UPLOAD_ERR_EXTENSION => "PHP Extension stopped the file upload.",
    );

    // $the_error = $_FILES['file_upload']['error'];
    // $the_message = $upload_error[$the_error];
    //end of upload error

    //accessing the temp name, file name and upload it to the specify directory
    $temp_name = $_FILES['file_upload']['tmp_name'];
    $file_name = $_FILES['file_upload']['name'];
    $directory = "upload";

    if (move_uploaded_file($temp_name, $directory . '/' . $file_name)) {
        $the_message = "File uploaded successfully";
    } else {
        $the_error = $_FILES['file_upload']['error'];
        $the_message = $upload_error[$the_error];
    }

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="" method="post" enctype="multipart/form-data">
        <h1>
            <?php
if (!empty($upload_error)) {
    echo $the_message;
}
?>
        </h1>
        <input type="file" name="file_upload" id=""><br>
        <br>
        <input type="submit" value="Submit" name="submit">
    </form>

</body>

</html>