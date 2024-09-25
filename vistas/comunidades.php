<?php
// Activamos almacenamiento en el buffer
ob_start();
session_start();
if (!isset($_SESSION['nombre'])) {
  header("Location: login.html");
} else {

require 'header.php';

if ($_SESSION['comunidades'] == 1) { // Cambiar permisos según corresponda

?>
    <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="row">
        <div class="col-md-12">
      <div class="box">
<div class="box-header with-border">
  <h1 class="box-title"><i class="fa fa-th-large"></i> Comunidades <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
  <div class="box-tools pull-right">
    
  </div>
</div>
<!--box-header-->
<!--centro-->
<div class="panel-body table-responsive" id="listadoregistros">
  <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
    <thead>
              <th>Opciones</th>
              <th>Nombre de la Comunidad</th>
    </thead>
    <tbody>
    </tbody>
    <tfoot>
              <th>Opciones</th>
              <th>Nombre de la Comunidad</th>
    </tfoot>   
  </table>
</div>
<div class="panel-body" style="height: 400px;" id="formularioregistros">
  <form action="" name="formulario" id="formulario" method="POST">
    <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">Nombre de la Comunidad</label>
      <input class="form-control" type="hidden" name="id_comunidad" id="id_comunidad">
      <input class="form-control" type="text" name="nombre_comunidad" id="nombre_comunidad" maxlength="255" placeholder="Nombre de la Comunidad" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" required>
    </div>

    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
      <button class="btn btn-danger" onclick="cancelarform()" type="button" id="btnCancelar"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
    </div>
  </form>
</div>
<!--fin centro-->
      </div>
      </div>
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>

  <!-- fin Modal-->
<?php 
} else {
  require 'noacceso.php'; 
}

require 'footer.php';
?>
<script src="scripts/comunidades.js"></script> <!-- Cambiar el script a comunidades.js -->
<?php 
}

ob_end_flush();
?>
