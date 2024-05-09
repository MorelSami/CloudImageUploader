<?php 
require 'bootstrap.php';

print('Server information:');
$serverInfo = [
    'ip_addr' => $_SERVER['SERVER_ADDR'],
    'host_name' => $_SERVER['SERVER_NAME'],
    'software' => $_SERVER['SERVER_SOFTWARE'],
    'request_method'=> $_SERVER['REQUEST_METHOD'],
];

print_r($serverInfo).PHP_EOL;

if ($serverInfo['request_method'] == 'POST') {

    $targetDir = "uploads/";
    $filename= $targetDir . basename($_FILES["fileToUpload"]["name"]);
    $imageFileType = strtolower(pathinfo($filename,PATHINFO_EXTENSION));
    $uploadFlag = true;

    uploadImage($filename, $targetDir, $imageFileType, $uploadFlag); //process the upload file

}

die('Unauthorized request method.');

function uploadImage($filename, $targetDir, $imageFileType, $uploadFlag) {
    
    try {
        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            $uploadFlag = false;
            throw new \Exception("Sorry, your file is too large.", 404);
        }
    
        
        // Check if image already exists
        if (file_exists($filename)) {
           $uploadFlag = false;
           throw new \Exception("Sorry, file already exists.", 404);
        }
    
        // Allow specific file format types
        if(preg_match('/\.(?:png|jpg|jpeg|gif)$/', $imageFileType) ) {
            $uploadFlag = false;
            throw new \Exception("Sorry, only files of types `JPG`, `JPEG`, `PNG` & `GIF` are allowed.", 404);
        }
    
        //upload image to target directory
        if (!$uploadFlag) {
            throw new \Exception("Sorry, your image was not uploaded.");
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $filename)) {
              echo "The image ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded successfully.";
            } else {
              echo "Sorry, there was an error uploading your image.";
            }
        }
    } catch (\Exception $e) {
        error_log($e->getMessage());
        echo ($e->getMessage());
    }
}
