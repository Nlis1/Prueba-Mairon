
$(document).ready(function () {
  $(".FormularioAjax").on("submit", function (e) {
    e.preventDefault(); // ✋ Detiene el envío normal

    const form = $(this);
    const action = form.attr('action'); // Ej: api.php/document/5
    let method = form.attr('method') || "POST";
    method = method.toUpperCase();

    console.log(method)
    let data = {};
    form.serializeArray().forEach(item => {
      if (item.name !== '_method') {
        data[item.name] = item.value;
      }
    });

    if(form.find('input[name="_method"]').val()){
      data._method = form.find('input[name="_method"]').val()
    }

    $.ajax({
      method: method,
      url: action,
      data: data,
      success: function (respuesta) {
        
        if (form.hasClass("BusquedaEliminada")) {
          alert("Busqueda Eliminada");
          location.reload();
        }
        if (form.hasClass("Busqueda")) {
          if(respuesta == ""){
            $("#respuesta-busqueda").html("No se encontro nada");
          }else{
             $("#respuesta-busqueda").html(respuesta);
          }
          form.trigger("reset");
        }
        if (form.hasClass("eliminarDocumento")) {
          alert("Se ha eliminado correctamente.");
          form.closest("tr").remove();

        } if (form.hasClass("ActualizarDocument")) {
          console.log(respuesta)
          alert("Se ha actualizado correctamente el documento.");
          form.find("[name='codigo-up']").val(respuesta[0].DOC_CODIGO);
          
        }else if(form.hasClass("Insertar")){
          alert("Se agrego correctamente al sistema.")
          form.trigger("reset");
        }
      }
    });
  });
});
