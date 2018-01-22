


/*ALTA DE REGISTROS!!!*/
/*1- Inserto una fila para que pueda registrar*/
$('#add').click(function(){
	var html = '<tr>';
	html += '<td contenteditable id="data1"></td>';
	html += '<td contenteditable id="data2"></td>';
	html += '<td><button type="button" name="insert" id="insert" class="btn btn-success btn-xs">INSERTAR</button> <button type="button" name="cancelar" id="cancelar" class="btn btn-primary btn-xs">CANCELAR</button></td>';
	html += '</tr>';
	$('#tabla_datos tbody').prepend(html);
});

