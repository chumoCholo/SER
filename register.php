<?php
$servername = "localhost";
$username = "root";
$password = "12345"; //Cambiar la contraseña del workbench o eliminar en caso de no tener 
$dbname = "usuariosweb";
/* Cambiar nombre de la base de datos, en caso de no existir la bd
crear primero la bd.
*/

if(! filter_var($_POST["usuario"], FILTER_VALIDATE_EMAIL)){
  die("Un email es requerido");
}

if(strlen($_POST["contraseña"])<8){
  die("La contraseña debe tener al menos 8 caracteres");
}

if(! preg_match("/[a-z]/i",$_POST["contraseña"])){
  die("La contraseña debe contener al menos un caracter");
}
//Descomentar la siguientes dos lineas de código en caso de que se agregue 
//un espacio(en el html) para confirmar la contraseña
if($_POST["contraseña"] !== $_POST["contraseña_confirmacion"]){
  die("Las contraseñas deben coincidir");
}


$contraseña_hash = password_hash($_POST["contraseña"],PASSWORD_DEFAULT);


$mysqli= require __DIR__ . "/database.php";
$sql = "INSERT INTO usuarios (email,contraseña,fecha) 
VALUES (?,?,?)";
$stmt = $mysqli->stmt_init();
  if(! $stmt->prepare($sql)){
    die("SQL error: " . $mysqli->error);
  }

$date = date("Y-m-d");
  $stmt -> bind_param("sss",
                      $_POST["usuario"],
                      $contraseña_hash,
                      $date);
 if ($stmt -> execute()){
    header("Location: login.html");
    exit;


  }else{
    echo($mysqli->errno);
    if($mysqli->errno === 1062){
      die("Ya hay un regsitro con este email")  ;
    }else{
      die($mysqli->error . " ". $mysqli->errno );

    }
    
  }

  echo  "Singup succesful";


?>
