</div>
<script src="assets/js/jquery-3.3.1.min.js" ></script>
<script src="assets/js/popper.min.js" ></script>
<script src="assets/js/bootstrap.min.js" ></script>
<script src="assets/js/jquery.maskMoney.min.js" ></script>
<script src="/assets/js/jquery.maskedinput.min.js" ></script>

<script src="/assets/js/highchart/highcharts.js"></script>
<script src="/assets/js/highchart/highcharts-3d.js"></script>
<script src="/assets/js/highchart/exporting.js"></script>
<script src="/assets/js/highchart/export-data.js"></script>
<script src="/assets/js/highchart/accessibility.js"></script>


<script>
  $(function() {
    $('.moeda').maskMoney({
        decimal: ",",
        thousands: "."
    });
  });
  $('.telefone').mask("(99) 99999-9999");
  $('.cep').mask("99999-999");
  $('.cpf').mask("999.999.999-99");

  $(function () {
	  $('[data-toggle="tooltip"]').tooltip()
	});
  
</script>
</body>
</html>