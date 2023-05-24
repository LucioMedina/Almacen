<?php

require_once '../models/productos.models.php';

if (isset($_POST['operacion'])){

  $Producto = new Producto();

  if ($_POST['operacion'] == 'listarProductos'){

    $datos = $Producto->listarProductos();

    echo json_encode($datos);

  }

  if($_POST['operacion'] == 'registrarProductos'){
    $datosSolicitados=[
        "idcategoria"      =>$_POST['idcategoria'],
        "nombreproducto"   =>$_POST['nombreproducto'],
        "descripcion"      =>$_POST['descripcion'],
        "precio"           =>$_POST['precio'],
        "stock"            =>$_POST['stock']
    ];
    $respuesta = $Producto->registrarProductos($datosSolicitados);
    echo json_encode($respuesta);
  }

  if($_POST['operacion'] == 'eliminarProductos'){
    $respuesta = $Producto->eliminarProductos($_POST['idproducto']);
    echo json_encode($respuesta);
  }

  if($_POST['operacion'] == 'actualizarProductos'){
    $datosActualizar = [
      "idproducto"     => $_POST['idproducto'],
      "nombreproducto"  => $_POST['nombreproducto'],
      "descripcion"     => $_POST['descripcion'],
      "precio"          => $_POST['precio'],
      "stock"           => $_POST['stock']
    ];

    $respuesta = $Producto->actualizarProductos($datosActualizar);
    echo json_encode($respuesta);
  }

  if($_POST['operacion'] == 'obtenerProductos'){
    $respuesta = $Producto->obtenerProductos($_POST['idproducto']);
    echo json_encode($respuesta);
  }
}