var tabla;

// Función que se ejecuta al inicio
function init() {
    mostrarform(false);
    listar();

    $("#formulario").on("submit", function(e) {
        guardaryeditar(e);
    });
}

// Función para limpiar los campos
function limpiar() {
    $("#id_rol").val("");
    $("#nombre_rol").val("");
}

// Función para mostrar el formulario
function mostrarform(flag) {
    limpiar();
    if (flag) {
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
function cancelarform() {
    limpiar();
    mostrarform(false);
}

// Función para listar los roles
function listar() {
    tabla = $('#tbllistado').dataTable({
        "aProcessing": true, // Activamos el procesamiento del datatable
        "aServerSide": true, // Paginación y filtrado realizados por el servidor
        "ajax": {
            url: '../ajax/roles.php?op=listar',
            type: "get",
            dataType: "json",
            error: function(e) {
                console.log(e.responseText);
            }
        },
        "bDestroy": true,
        "iDisplayLength": 10, // Paginación
        "order": [[0, "desc"]] // Ordenar (columna, orden)
    }).DataTable();
}

// Función para guardar o editar un rol
function guardaryeditar(e) {
    e.preventDefault(); // No activar la acción predeterminada del formulario
    var formData = new FormData($("#formulario")[0]);

    $.ajax({
        url: "../ajax/roles.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        success: function(datos) {
            bootbox.alert(datos);
            mostrarform(false);
            tabla.ajax.reload();
        }
    });
    limpiar();
}

// Función para mostrar un rol
function mostrar(id_rol) {
    $.post("../ajax/roles.php?op=mostrar", {id_rol: id_rol}, function(data, status) {
        data = JSON.parse(data);
        mostrarform(true);

        $("#nombre_rol").val(data.Nombre_Rol);
        $("#id_rol").val(data.Id_Rol);
    });
}

// Función para eliminar un rol
function eliminar(id_rol) {
    bootbox.confirm("¿Está seguro de eliminar el rol?", function(result) {
        if (result) {
            $.post("../ajax/roles.php?op=eliminar", {id_rol: id_rol}, function(e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    });
}

init();
