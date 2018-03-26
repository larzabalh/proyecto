<footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.3.0
    </div>
    <strong>Copyright &copy; 2013-2017 <a href="www.tucontadorpublico.com.ar">FINANZAS</a>.</strong> All rights reserved.
</footer>

<!-- jQuery -->
<!-- <script src="/plugins/js/jquery-3.1.1.min.js"></script> -->
<script src="http://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
<script src="/plugins/plugins/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
<script type="text/javascript" src="/plugins/js/jquery.numeric.js"></script>


<!-- Bootstrap 3.3.5 -->
<script src="/plugins/js/bootstrap.min.js"></script>


<!-- AdminLTE App -->
<script src="/plugins/js/app.min.js"></script>

<!-- DATATABLES -->
<script src="/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/plugins/datatables/dataTables.buttons.min.js"></script>
<script src="/plugins/datatables/buttons.html5.min.js"></script>
<script src="/plugins/datatables/buttons.colVis.min.js"></script>
<script src="/plugins/datatables/jszip.min.js"></script>
<script src="/plugins/datatables/pdfmake.min.js"></script>
<script src="/plugins/datatables/vfs_fonts.js"></script>

<script src="/plugins/js/bootbox.min.js"></script>
<script src="/plugins/js/bootstrap-select.min.js"></script>



<script src="/plugins/plugins/pickdate/picker.js"></script>
<script src="/plugins/plugins/pickdate/picker.date.js"></script>
<script src="/plugins/plugins/pickdate/translations/es_ES.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>



<!-- LO HAGO PARA DEFINIR LA FECHA ACTUAL A TODOS LOS INPUT DEL TIPO DATE -->
<script type="text/javascript">
Date.prototype.toDateInputValue = (function() {
    var local = new Date(this);
    local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
    return local.toJSON().slice(0,10);
});
</script>

<!-- SELECT2 -->
<!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script> -->
<!-- CON ESTO HAGO SELECT2 A TODOS LOS SELECT!!!! -->
<!-- <script type="text/javascript">
$(document).ready(function(){$("select").select2({ width: '100%' });});
</script>
 -->

<!-- Esto es para que todos los input number, sean numericos!!!! -->
<script type="text/javascript">
$(':input[type="number"]').numeric();
</script>

<!-- FORMATO DE MONEDA -->
<script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
<script type="text/javascript">
  numeral.register('locale', 'ar', {
      delimiters: {
          thousands: '.',
          decimal: ','
      },
      currency: {
          symbol: '$'
      }
  });
  numeral.locale('ar');
</script>
<!-- OTRO FORMATO DE MONEDA -->
<script type="text/javascript">
var formatNumber = {
 separador: ".", // separador para los miles
 sepDecimal: ',', // separador para los decimales
 formatear:function (num){
 num +='';
 var splitStr = num.split('.');
 var splitLeft = splitStr[0];
 var splitRight = splitStr.length > 1 ? this.sepDecimal + splitStr[1] : '';
 var regx = /(\d+)(\d{3})/;
 while (regx.test(splitLeft)) {
 splitLeft = splitLeft.replace(regx, '$1' + this.separador + '$2');
 }
 return this.simbol + splitLeft +splitRight;
 },
 new:function(num, simbol){
 this.simbol = simbol ||'';
 return this.formatear(num);
 }
}
</script>

<script type="text/javascript">

function ajax (url, callback) {
  var request = new XMLHttpRequest()
  request.onreadystatechange = function () {
    if (this.readyState == 4) {
      if (this.status == 200) {
        callback(null, JSON.parse(this.response))
      } else {
        callback(Error(this.status))
      }
    }
  }
  request.open('GET', url)
  request.send()
};

</script>
</body>
</html>
