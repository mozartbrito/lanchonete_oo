</div>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" ></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" ></script>
<script src="https://cdn.rawgit.com/plentz/jquery-maskmoney/master/dist/jquery.maskMoney.min.js" ></script>
<script src="/assets/js/jquery.maskedinput.min.js" ></script>

<script src="/assets/js/highchart/highcharts.js"></script>
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