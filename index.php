<?php

echo "<h3 style ='color:darkblue;background-color:lightyellow;'>Welcome to the Image Uploader Service</h3>"."</br>";

print('<b>Server information:</b>');
$serverInfo = [
    'host' => $_SERVER['PHP_SELF'],
    'software' => $_SERVER['SERVER_SOFTWARE'],
];
echo "<pre>";
    foreach ($serverInfo as $resource) {
        echo "- ".$resource." </br>";
    }
echo "</pre>";