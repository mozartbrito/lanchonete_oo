    <footer id="contato">
      <div class="container">
        <form action="" method="post" accept-charset="utf-8">
        <div class="row contato">
              <div class="col-6">
                <div class="form-group">
                  <label for="nome">Nome:</label>
                  <input type="text" name="nome" id="nome" value="" class="form-control" placeholder="Informe seu nome" required>
                </div>
                <div class="form-group">
                  <label for="email">E-mail:</label>
                  <input type="email" name="email" id="email" value="" class="form-control" placeholder="Informe seu e-mail de contato" required>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group">
                  <label for="mensagem">Mensagem:</label>
                  <textarea name="mensagem" id="mensagem" class="form-control" rows="5" placeholder="Digite sua mensagem ou dúvida" required></textarea>
                </div>
              </div>
              <div class="col-12 text-right">
                <button type="submit" class="btn btn-primary">Enviar mensagem</button>
              </div>                    
        </div>
        </form>
        <div class="row">
          <div class="col text-center direitos">
            <p>&copy;Direitos reservados <?php echo date('Y'); ?> | SENAC DF</p>
          </div>
        </div>
      </div>
    </footer>
<div id="btnScroll">
  <a href="#" data-toggle="modal" data-target="#modalFinaliza">
    <i class="fas fa-shopping-bag sacola"></i>
    <span class="badge badge-pill badge-danger num-pedidos">
      <?= isset($_SESSION['compras']) ? count($_SESSION['compras']) : 0 ?>
    </span>
  </a>
  <br>
  <a href="#header" class="scroll">
    <i class="fas fa-arrow-circle-up"></i>
  </a>
</div>
 
<?php
include_once('modal.php');
?>

    <!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script src="/assets/js/jquery-3.3.1.min.js"></script>
    <script src="/assets/js/popper.min.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
    <script src="/admin/assets/js/jquery.maskedinput.min.js" ></script>
    <script>
      //$(document).ready(function($) {
        /*$('#range_valor').on('change', function() {
            let valor_range = $(this).val();
            $('#qtd').val(valor_range);
            calculaCompra(valor_range);
            
        });
        $('#qtd').on('change', function() {
            let valor_range = $(this).val();
            $('#range_valor').val(valor_range);
            calculaCompra(valor_range);
            
        });*/
        /*$(function() {
          $('.moeda').maskMoney({
              decimal: ",",
              thousands: "."
          });
        });*/
        $('.telefone').mask("(99) 99999-9999");
        $('.cep').mask("99999-999");
        $('.cpf').mask("999.999.999-99");

        $(function () {
          $('[data-toggle="tooltip"]').tooltip()
        });
  

        function alteraValor(tipo, valor, id_produto) {
          var name_range = '#range_valor' + id_produto;
          var name_qtd = '#qtd' + id_produto;
          if(tipo == 'range') {
            let valor_range = valor;
            $(name_qtd).val(valor_range);
            calculaCompra(valor_range, id_produto);
          } else if(tipo == 'qtd') {
            let valor_range = valor;
            $(name_range).val(valor_range);
            calculaCompra(valor_range, id_produto);
          }
        }

        function calculaCompra(valor, id_produto) {
            let name_unidade = '#valor_unidade' + id_produto; 
            let name_preco = '#preco' + id_produto; 
            let valor_range = valor;
            let valor_unidade = $(name_unidade).val();
            let valor_total = valor_range * valor_unidade;
            $(name_preco).html(valor_total.toLocaleString('pt-br',{style: 'currency', currency: 'BRL'}));
        }
        
        function filtraCategoria(id_categoria) {
          window.location.href = "index.php?categoria=" + id_categoria + "#titulo-cardapio";
        }

        $('#btnScroll').css('display', 'none');

        $(window).scroll(function() {
          if($(this).scrollTop() > 350){
            $('#btnScroll').fadeIn();
          } else {
            $('#btnScroll').fadeOut();
          }
        });


        var scrollLink = $('.scroll');

        // Smooth scrolling
        scrollLink.click(function(e) {
        e.preventDefault();
        $('body,html').animate({
          scrollTop: $(this.hash).offset().top
        }, 1000 );
        });

      function atualizaPedidos() {
        $.ajax({
          url: 'tabela_pedidos.php',
          type: 'GET',
          beforeSend: function() {

          },
          success: function(resultado) {
            $('#tabela_pedido').html(resultado);
            $('#tabela_pedidos_modal').html(resultado);
          }
        });
        
      }

      function excluiItem(id_item) {
        if (confirm('Deseja remover o item da sacola?')) {
          $.ajax({
            url: 'adiciona_produto.php?acao=removerItemAjax&key=' + id_item,
            type: 'GET',
            beforeSend: function() {

            },
            success: function(resultado) {
              atualizaPedidos();
              $('.num-pedidos').html(resultado);
              /*$('.num-pedidos').html(<?= isset($_SESSION['compras']) ? count($_SESSION['compras']) - 1 : 0 ?>);*/
            }
          })
          
        }
      }
      function AddRemoveItem(id_item, new_qtd) {
        $.ajax({
          url: 'adiciona_produto.php?acao=AlteraItemAjax&key=' + id_item + '&qtd=' + new_qtd,
            type: 'GET',
            beforeSend: function() {

            },
            success: function(resultado) {
              atualizaPedidos();
            }
        })
        
      }

      function AddItem(id_produto) {
        let produto = $('#produto' + id_produto).val();
        let nome_produto = $('#nome_produto' + id_produto).val();
        let preco_produto = $('#preco_produto' + id_produto).val();
        let qtd = $('#qtd' + id_produto).val();
        let valor_unidade = $('#valor_unidade' + id_produto).val();
       /* alert(id_produto +' - ' + preco_produto +' - ' + nome_produto+' - ' + qtd+' - ' + valor_unidade)*/

        $.ajax({
          url: 'adiciona_produto.php?acao=AddItemAjax',
          type: 'POST',
          data: {
            produto: id_produto,
            nome_produto: nome_produto,
            preco_produto: preco_produto,
            qtd: qtd,
            val: valor_unidade
          },
          beforeSend: function() {

          },
          success: function(resultado) {
            atualizaPedidos();
            $('.num-pedidos').html(resultado);
            $('.close').click();
          }
        })
        
      }

      //});
    </script>
  </body>
</html>