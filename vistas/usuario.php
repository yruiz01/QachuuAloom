<?php 
// Activamos almacenamiento en el buffer
ob_start();
session_start();
if (!isset($_SESSION['nombre'])) {
  header("Location: login.html");
} else {

require 'header.php';

if ($_SESSION['acceso'] == 1) {
?>
    <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="row">
        <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
          <h1 class="box-title">Usuarios <button class="btn btn-success" onclick="mostrarform(true)" id="btnagregar"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
          <div class="box-tools pull-right">
          </div>
        </div>
        <!--box-header-->
        <!--centro-->
        <div class="panel-body table-responsive" id="listadoregistros">
          <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
            <thead>
              <th>Opciones</th>
              <th>Nombre</th>
              <th>Correo</th>
              <th>Teléfono</th>
              <th>Rol</th>
              <th>Imagen</th>
              <th>Estado</th>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
              <th>Opciones</th>
              <th>Nombre</th>
              <th>Correo</th>
              <th>Teléfono</th>
              <th>Rol</th>
              <th>Imagen</th>
              <th>Estado</th>
            </tfoot>   
          </table>
        </div>

        <div class="panel-body" id="formularioregistros">
          <form action="" name="formulario" id="formulario" method="POST">
            <div class="form-group col-lg-6 col-md-6 col-xs-12">
              <label for="">Nombre Usuario(*):</label>
              <input class="form-control" type="hidden" name="idusuario" id="idusuario">
              <input class="form-control" type="text" name="nombre_usuario" id="nombre_usuario" maxlength="255" placeholder="Nombre de Usuario" required>
            </div>

            <div class="form-group col-lg-6 col-md-6 col-xs-12">
              <label for="">Correo(*):</label>
              <input class="form-control" type="email" name="correo" id="correo" maxlength="255" placeholder="Correo" required>
            </div>

            <div class="form-group col-lg-6 col-md-6 col-xs-12">
              <label for="">Teléfono:</label>
              <input class="form-control" type="text" name="telefono" id="telefono" maxlength="8" placeholder="Teléfono">
            </div>

            <div class="form-group col-lg-6 col-md-6 col-xs-12">
              <label for="">Rol(*):</label>
              <input class="form-control" type="number" name="rol" id="rol" placeholder="Rol del usuario">
            </div>

            <div class="form-group col-lg-6 col-md-6 col-xs-12" id="claves">
              <label for="">Clave(*):</label>
              <input class="form-control" type="password" name="password" id="password" maxlength="255" placeholder="Clave" required>
            </div>

            <div class="form-group col-lg-6 col-md-6 col-xs-12">
              <label for="">Imagen:</label>
              <input class="form-control" type="file" name="imagen" id="imagen">
              <input type="hidden" name="imagenactual" id="imagenactual">
              <img src="" alt="" width="150px" height="120" id="imagenmuestra">
            </div>

            <div class="form-group col-lg-6 col-md-6 col-xs-12">
              <label for="">Estado:</label>
              <select class="form-control" name="estado" id="estado">
                <option value="Activo">Activo</option>
                <option value="Inactivo">Inactivo</option>
              </select>
            </div>

            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
              <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
            </div>
          </form>
        </div>

      </div>
      </div>
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>

<?php 
} else {
  require 'noacceso.php'; 
}
require 'footer.php';
?>
<script src="scripts/usuario.js"></script>
<?php 
}
ob_end_flush();
?>
