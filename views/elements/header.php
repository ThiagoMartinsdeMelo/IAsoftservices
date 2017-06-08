  <header class="main-header">
    <a href="http://iasoft.com.br/iasoft/" targt="_blank" class="logo">
      <span class="logo-mini"><b>IASoft</b></span>
      <span class="logo-lg"><b>IASoft</b></span>
    </a>
    <nav class="navbar navbar-static-top" role="navigation">
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown notifications-menu">
          </li>
          <li class="dropdown user user-menu">
            <?php
              $nome = explode(" ", $_SESSION['nome']);
              $primeiro_nome = $nome[0];
            ?> 
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i><span class="hidden-xs"><?= $primeiro_nome ?></span></a>
            <ul class="dropdown-menu">
              <li class="user-header">
                <p><?= $_SESSION['nome'] ?><small></small></p>
              </li>
              <li class="user-body">
              </li>
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?php echo BASE; ?>funcionarios/funcionarios_edit/<?= $_SESSION['lgpainel'] ?>" class="btn btn-default btn-flat">Perfil</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo BASE; ?>painel/logout?>" class="btn btn-default btn-flat">Sair</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>