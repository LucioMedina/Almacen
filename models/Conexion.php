<?php

class Conexion{

//guarda la conexion
  protected $pdo;


  private function Conectar(){
      $cn = new PDO("mysql:host=localhost;port=3306;dbname=ALMACEN;charset=utf8","root","");

    return $cn;
  }


  public function getConexion(){
    try{
      $pdo = $this->Conectar();
      $pdo->setAttribute(PDO::ATTR_ERRMODE, pdo::ERRMODE_EXCEPTION);
      return $pdo;

    }catch(Exception $e){
      die($e->getMessage());
    }
  }

} //fin de la conexión