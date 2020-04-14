<?php include './layout/header.php'; ?>
<?php include './layout/menu.php'; ?>

<div class="row">
	<div class="col">
		<p>&nbsp;</p>
		<form action="cadastrar_categoria.php" method="post">
			<div class="form-group">
				<label for="id">ID</label>
				<input type="text" class="form-control" name="id" id="id" disabled>
			</div>
			<div class="form-group">
				<label for="nome">Nome</label>
				<input type="text" class="form-control" name="nome" id="nome" required>
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-primary">Salvar</button>
			</div>
		</form>
	</div>
</div>

<?php include './layout/footer.php'; ?>