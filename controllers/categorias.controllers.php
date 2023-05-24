<?php

require_once '../models/categorias.models.php';

if (isset($_POST['operacion'])){

  $Categoria = new Categoria();

  if ($_POST['operacion'] == 'listarCategorias'){

    $datos = $Categoria->listarCategorias();

    echo json_encode($datos);

  }
}