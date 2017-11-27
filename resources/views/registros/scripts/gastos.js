//Función que se ejecuta al inicio
function init(){
    mostrarform(false);

}

//Función mostrar formulario
function mostrarform(flag)
{

    if (flag)
    {
        $("#listadoregistros").hide();
        $("#formularioregistros").show();
        $("#btnGuardar").prop("disabled",false);
        $("#btnagregar").hide();
    }
    else
    {
        $("#listadoregistros").show();
        $("#formularioregistros").hide();
        $("#btnagregar").show();
    }
}

init();
