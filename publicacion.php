<?php


//Crea un archivo con el titulo especificado en publicacion.html 
//se guarda en la carpeta "publicaciones"
$filepath  = __DIR__."\\publicaciones\\".$_POST["titulo"].".html";
//Abre ese archivo con los permisos para escribir y leer
$file = fopen($filepath,"w+");
//Copia todo el contenido de publicacionTemplate.html ya que es el diseño predefinido 
//y lo pega en nuevo archivo que se creo en la linea 8
copy(__DIR__."\\publicaciones\\publicacionTemplate.html",$filepath);
//Cierra el archivo
fclose($file);
//Crea un objeto tipo DOMDocument 
$dom = new DOMDocument;
//Carga el archivo creado en la linea 8 al objeto $dom
$dom->loadHTMLFile($filepath);

$filepath2  = __DIR__."\\index.html";
//print_r($filepath2);


//Codifica los caracteres especiales obtenidos mediante el $_POST,
//estos datos vienen del form que existe en publicaciones.html
$texto = htmlspecialchars_decode( $_POST["texto"]); 
//Busca el elemento que tiene el id especificado y modifica el valor dentro de ese elemento
$dom->getElementById("contenedor")->nodeValue = htmlspecialchars_decode( $texto);
$dom->getElementById("titulo")->nodeValue = htmlspecialchars_decode( $_POST["titulo"]);
$dom->saveHTMLFile($filepath);
$target_dir = "mediaP/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }

}
// Check if file already exists
/*if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
  }*/
  // Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
  }
  // Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
  } else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
        
      $mysqli= require __DIR__ . "/database.php";
      $sql = "SELECT idimagenes FROM imagenes";
      
        $result  = mysqli_query($mysqli,$sql);
        $row = mysqli_fetch_all($result);
      
        $str = $_FILES["fileToUpload"]["name"];
        $npublicaciones = 0;

                if($row!=NULL){
                        $arr =[];
                        $size = sizeof($row);
                        print_r($size);
                    for($i = 0; $i<sizeof($row);$i++){
                    
                        if($row[$i] != NULL){
                            $npublicaciones++;
                        
                        }
                    
                    }
                    if($size>5){
                        $sql = "SELECT imagen FROM imagenes";
                        
                            $result  = mysqli_query($mysqli,$sql);
                            $row = mysqli_fetch_all($result);
                      $arr[0] = $row[$size-1][0];
                      $arr[1] = $row[$size-2][0];
                      $arr[2] = $row[$size-3][0];
                      $arr[3] = $row[$size-4][0];
                        print_r("  : img1".$arr[0]);
                        print_r("  : img2".$arr[1]);
                        print_r("  : img3".$arr[2]);
                        print_r("  : img4".$arr[3]);
                      $img1= strval($arr[0]);
                      $img2= strval($arr[1]);
                      $img3= strval($arr[2]);
                      $img4= strval($arr[3]);
                     

                    }
                    $sql = "INSERT INTO imagenes (idimagenes,imagen)
                    VALUES ('$npublicaciones','$str')";

                    $mysqli->query($sql);
                    $sql = "SELECT imagen FROM imagenes";
                    $result  = mysqli_query($mysqli,$sql);
                    $row = mysqli_fetch_all($result, MYSQLI_BOTH);
          
                    

                    
                }else{
                    $sql = "INSERT INTO imagenes (idimagenes,imagen)
                    VALUES ('$npublicaciones','$str')";
                    
                    $mysqli->query($sql);
                }
               
      
    } else {
      echo "Sorry, there was an error uploading your file.";
    }
}








//Sin embargo al momento de modificar el archivo creado, el texto obtenido del POST lo ingresa
//como si estuvieran formateados ( &amp; &quot;)





/*$sql = "SELECT idpublicaciones FROM publicaciones ";
$result  = mysqli_query($mysqli,$sql);
$row = mysqli_fetch_all($result, MYSQLI_BOTH);

if($row!=NULL){
    
    
    for($i = 0; $i<sizeof($row);$i++){
     
        if($row[$i] != NULL){
            $npublicaciones++;
        }
    
    }
}


$sql = "INSERT INTO publicaciones (idpublicaciones,publicacion) 
VALUES ('$npublicaciones','$file')";

$mysqli->query($sql);

$sql = "SELECT publicacion FROM publicaciones";
$result  = mysqli_query($mysqli,$sql);
$row = mysqli_fetch_all($result, MYSQLI_BOTH);
print_r($row[0]["publicacion"]);
//$fh = fopen('filename.txt','r');
/*while ($line = fgets($fh)) {
  // <... Do your work with the line ...>
  // echo($line);
}
fclose($fh);*/
//unlink($filepath);
/*<script type="text/javascript"> 
window.location.replace("/Proyecto/index.html");
</script>*/
?>
<script>
localStorage.setItem("img1", "<?=$img1 ?>" );
localStorage.setItem("img2","<?= $img2 ?>");
localStorage.setItem("img3","<?= $img3 ?>");
localStorage.setItem("img4","<?= $img4 ?>");

</script>
