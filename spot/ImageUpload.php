<?php
function uploadImage($target_file)
{
    //image upload
    $check = getimagesize($_FILES["fotka"]["tmp_name"]);
    if ($check !== false) {
        //echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        //echo "File is not an image.";
        $uploadOk = 0;
    }

    if (file_exists($target_file)) {
        //echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        //echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fotka"]["tmp_name"], $target_file)) {
            //var_dump($target_file);
            //echo "The file " . htmlspecialchars(basename($_FILES["fotka"]["name"])) . " has been uploaded.";
        } else {
            //echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>