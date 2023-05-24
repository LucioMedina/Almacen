<?php

require_once "Conexion.php";

class Producto extends Conexion{
  
  private $conexion;

  public function __CONSTRUCT(){
    $this->conexion = parent::getConexion();
  }

  public function listarProductos(){
    try{
      $consulta = $this->conexion->prepare("CALL spu_listar_productos()");
      $consulta->execute();
      $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);

      return $datos;

    }catch(Exception $e){
      die($e->getMessage());
    }
  }

  public function registrarProductos($datosProductos=[]){

    $respuesta=[
      "status" => false,
      "message" => ""
    ];

    try{
      $consulta = $this->conexion->prepare("CALL spu_registrar_productos(?,?,?,?,?)");
      $respuesta["status"] = $consulta->execute(array(

        $datosProductos['idcategoria'],
        $datosProductos['nombreproducto'],
        $datosProductos['descripcion'],
        $datosProductos['precio'],
        $datosProductos['stock'],
      ));

    }catch(Exception $e){
      $respuesta["message"] = "No se pudo completar el proceso de registro. Código de error: ".$e->getMessage();
    }
    return $respuesta;

  }

  public function eliminarProductos ($idproducto = 0){
    $respuesta = [
      "status"  => false,
      "message" => ""
    ];
    try {
      $consulta = $this->conexion->prepare("CALL spu_eliminar_productos(?)");
      $respuesta["status"] = $consulta->execute(array($idproducto));
    }
    catch (Exception $e) {
      $respuesta["message"] = "No se ha podido completar el proceso. Código error: " . $e->getCode();
    }

    return $respuesta;
  }

  public function actualizarProductos($datosProductos=[]){
    $respuesta = [
      "status"  => false,
      "message" => ""
    ];
    try {
      $consulta = $this->conexion->prepare("CALL spu_actualizar_productos(?,?,?,?,?)");
      $respuesta["status"] = $consulta->execute(
        array(
          $datosProductos["idproducto"],
          $datosProductos["nombreproducto"],
          $datosProductos["descripcion"],
          $datosProductos["precio"],
          $datosProductos["stock"]
        )
      );
    }
    catch (Exception $e) {
      $respuesta["message"] = "No se ha podido completar el proceso. Código error: " . $e->getCode();
    }
    return $respuesta;
  }

  public function obtenerProductos($idproducto = 0){
    try {
      $consulta = $this->conexion->prepare("CALL spu_obtener_productos(?)");
      $consulta->execute(array($idproducto));
      return $consulta->fetch(PDO::FETCH_ASSOC);
    }
    catch (Exception $e) {
      $respuesta["message"] = "No se ha podido completar el proceso. Código error: " . $e->getCode();
    }

    return $respuesta;
  }
}