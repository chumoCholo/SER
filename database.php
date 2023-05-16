<?php

$servername = "localhost";
$username = "root";
$password = "12345"; //Cambiar contraseña
$dbname = "usuariosweb"; 
/* Cambiar nombre de la base de datos, en caso de no existir la bd
crear primero la bd.
*/
$mysqli = new mysqli(hostname: $servername, 
                     username: $username, 
                     password: $password,
                     database: $dbname);
  //Checar conexion
  if($mysqli->connect_error){
      die("Connection failed: ". $mysqli->connect_error);
  }
    
   



return $mysqli

?>