* Cuando creo una cuenta bancaria, tambien tengo que crear en la CtaCteDisponibilidades, el saldo inicial de la cuenta!


* Poner el proyecto del Sistema en GIT para que tenga acceso por ahi con Juan Carlos o como hago para descargar todo el proyecto?

* El encabezado de las tablas de Cta Cte sea fijo, para que no se desplace hacia abajo!
* Tabla de Periodos? Como hacer para que pueda diferencia la fecha de los periodos? Quiero registrar una cobranza en el periodo 2017-12, pero que me quede registrado que se pago el 12/01/2018!!
* Tachar las facturas que estan pagas con CSS


* Manejo de Errores: como hago si hago una llamada ajax y vuelve error, la llamada? Como hago para que no salga el error de la llamada ajax y pueda mostrar otra cosa en la consola! para que no se frene el flujo del js?
* El menu dejarlo cerrado
* Como uso un plugins que instalo con composer? igorescobar/jquery-mask-plugin": "^1.14",
* Home: Cajas: porque aparece primero el input y luego el nombre de las cajas? No funciona jquery numeric!!!!
* No funcionan las mascaras de jquery. Home ->cajas. Los inputs creados por desde js, no estan funcionando como quiero
* Como hago para reemplar la palabra "caja" de la linea 45 de Egresos.js de registros/egresos/egresos, por un parametro que se lo quiera pasar?
* no puedo configurar el mail!!! Y salen dos peticiones ajax

* DATEPICKER: no puedo hacer que ande, ahora me sale este error en la parte de Cheques, cuando edito: f.getClientRects is not a function
* Como hacer para manejar las fechas? para cargarlas cuandos las edito?
* Cuando hago un edit? Traigo de la base de datos o de la tabla? todo lo que es datatable, lo estoy trayendo de la tabla, por eso las fechas vienen con formato texto!


NO ME ANDUVO!!!!
/*=============================================
Pluggin para recorrer todo los input y mostrarlos en un id- HOME!!!!
    $.SumarInputs ({selectorInputs: ".deudaImpagos"})
=============================================*/

(function(){

  $.SumarInputs = function ( opciones ){

      opciones = $.extend({
        selectorInputs:"",
      }, opciones );
      console.log (opciones.selectorInputs)

      var total = recorrer(opciones.selectorInputs)
  
      console.log(total)
  }

    function recorrer(selectorInputs){
      
      return $(selectorInputs).change(function(e){
                      console.log('acaestoy adentro')
                         var total = 0;
                       
                        $(selectorInputs).each(function() {
                              this.value= this.value=="" ? 0 : this.value;
                               total += parseFloat(this.value.replace(',', '.'))
                        });
                          return total
                  });
    }

})();
/*=====  End of Section comment block  ======*/


	
* En este archivo, la funcion de seleccionar todo, no funcionan cuando distildo alguno!!!! public/js/registros/egresos/egresos.js


* los inputs de ingresos masivos que tengan la mask!!!

* como hago para instalar plugins via composer? cual es el NPM? o bower de laravel?

* Servidor de CORREO para mi cuenta de TU CONTADOR PUBLICO.

* Cta cte clientes individuales, no puedo editar!!!

Forge Laravel:
Sudo Password: U0huj2yshPAsfdsM5FBA
Database Password: mG2ZclQtCvXdEnc4uRlu

Acceso a Forge y digitalocean:
  Usuario: larzabalh@hotmail.com
  clave: taxes2018

razielt10/finance


FINANZAS:
Sudo Password: Q20C5HMo0Ld3K4PUbQUO
Database Password: L8OUc4kJjuawQMWpbCOK
DB_DATABASE=finanzas
DB_USERNAME=finanzas
DB_PASSWORD=taxes2018
