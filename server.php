<?php 
require 'bootstrap.php';

header("Access-Control-Allow-Origin:* ");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");

print('Server information:');
$serverInfo = [
    'ip_addr' => $_SERVER['SERVER_ADDR'],
    'host_name' => $_SERVER['SERVER_NAME'],
    'port_number' => $_SERVER['SERVER_PORT'],
    'software' => $_SERVER['SERVER_SOFTWARE'],
    'request_method'=> $_SERVER['REQUEST_METHOD'],
];

print_r($serverInfo).PHP_EOL;


if ($serverInfo['request_method'] == 'POST') {  

    $targetDir = "uploads/";
    $filename= $targetDir . basename($_FILES["file"]["name"]);
    $imageFileType = strtolower(pathinfo($filename,PATHINFO_EXTENSION));
    $uploadFlag = true;

    uploadImage($filename, $imageFileType, $uploadFlag, $serverInfo); //process the upload file

}

die('Unauthorized request method.');

function uploadImage($filename, $imageFileType, $uploadFlag, $serverInfo) {
    
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
                echo json_encode([
                    'success' => true, 
                    'message' => 'File uploaded successfully', 
                    'image_link' => "{$serverInfo['host_name']}:{$serverInfo['port_number']}/{$filename}"
                ]);
            } else {
              echo "Sorry, there was an error uploading your image.";
            }
        }
    } catch (\Exception $e) {
        error_log($e->getMessage());
        echo json_encode([
            'success' => false, 
            'msg' => 'File upload unsuccessful'
        ]);
    
    }
}
