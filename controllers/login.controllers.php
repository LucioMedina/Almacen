<?php

if(!empty($_POST["btnIngresar"])){
    if(empty($_POST["usuario"]) and empty($_POST["claveacceso"])){
        echo "LOS CAMPOS ESTAN VACIOS";
    } else {
        $usuario = $_POST["usuario"];
        $clave = $_POST["claveacceso"];
        $data = $cn->query("CALL spu_verificar_usuarios($usuario, $clave)")
        if($datos = $data->fetch_object()){
            header("location:productos.views.html")
        }else{
            echo "Acceso denegado";
        }
    }
}

?>