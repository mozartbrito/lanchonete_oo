<?php include './layout/header.php'; ?>
<?php include './layout/menu.php'; ?>
<?php 
include 'classes/RelatorioDAO.php';
$relatorioDAO = new RelatorioDAO();
$total_clientes = $relatorioDAO->contar('clientes');
$total_produtos = $relatorioDAO->contar('produtos');
$total_vendas_finalidas = $relatorioDAO->contar('vendas', "status = 'Finalizada'");
$total_vendas_pendentes = $relatorioDAO->contar('vendas', "status = 'Pendente'");
$produtos_por_categoria = json_encode($relatorioDAO->contarProdutosCategoria('produtos'));

?>
<div class="row col">
	<h1>Dashboard</h1>
</div>
<div class="row">
	<div class="col-lg-3 col-md-3 col-sm-6">
		<div class="card">
			<div class="card-header">Quantidade Clientes</div>
			<div class="card-body card-dashboard">
				<p class="total"><?= $total_clientes['total'] ?? 0; ?></p>
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-6">
		<div class="card">
			<div class="card-header">Quantidade Produtos</div>
			<div class="card-body card-dashboard">
				<p class="total produtos"><?= $total_produtos['total'] ?? 0; ?></p>
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-6">
		<div class="card">
			<div class="card-header">Vendas Finalizadas</div>
			<div class="card-body card-dashboard">
				<p class="total finalizadas">
					<?= $total_vendas_finalidas['total'] ?? 0; ?>
				</p>
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-6">
		<div class="card">
			<div class="card-header">Vendas Pendentes</div>
			<div class="card-body card-dashboard">
				<p class="total pendente">
					<?= $total_vendas_pendentes['total'] ?? 0; ?>
				</p>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-12">
		<div class="card">
			<div class="card-body">
				<div id="produtos_categoria"></div>
			</div>
		</div>
	</div>
</div>
<?php include './layout/footer.php'; ?>
<script>
	var dadosProdCategoria = JSON.parse( '<?php echo $produtos_por_categoria ; ?>' );

	dataProdCategoria = [];
	for (var x in dadosProdCategoria) {
		dataProdCategoria[x] = {
		  name: dadosProdCategoria[x].categoria,
		  y: parseFloat(dadosProdCategoria[x].total)
		}
	}

	Highcharts.chart('produtos_categoria', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie',
    },
    credits: false,
    title: {
        text: 'Qtd Categorias por produtos'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %'
            }
        }
    },
    series: [{
        name: 'Percentual',
        colorByPoint: true,
        data: dataProdCategoria,
    }]
});
</script>