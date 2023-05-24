<?php

require_once "Conexion.php";

class Categoria extends Conexion{
  
  private $conexion;

  public function __CONSTRUCT(){
    $this->conexion = parent::getConexion();
  }

  public function listarCategorias(){
    try{
      $consulta = $this->conexion->prepare("CALL spu_listar_categorias()");
      $consulta->execute();
      $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);

      return $datos;

    }catch(Exception $e){
      die($e->getMessage());
    }
  }
}