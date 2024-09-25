var tabla;

// Función que se ejecuta al inicio
function init(){
   mostrarform(false);
   listar();

   $("#formulario").on("submit", function(e) {
      guardaryeditar(e);
   });
}

// Función para limpiar el formulario
function limpiar(){
    $("#id_comunidad").val("");
    $("#nombre_comunidad").val("");
}

// Función para mostrar el formulario
function mostrarform(flag){
    limpiar();
    if(flag){
        $("#listadoregistros").hide();
        $("#formularioregistros").show();
        $("#btnGuardar").prop("disabled", false);
        $("#btnagregar").hide();
    } else {
        $("#listadoregistros").show();
        $("#formularioregistros").hide();
        $("#btnagregar").show();
    }
}

// Función para cancelar el formulario
function cancelarform(){
    limpiar();
    mostrarform(false);
}

// Función para listar las comunidades
function listar(){
    tabla = $('#tbllistado').dataTable({
        "aProcessing": true, // Activa el procesamiento del datatable
        "aServerSide": true, // Paginación y filtrado realizados por el servidor
        dom: 'Bfrtip', // Definimos los elementos del control de la tabla
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdf'
        ],
        "ajax": {
            url: '../ajax/comunidades.php?op=listar',
            type: "get",
            dataType: "json",
            error: function(e){
                console.log(e.responseText);
            }
        },
        "bDestroy": true,
        "iDisplayLength": 10, // Paginación
        "order": [[0, "desc"]] // Ordenar (columna, orden)
    }).DataTable();
}

// Función para guardar o editar
function guardaryeditar(e){
    e.preventDefault(); // No se activará la acción predeterminada
    $("#btnGuardar").prop("disabled", true);
    var formData = new FormData($("#formulario")[0]);

    $.ajax({
        url: "../ajax/comunidades.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        success: function(datos){
            bootbox.alert(datos);
            mostrarform(false);
            tabla.ajax.reload();
        }
    });

    limpiar();
}

// Función para mostrar una comunidad
function mostrar(id_comunidad){
    $.post("../ajax/comunidades.php?op=mostrar", {id_comunidad: id_comunidad}, function(data, status) {
        data = JSON.parse(data);
        mostrarform(true);

        $("#nombre_comunidad").val(data.Nombre_Comunidad);
        $("#id_comunidad").val(data.Id_Comunidad);
    });
}

// Función para desactivar una comunidad
function desactivar(id_comunidad){
    bootbox.confirm("¿Está seguro de desactivar esta comunidad?", function(result){
        if (result) {
            $.post("../ajax/comunidades.php?op=anular", {id_comunidad: id_comunidad}, function(e){
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    });
}

function activar(id_comunidad){
    bootbox.confirm("¿Está seguro de activar esta comunidad?", function(result){
        if (result) {
            $.post("../ajax/comunidades.php?op=activar", {id_comunidad: id_comunidad}, function(e){
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    });
}

init();
