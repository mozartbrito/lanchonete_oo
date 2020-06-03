<?php
include_once('header.php');
include_once('menu.php');
include_once('slides.php');

include_once('admin/classes/Produto.php');
include_once('admin/classes/ProdutoDAO.php');
require 'admin/classes/Categoria.php';
require 'admin/classes/CategoriaDAO.php';
require 'admin/classes/Imagem.php';
require 'admin/classes/ImagemDAO.php';

$produtoDAO = new ProdutoDAO();
if(isset($_GET['categoria']) && $_GET['categoria'] != 'todas') {
  $filtra_categoria = $_GET['categoria'];
  $search = "";
  $where = " categoria = '$filtra_categoria'";
  $produtos = $produtoDAO->filtrar($where);
} else if(isset($_GET['search']) && $_GET['search'] != '') {
  $search = $_GET['search'];
  $filtra_categoria = "";
  $where = " p.nome like '%$search%' OR p.descricao like '%$search%'";
  $produtos = $produtoDAO->filtrar($where);
} else {
  $filtra_categoria = "";
  $search = "";
  $produtos = $produtoDAO->listar();
}


$categoriaDAO = new CategoriaDAO();
$imagemDAO = new ImagemDAO();
$categorias = $categoriaDAO->listar();
?>
<main class="container">
      <div class="row titulo-cardapio" id="titulo-cardapio">
        <div class="col-md-4">
          <h1>CARDÁPIO</h1>
        </div>
        <div class="col-md-4">
          <form class="form-inline">
            <select name="categoria" class="form-control w-100" id="inlineFormInputName2" placeholder="Filtrar categoria" onchange="filtraCategoria(this.value)">
                <option value="">Filtrar categoria</option>
                <option value="todas" <?= ('todas' == $filtra_categoria ? 'selected' : '') ?>>Todas as categorias</option>
              <?php foreach ($categorias as $cat): ?>
                <option value="<?= $cat->getId() ?>" <?= ($cat->getId() == $filtra_categoria ? 'selected' : '') ?>><?= $cat->getNome(); ?></option>
              <?php endforeach; ?>
            </select>
          </form>
          </div>
          <div class="col-md-4">
           <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="text" name="search" placeholder="Pesquisar" aria-label="Pesquisar" value="<?= $search; ?>">
            <button class="btn my-2 my-sm-0" type="submit">
              <i class="fas fa-search"></i>
            </button>
          </form>
        </div>
      </div>
      <div class="row lista-produtos">
        <?php $qtd = count($produtos); ?>
      <?php foreach ($produtos as $produto) : 
          $categoria = $categoriaDAO->get($produto->getCategoria());
          $imagens = $imagemDAO->listarPorProduto($produto->getId());

          if(isset($imagens[0]) && file_exists('admin/'.$imagens[0]->getCaminho())) {
            $capa = '/admin/'.$imagens[0]->getCaminho();
          } else {
            $capa = 'assets/img/produtos/default.png';
          }
      ?>
        <!-- conteudo do produto -->
        <div class="col-md-4 col-sm-6 col-xs-12">
          <article class="produto produto-principal">
            <figure>
              <img src="<?= $capa; ?>" alt="">
            </figure>
            <div class="descricao-produto">
              <h3><?= $produto->getNome(); ?></h3>
              <span class="badge badge-pill badge-info"><?= $categoria->getNome(); ?></span>
              <p><?= $produto->getDescricao(); ?></p>
              <span class="preco">
                R$ <?= $produto->getPreco(); ?>
              </span>
              <button type="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalCompra<?= $produto->getId(); ?>">
                COMPRAR
              </button>
            </div>
          </article>
        </div>
        <!-- /conteudo do produto -->

           <!-- modal para comprar produto -->
            <div class="modal fade" id="modalCompra<?= $produto->getId(); ?>" tabindex="-1" role="dialog" aria-labelledby="labelCompra" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="labelCompra">Adicionar o produto a cesta</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <article class="produto">
                      <figure>
                       <!-- carrosel -->
                        <div id="indicadoresModal<?= $produto->getId(); ?>" class="carousel slide" data-ride="carousel">
                          <ol class="carousel-indicators">
                            <?php 
                            $n = 0;
                            foreach ($imagens as $imagem): ?>
                                <li data-target="#indicadoresModal<?= $produto->getId(); ?>" data-slide-to="<?= $n ?>" class="<?php echo($n == 0 ? 'active' : '') ?>"></li>
                            <?php 
                            $n++;
                            endforeach; ?>
                          </ol>
                          <div class="carousel-inner">
                            <?php 
                            $n = 0;
                            foreach ($imagens as $imagem): ?>
                              <div class="carousel-item <?php echo($n == 0 ? 'active' : '') ?>">
                                <img class="d-block w-100" src="/admin/<?= $imagem->getCaminho(); ?>" alt="Primeiro Slide">
                              </div>
                            <?php 
                            $n++;
                            endforeach; 

                            if(!isset($imagens[0]) || !file_exists('admin/'.$imagens[0]->getCaminho())) {
                              $capa = 'assets/img/produtos/default.png';
                            ?>
                              <div class="carousel-item active">
                                  <img class="d-block w-100" src="assets/img/produtos/default.png" alt="Primeiro Slide">
                              </div>
                            

                            <?php
                            }

                            ?>
                          </div>
                          <a class="carousel-control-prev" href="#indicadoresModal<?= $produto->getId(); ?>" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Anterior</span>
                          </a>
                          <a class="carousel-control-next" href="#indicadoresModal<?= $produto->getId(); ?>" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Próximo</span>
                          </a>
                        </div>
                        <!-- /carrosel -->
                      <!--   <img src="/assets/img/produtos/produto1.png" alt=""> -->
                      </figure>
                      <div class="descricao-produto">
                        <h3><?= $produto->getNome(); ?></h3>
                        <p><?= $produto->getDescricao(); ?></p>
                        <span class="preco" id="preco<?= $produto->getId(); ?>">
                          R$ <?= $produto->getPreco(); ?>
                        </span>
                          <form class="form-inline my-2 my-lg-0" method="post" action="adiciona_produto.php">
                            <input type="hidden" name="produto" id="produto<?= $produto->getId(); ?>" value="<?= $produto->getId(); ?>">
                            <input type="hidden" name="nome_produto" id="nome_produto<?= $produto->getId(); ?>" value="<?= $produto->getNome(); ?>">
                            <input type="hidden" name="preco_produto" id="preco_produto<?= $produto->getId(); ?>" value="<?= $produto->getPreco(); ?>">
                            <input type="hidden" name="val" value="<?= $produto->getPrecoBD(); ?>" id="valor_unidade<?= $produto->getId(); ?>">
                            <input class="form-control-range mr-sm-2" id="range_valor<?= $produto->getId(); ?>" type="range" placeholder="Quantidade" aria-label="Quantidade" min="1" max="10" value="1" required onchange="alteraValor('range',$(this).val(),<?= $produto->getId(); ?>)">
                            <br>
                            <input type="number" id="qtd<?= $produto->getId(); ?>" name="qtd" value="1" class="form-control mr-sm-0" min="1" onchange="alteraValor('qtd',$(this).val(),<?= $produto->getId(); ?>)">
                            <button class="btn btn-primary my-2 my-sm-0" onclick="AddItem(<?= $produto->getId(); ?>); return false;">
                              Adicionar
                            </button>
                          </form>
                      </div>
                    </article>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                  </div>
                </div>
              </div>
            </div>
          <!-- /modal para comprar produto -->


      <?php endforeach; ?>
      
      <?php if($qtd < 1) { ?>
        <span class="alert alert-info col-12 text-center" style="height: 60px;">
          Nenhum produto foi encontrado para exibir.
        </span>
      <?php } ?>

      </div>
      
    </main>

<?php
include_once('footer.php');
?>