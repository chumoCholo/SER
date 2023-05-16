<?php
  $is_invalid= false;
  if(isset($_POST)){
    $mysqli= require __DIR__ . "/database.php";
    $sql = sprintf("SELECT * FROM usuarios WHERE email = '%s'",
     $mysqli->real_escape_string( $_POST["usuario"]));


     $result = $mysqli->query($sql);
     $user= $result->fetch_assoc();

    if($user){
      if(password_verify($_POST["clave"], $user["contraseña"])){
        /*
        Aquí agregar funcionalidad en caso de que el login sea exitoso
        */
        header("Location: http://localhost/Proyecto/index.html");
        exit;
        //die("Login Succesful");
      }
    }
    $is_invalid = true;
    if($is_invalid){
      $is_invalid = json_encode($is_invalid);
      header("Location: http://localhost/Proyecto/loginerr.html");
        exit;
    }
   
    
  }
    
   













?>