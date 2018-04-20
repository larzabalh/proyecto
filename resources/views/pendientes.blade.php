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


Forge Laravel:

Contraseña de Sudo: pedro16ana
Contraseña de base de datos: 4T5oUq6bYPfUgxrD7D8d


Clave publica
ssh-rsa AAAAB3NzaC1yc2EAAAABJQAAAQEAi9fQ7Jpma/+Nkh2qSLDHk/pHTzRcK4w0hOQy/+CRYlKCryaeVCrlj1N5nQdsVPo3PcvW9ZgNLL8qmMx6akZno9UVV37BcAOU6Hyrr7itdI/44wgaQKwq5jUZUc1QO+zJyhpAGGN49mfPNrW7wCU1eZevbGaTyyfWv0N7Q8gxmFT46dtLl3zdLKYqpVC3339pvElUzWzgyfFKHTNil5/bK18SDfYjCKR9zCAX+fsKLkerQQAt1Hl2o0ce3v3VNaL1EyPYz58lIQYADSoPJF5zOk/+PDXAAICnBW479173OD5CIcd7P8NrmVCWT0MMS9ksBQbqSb5nITjNrR3a3Xop/w== rsa-key-20180420