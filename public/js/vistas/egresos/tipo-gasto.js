//Las funciones de datatable y ajax, las tengo en Footer

function init()
{
  // Return today's date and time
  var currentTime = new Date()
  // returns the month (from 0 to 11)
  var month = currentTime.getMonth() + 1
  // returns the day of the month (from 1 to 31)
  var day = currentTime.getDate()
  // returns the year (four digits)
  var year = currentTime.getFullYear()
  var periodo = year+"-"+month

  $("#periodo").append("<option selected value='"+periodo+"'>"+periodo+"</option>");

  var url = "tipo_gasto/"+periodo+"";
  datatable(url);

  ajax(url, function (err, response) {
        if (err) return console.error(err)

        console.log("response", response)

        var saldo = response.data.reduce(function (accum, current) {
          return accum + current.importe
        }, 0)

        document.getElementById('gasto').innerText = numeral(saldo).format('$0,0.00')
      });

};



$("#periodo").change(function(e){
var periodo = document.getElementById("periodo").value;
var url = "tipo_gasto/"+periodo+"";
var saldo =0;

    datatable(url);
    ajax(url, function (err, response) {
          if (err) return console.error(err)

          console.log("response", response)

          var saldo = response.data.reduce(function (accum, current) {
            return accum + current.importe
          }, 0)

          document.getElementById('gasto').innerText = numeral(saldo).format('$0,0.00')
        });
});

init();
