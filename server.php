<?php 
require 'bootstrap.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: *");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
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
           throw new \Exception("Sorry, file `{$filename}` already exists.", 404);
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
                echo json_encode(['success' => 'morel']);
                $result = [
                    'success' => false, 
                    'msg' => 'Sorry, there was an error uploading your image.',
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
