<?php
/**
 * Created by PhpStorm.
 * User: ruldin
 * Date: 16/08/2019
 * Time: 4:50 PM
 */

session_start();
include ('conexion.php');

if (!isset($_SESSION['USUARIO_LOGUEADO'])){

    echo'<script type="text/javascript">  alert("usted no está logueado"); window.location.href="index.html";   </script>';
}
$curriculum =$_FILES['user']['name'];
$guardado =$_FILES['user']['tmp_name'];
$CORREO=strtoupper($_POST ['LOGIN']);
$NOMBRECOMPLETO =strtoupper($_POST ['NOMBRECOMPLETO']);
$MOTIVO = $_POST ['MOTIVO'];
$RUTA='PDF/'.$curriculum;
$extension=substr($curriculum,strlen($curriculum)-4);
if (strcmp($extension,'.pdf')!==1){
    if (!file_exists('PDF')){
        mkdir('PDF', 0777,true);
        if (file_exists('PDF')){
                move_uploaded_file($guardado,'PDF/'.$curriculum);
        }
    }else{
            move_uploaded_file($guardado,'PDF/'.$curriculum);
    }
    $query = "Insert into tb_solicitud (nombreingresa,correoingresa,rutapdf,nombrearchivo,motivo) values ('".$NOMBRECOMPLETO."','".$CORREO."','".$RUTA."','".$curriculum."','".$MOTIVO."')" or die("Error en la insercion.." . mysqli_error(conectar()));
    $resultado=mysqli_query(conectar(),$query);
    echo "<br> INFORMACION GRABADA CON EXITO!!";
}else{
    echo '<script languaje="JavaScript">alert(\'suba un archivo pdf\'); window.location.href=\'solicitud.php\';</script>';

}
mysqli_close(conectar());
?>
