Cta Cte Disponibilidades:


* Manejo de Errores: como hago si hago una llamada ajax y vuelve error, la llamada? Como hago para que no salga el error de la llamada ajax y pueda mostrar otra cosa en la consola!  

* Cuando creo una cuenta bancaria, tambien tengo que crear en la CtaCteDisponibilidades, el saldo inicial de la cuenta!

* Como transformar una coleccion, un response de un ajax: quiero eliminar algunos campos del array, quiero agruparlos, quiero que se queden solo los valores unicos de ese array. Ej: en registros/egresos/egresos.js la respuesta de los radio button,$("#impagos").change
* El menu dejarlo cerrado
* Como uso un plugins que instalo con composer? igorescobar/jquery-mask-plugin": "^1.14",
* El encabezado de las tablas de Cta Cte sea fijo, para que no se desplace hacia abajo!
* Tachar las facturas que estan pagas con CSS
* Tabla de Periodos? Como hacer para que pueda diferencia la fecha de los periodos? Quiero registrar una cobranza en el periodo 2017-12, pero que me quede registrado que se pago el 12/01/2018!!
* Home: Cajas: porque aparece primero el input y luego el nombre de las cajas? No funciona jquery numeric!!!!

Liquidador:
	
	VENTAS:
		NUEVO COMPROBANTE:
			* Periodos: Se puede hacer que se pueda manejar con el teclado, con tab o enter, poder seleccionar el periodo?
			* Clientes y proveedores: Falta el ABM, tengo que poder dar de alta un cliente/proveedor desde el formulario de ventas/compras!
			* Punto de Venta y Numero: se tienen que autocompletar con los 0 que falten.
			* El calculo del TOTAL: esta sumando de mas, me parece que el IVA de 2.5% y el gravado al 0%, esta el error! Si cargo algo en grav 2.5 y luego cargo en grav 0%, toma mal los calculos!
			* Otros impuestos: La solapa GAS, cambiar los "Imp. Combustibles"
			* Cuando Guarde un comprobante, el campo total no se volvio a cero, quedo con el valor del ultimo comprobante.
			* Cuando Guardo correctamente, el Campo SUC: Sale el cartel: "Ya esta registrado este comprobante para esta Empresa", pero el comprobante se guardo y no es real que este duplicado!
			* Cuando guardo un comprobante, se tienen que mantener los siguientes campos: (estos es para que sea mas rapido la carga de comprobantes!)
				* Periodo
				* Cliente
				* Punto de Venta
				* Tipo de comprobante
				* Zona y Actividad: Tienen que ser los predeterminados en configuracion de la empresa
		
		EDICION DE COMPROBANTE:
			* No levanta los campos de IVA -INGRESOS BRUTOS, y los de OTROS IMPUESTOS: es decir, todos los campos numericos y campos calculados no los levanta!
			* Los radio Button de GRAV IIBB, no los levanta en el estado en que fueron guardados!!!, los levanta todo como su default!
			* No guarda los cambios, porque no hay valores en los input numericos.

		ELIMINAR:
			* No funciona Eliminar! No funcionana ni el boton de Editar ni el de eliminar en el MODAL de ELiminar!
			
	COMPRAS:
		NUEVO COMPROBANTE:
			* El calculo del TOTAL: esta sumando de mas, me parece que el IVA de 2.5% y el gravado al 0%, esta el error! Si cargo algo en grav 2.5 y luego cargo en grav 0%, toma mal los calculos!
			* Cuando Guarde un comprobante, el campo total no se volvio a cero, quedo con el valor del ultimo comprobante.
			* Cuando Guardo correctamente, el Campo SUC: Sale el cartel: "Ya esta registrado este comprobante para esta Empresa", pero el comprobante se guardo y no es real que este duplicado!
			* El mensaje de Fecha Invalida y "Ya esta registrado este comprobante para esta Empresa", no desaparecen!!! Tengo que volver a cerrar, para que se vayan!
		
	RETENCIONES:
		NUEVO COMPROBANTE:
			* El campo TIPO, el SELECT debe traer: Las opciones estan duplicadas. Las opciones deben ser: Retenciones de .... (una por cada localidad) + Retenciones de IVA + Retenciones de Ganancias + Retenciones de SUSS.
		EDICION DE COMPROBANTE:
			* Cuando Edito y Guarda: Se tiene que cerrar el modal o borrarse los campos!
		ELIMINAR:
			* No funciona Eliminar! No funcionana ni el boton de Editar ni el de eliminar en el MODAL de ELiminar!

	SIRCREB - COMPENSACION - ANTICIPO DE GANANCIAS: El Datatable, no muestra el listado de SIRCREB!!! Muestra otra cosa!
		NUEVO COMPROBANTE:
			* Cuando Guarde un comprobante, el campo total no se volvio a cero, quedo con el valor del ultimo comprobante.
		EDICION Y ELIMINACION: No lo puedo probar, porque no lo lista!

	

	
Cosas para el futuro!!!

CONFIGURACION de las empresas:
		* Zonas y Actividad: Se tiene que definir como minimo una zona y una actividad, Si es una sola, es la predeterminada, si son mas de una, se tiene que tomar y que muestre que la primera va a ser la PREDETERMINADA, para que salgan estos valores en los formularios de comprobantes!

		* Periodos: Debe haber un listado de periodos, donde cargar los saldos iniciales.


	* Reportes de libros IVA COMPRAS Y VENTAS: Que salga con el formato para imprimir los libros societarios, que acumule en menos campos todos los campos del informe.
	* Checkbox que se pueda tildar y se pueda eliminar todos los tildados.
	* Eliminacion MASIVA: Eliminar todas las compras, ventas de un periodo de un solo plumazo!

