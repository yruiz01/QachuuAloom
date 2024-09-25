$("#frmAcceso").on('submit', function(e) {
    e.preventDefault();
    var logina = $("#logina").val();
    var clavea = $("#clavea").val();

    $.post("../ajax/usuario.php?op=verificar", {"logina": logina, "clavea": clavea}, function(data) {
        try {
            var jsonData = JSON.parse(data);
            if (jsonData !== null) {
                $(location).attr("href", "escritorio.php");
            } else {
                bootbox.alert("Usuario y/o contraseña incorrectos.");
            }
        } catch (e) {
            console.log("Error procesando la respuesta: ", e);
            bootbox.alert("Error inesperado, intente de nuevo.");
        }
    }).fail(function(jqXHR, textStatus, errorThrown) {
        console.log("Error en el servidor: ", textStatus, errorThrown);
        bootbox.alert("Error en la conexión con el servidor.");
    });
});
