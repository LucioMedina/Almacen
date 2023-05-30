<?php
session_start();

$_SESSION["login"] = [];

require_once '../models/usuario.php';

if (isset($_POST['operacion'])){

  $usuario = new Usuario();

  if ($_POST['operacion'] == 'login'){
    
    $datoObtenido = $usuario->login($_POST['usuario']);
    
    $resultado = [
      "status"        => false,
      "apellidos"     => "",
      "nombres"       => "",
      "nivelacceso"   => "",
      "mensaje"       => ""
    ];
    
    if ($datoObtenido){

      $claveEncriptada = $datoObtenido['claveacceso'];
      
      if (password_verify($_POST['claveIngresada'], $claveEncriptada)){
        
        $resultado["status"] = true;
        $resultado["apellidos"] = $datoObtenido["apellidos"];
        $resultado["nombres"] = $datoObtenido["nombres"];
        $resultado["nivelacceso"] = $datoObtenido["nivelacceso"];
      }else{
        
        $resultado["mensaje"] = "Contraseña incorrecta";
      }
    }else{
      
      $resultado["mensaje"] = "No se encuentra el usuario";
    }
    
    $_SESSION["login"] = $resultado;
    
    echo json_encode($resultado);
    
  }

}

if (isset($_GET['operacion']) == 'destroy'){
  session_destroy();
  session_unset();
  header("location:../");
}

?>