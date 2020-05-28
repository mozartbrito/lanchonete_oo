<?php
include_once('header.php');
include_once('menu.php');
include_once('slides.php');
?>
<main class="container">
      <div class="row titulo-cardapio" id="titulo-cardapio">
        <div class="col-md-4">
          <h1>CARDÁPIO</h1>
        </div>
        <div class="col-md-4">
          <form class="form-inline">
            <select name="categoria" class="form-control w-100" id="inlineFormInputName2" placeholder="Filtrar categoria">
              <option value="">Filtrar categoria</option>
            </select>
          </form>
          </div>
          <div class="col-md-4">
           <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Pesquisar" aria-label="Pesquisar">
            <button class="btn my-2 my-sm-0" type="submit">
              <i class="fas fa-search"></i>
            </button>
          </form>
        </div>
      </div>
      <div class="row lista-produtos">
        <?php $qtd = 13; ?>
      <?php for ($i = 0; $i < $qtd; $i++) : ?>
        <!-- conteudo do produto -->
        <div class="col-md-4 col-sm-6 col-xs-12">
          <article class="produto produto-principal">
            <figure>
              <img src="/assets/img/produtos/produto1.png" alt="">
            </figure>
            <div class="descricao-produto">
              <h3>Duplo Bacon</h3>
              <p>Com salada, queijo chedar, molho especial, cebola</p>
              <span class="preco">
                R$ 19,90
              </span>
              <button type="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalCompra">
                COMPRAR
              </button>
            </div>
          </article>
        </div>
        <!-- /conteudo do produto -->
      <?php endfor; ?>
      
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