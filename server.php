<?php 
require 'bootstrap.php';

header("Access-Control-Allow-Origin:* ");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");

$serverInfo = [
    'ip_addr' => $_SERVER['PHP_SELF'],
    'host_name' => $_SERVER['SERVER_NAME'],
    'port_number' => $_SERVER['SERVER_PORT'],
    'software' => $_SERVER['SERVER_SOFTWARE'],
    'request_method'=> $_SERVER['REQUEST_METHOD'],
];

if ($serverInfo['request_method'] == 'POST') {
    
    error_log('Image upload processing ...');
    $targetDir = "uploads/";
    $filename= $targetDir . basename($_FILES["file"]["name"]);
    $imageFileType = strtolower(pathinfo($filename,PATHINFO_EXTENSION));
    $uploadFlag = true;

    uploadImage($filename, $imageFileType, $uploadFlag); //process the upload file

}

function uploadImage($filename, $imageFileType, $uploadFlag) {
    
    try {
        // Check file size
        if ($_FILES["file"]["size"] > 500000) {
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
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $filename)) {

                $result = [
                    'success' => true, 
                    'msg' => 'File uploaded successfully', 
                    'image_link' => "{$_ENV['APP_URL']}/{$filename}"
                ];
                error_log(json_encode($result));
                echo json_encode($result);
            } else {
                $result = [
                    'success' => false, 
                    'msg' => 'Sorry, there was an error uploading your image.', 
                    'image_link' => ''
                ];
                error_log(json_encode($result));
                echo json_encode($result);
            }
        }
    } catch (\Exception $e) {
        error_log($e->getMessage());
        echo json_encode([
            'success' => false,
            'msg' => $e->getMessage()
        ]);
    
    }
}
