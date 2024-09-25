var tabla;

// Función que se ejecuta al inicio
function init() {
    mostrarform(false);
    listar();
}

// Función para limpiar el formulario
function limpiar() {
    $("#id_permiso").val("");
    $("#nombre_permiso").val("");
    $("#id_rol").val(""); 
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

// Función listar
function listar() {
    tabla = $('#tbllistado').dataTable({
        "aProcessing": true, // Activamos el procesamiento del datatable
        "aServerSide": true, // Paginación y filtrado realizados por el servidor
        dom: 'Bfrtip', // Definimos los elementos del control de la tabla
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdf'
        ],
        "ajax": {
            url: '../ajax/permiso.php?op=listar',
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

// Función para guardar o editar
function guardaryeditar(e) {
    e.preventDefault(); // No se activará la acción predeterminada
    $("#btnGuardar").prop("disabled", true);
    var formData = new FormData($("#formulario")[0]);

    $.ajax({
        url: "../ajax/permiso.php?op=guardaryeditar",
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

// Función para mostrar los datos de un permiso para editar
function mostrar(id_permiso) {
    $.post("../ajax/permiso.php?op=mostrar", {id_permiso: id_permiso}, function(data, status) {
        data = JSON.parse(data);
        mostrarform(true);

        $("#nombre_permiso").val(data.Nombre_Permiso);
        $("#id_rol").val(data.Id_Rol);
        $("#id_permiso").val(data.Id_Permiso);
    });
}

// Función para eliminar un permiso
function eliminar(id_permiso) {
    bootbox.confirm("¿Está seguro de eliminar este permiso?", function(result) {
        if (result) {
            $.post("../ajax/permiso.php?op=eliminar", {id_permiso: id_permiso}, function(e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    });
}

init();
