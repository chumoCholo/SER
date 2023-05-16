<?php

$publicaciones = __DIR__."\\publicaciones\\";
$files = array_diff( scandir($publicaciones),array(".",".."));


$data = file_get_contents("php://input");
$user= json_decode($data,true);
echo json_encode( $files);