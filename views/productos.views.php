<?php
/*
session_start();
if (!isset($_SESSION['login']) || !$_SESSION['login']['status']){
    header("Location:../");
}
*/
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Almacen</title>

  <!-- BS5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</head>
<body>
  
  <div class="container">
    <h1>Productos del Almacen</h1>

    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal-buscador">Buscar producto</button>
    <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modal-categoria">Ver Categorias</button>
    <hr>
    <div class="container">
      <div class="row mt-3">
        <!--Formulario-->
        <div class="col-md-4">
          <form action="" autocomplete="off" id="form-productos">
            <div class="card">
              <div class="card-header">
                Registro de productos
              </div>
              <div class="card-body">
                <div class="mb-3">
                  <label for="categoria" class="form-label">ID Categoria</label>
                  <input type="text" class="form-control form-control-sm" id="idCategoria">
                </div>
                <div class="mb-3">
                  <label for="nombre" class="form-label">Nombre</label>
                  <input type="text" class="form-control form-control-sm" id="nombre">
                </div>
                <div class="mb-3">
                  <label for="descripcion" class="form-label">Descripción</label>
                  <input type="text" class="form-control form-control-sm" id="descripcion">
                </div>
                <div class="mb-3">
                  <label for="precio" class="form-label">Precio</label>
                  <input type="number" class="form-control form-control-sm" id="precio">
                </div>
                <div class="mb-3">
                  <label for="stock" class="form-label">Stock</label>
                  <input type="number" class="form-control form-control-sm" id="stock">
                </div>
                <div class="card-footer text-muted">
                  <div class="d-grid gap-2">
                    <button class="btn btn-sm btn-success" id="btGuardar" type="button">Guardar</button>
                    <button class="btn btn-sm btn-secondary" type="reset">Reiniciar</button>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      <!--Fin Formulario-->
        <div class="col-md-8">
          <table id="tablaProductos" class="table table-striped">
            <thead class="bg-primary text-white">
              <tr>
                <th>ID Producto</th>
                <th>Categoria</th>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Comand</th>
              </tr>
            </thead>
            <tbody>
      
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

<!-- Zona de MODALES -->
<div class="modal fade" tabindex="-1" id="modal-buscador" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title">Buscador de productos</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <form action="" id="formulario-busqueda">
                  <label for="idbuscado" class="form-label">Escriba ID:</label>
                  <div class="input-group mb-3">
                      <input type="search" class="form-control" id="idbuscado">
                      <button type="button" class="btn btn-primary" id="boton-buscar">Buscar</button>
                  </div>
                  <div class="mb-3">
                      <label for="apellidos" class="form-label">Nombre:</label>
                      <input type="text" class="form-control" id="nombreproducto" readonly>
                  </div>
                  <div class="mb-3">
                    <label for="apellidos" class="form-label">Categoria:</label>
                    <input type="text" class="form-control" id="nombreproducto" readonly>
                </div>
                  <div class="mb-3">
                      <label for="nombres" class="form-label">Descripción:</label>
                      <input type="text" class="form-control" id="descripcion" readonly>
                  </div>
                  <div class="mb-3 d-flex align-items-center">
                    <div class="col">
                      <label for="precio" class="form-label">Precio:</label>
                      <input type="text" class="form-control" id="precio" readonly>
                    </div>
                    <div class="col">
                      <label for="stock" class="form-label">Stock:</label>
                      <input type="text" class="form-control" id="stock" readonly>
                    </div>
                  </div>
              </form>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          </div>
      </div>
  </div>
</div>
<!-- Fin zona de modales -->

<!-- Zona de MODALES CATEGORIA -->
<div class="modal fade" tabindex="-1" id="modal-categoria" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title">Categorias</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <form action="" id="formulario-categorias">
                  <table id="tablaCategorias" class="table table-striped">
                    <thead class="bg-info">
                      <tr>
                        <th>ID Categoria</th>
                        <th>Nombre</th>
                      </tr>
                    </thead>
                    <tbody id="BodyCate">
              
                    </tbody>
                  </table>
              </form>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          </div>
      </div>
  </div>
</div>
<!-- Fin zona de modales -->

<script>
  document.addEventListener("DOMContentLoaded", () =>{
    const btGuardar = document.querySelector("#btGuardar");
    const tabla = document.querySelector("#tablaProductos");
    const cuerpoTabla = document.querySelector("tbody");
    const cuerpoTablaCate = document.querySelector("#BodyCate")
    const CateTabla = document.querySelector("#tablaCategorias");

    function listarProductos(){
      const parametros = new URLSearchParams();
      parametros.append("operacion", "listarProductos");

      fetch("../controllers/productos.controllers.php", {
      method: 'POST',
      body: parametros
      })
        .then(respuesta => respuesta.json())
        .then(datos =>{
          cuerpoTabla.innerHTML = ``;
          datos.forEach(element => {
            const fila = `
            <tr>
              <td>${element.idproducto}</td>
              <td>${element.nombrecategoria}</td>  
              <td>${element.nombreproducto}</td>  
              <td>${element.descripcion}</td>  
              <td>${element.precio}</td>
              <td>${element.stock}</td>
            </tr>
            `;
            cuerpoTabla.innerHTML += fila;
          })
        })
    }

    function listarCategorias(){
      const parametros = new URLSearchParams();
      parametros.append("operacion", "listarCategorias");

      fetch("../controllers/categorias.controllers.php", {
        method: 'POST',
        body: parametros
      })
      .then(respuesta => respuesta.json())
      .then(datos =>{
        cuerpoTablaCate.innerHTML = ``;
        datos.forEach(element => {
          const fila = `
          <tr>
            <td>${element.idcategoria}</td>  
            <td>${element.nombrecategoria}</td>  
          </tr>
          `;
          cuerpoTablaCate.innerHTML += fila;
        })
      })
    }

    function registrarProductos(){
      if(confirm("¿Estás seguro de grabar?")){
        const parametros = new URLSearchParams();
        parametros.append("operacion", "registrarProductos");
        parametros.append("idcategoria", document.querySelector("#idCategoria").value);
        parametros.append("nombreproducto", document.querySelector("#nombre").value);
        parametros.append("descripcion", document.querySelector("#descripcion").value);
        parametros.append("precio", document.querySelector("#precio").value);
        parametros.append("stock", document.querySelector("#stock").value);

        fetch("../controllers/productos.controllers.php",{
          method: 'POST',
          body: parametros
        })
        .then(response => response.json())
        .then(datos => {
          if(datos.status){
            document.querySelector("#form-productos").reset();
            listarProductos();
          }else{
            alert(datos.message);
          }
        });
      }
    }

    btGuardar.addEventListener("click", registrarProductos);

    function buscarProductos(){
      const parametros = new URLSearchParams();
    }
    
    listarCategorias();
    listarProductos();
    
  })

</script>

</body>
</html>