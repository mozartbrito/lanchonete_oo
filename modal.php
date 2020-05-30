

    <!-- modal sacola de produtos -->
      <div class="modal fade" id="modalFinaliza" tabindex="-1" role="dialog" aria-labelledby="labelCompra" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="labelCompra">Finalizar compra</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <table class="table">
                <tr>
                  <th>#</th>
                  <th>Descrição</th>
                  <th>Valor</th>
                  <th>Qtd</th>
                  <th>Subtotal</th>
                  <th>Ação</th>
                </tr>
                <?php $total = 0;
                $n = 1;
                if(isset($_SESSION['compras'])) {
                foreach ($_SESSION['compras'] as $key => $compra) : ?>
                <tr>
                  <td>#<?= $n; ?></td>
                  <td><?= $compra['nome_produto']; ?></td>
                  <td>R$ <?= $compra['preco_produto']; ?></td>
                  <td><?= $compra['qtd_produto']; ?></td>
                  <td>R$ <?= number_format(($compra['qtd_produto'] * $compra['val_produto']),2,',','.'); ?></td>
                  <td>
                    <a href="adiciona_produto.php?acao=removerItem&key=<?= $key; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Deseja remover o item da sacola?')">
                      <i class="fas fa-trash"></i>
                    </a>
                  </td>
                </tr>
                <?php
                  $n++; 
                  $total += ($compra['qtd_produto'] * $compra['val_produto']);
                endforeach;
                } ?>
                <tr>
                  <th colspan="3" class="text-right">Total</th>
                  <th colspan="3" class="text-left">R$ <?= number_format($total,2,',','.') ?></th>
                </tr>
              </table>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
              <?php 
                if(!isset($_SESSION['perfil'])) {
                    $msg =  'Você não está logado, por favor inicie uma sessão.';
                  ?>
                    <a class="btn btn-primary" href="login.php?tipo=finaliza&msg=<?= $msg ?>">Finalizar compra</a>
                  <?php
                    } else if(isset($_SESSION['perfil'])) {
                  ?>
                  <a class="btn btn-primary" href="finaliza_compra.php">Finalizar compra</a>
                <?php } ?>
            </div>
          </div>
        </div>
      </div>
    <!-- /modal sacola de produtos -->