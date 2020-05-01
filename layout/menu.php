<?php 
  $permissaoUsuarioMenu = retornaControle('usuario');
  $permissaoPerfilMenu = retornaControle('perfil');
  $permissaoControleMenu = retornaControle('controle');
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark ">
  <div class="container">
    
  
  <a class="navbar-brand" href="administrativa.php">Lanchonete</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#conteudoNavbarSuportado" aria-controls="conteudoNavbarSuportado" aria-expanded="false" aria-label="Alterna navegação">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="administrativa.php">Início <span class="sr-only">(página atual)</span></a>
      </li>
      <li class="nav-item ">
        <a class="nav-link" href="produtos.php" id="navbarDropdown" role="button" >
          Produtos
        </a>
      </li>
      <li class="nav-item ">
        <a class="nav-link " href="categorias.php" id="navbarDropdown" role="button" aria-haspopup="true" aria-expanded="false">
          Categorias
        </a>
      </li>
      <li class="nav-item ">
        <a class="nav-link " href="clientes.php" role="button" >
          Clientes
        </a>
      </li>
      <?php if(!empty($permissaoUsuarioMenu)): ?>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Usuários
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="usuarios.php">Listar Usuários</a>
          <?php if(!empty($permissaoPerfilMenu)): ?>
            <a class="dropdown-item" href="perfis.php">Listar Perfis</a>
          <?php endif; ?>
          <?php if(!empty($permissaoControleMenu)): ?>
          <a class="dropdown-item" href="controles.php">Listar Controles</a>
          <?php endif; ?>
        </div>
      </li>
      <?php endif; ?>
      <li class="nav-item align-self-end" >
        <a class="nav-link" href="#">
          
        </a>
      </li>
    </ul>
    <span class="navbar-text">
      <a href="form_usuario.php?id=<?= $_SESSION['id_usuario'] ?>">
            <strong >
              <?= $_SESSION['nome'] ?>
            </strong>
            <img src="/assets/img/usuarios/<?= ($_SESSION['imagem'] != '' && file_exists('assets/img/usuarios/'.$_SESSION['imagem']) ? $_SESSION['imagem'] : 'usuario.png' ) ?>" class="rounded-circle user-img-menu">
          </a>
      <small>  <a class="btn btn-outline-secondary btn-sm" href="logout.php" onclick="return confirm('Deseja realmente sair?')">Sair</a></small>
    </span>
  </div>
  </div>
</nav>
<div class="container">
  <?php 
  if(isset($_GET['msg']) && $_GET['msg'] != '') {
   echo '<div class="alert alert-info">'.$_GET['msg'].'</div>';
  }
?>