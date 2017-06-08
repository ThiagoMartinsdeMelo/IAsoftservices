<aside class="main-sidebar">
  <section class="sidebar">
      </br></br>
      <form action="<?php echo BASE; ?>clientes/search?>" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="nome" class="form-control" placeholder="Nome do cliente...">
          <span class="input-group-btn">
            <button type="submit" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
            </button>
          </span>
        </div>
      </form>
      <form action="<?php echo BASE; ?>funcionarios/search?>" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="nome" class="form-control" placeholder="Nome do funcionário...">
          <span class="input-group-btn">
            <button type="submit" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
            </button>
          </span>
        </div>
      </form>      
      <ul class="sidebar-menu">
        <li class="header">NAVEGAÇÃO</li>
        <li class="active">
          <a href="<?= BASE?>painel"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
        </li>
        <li class="treeview">
          <a href="#"><i class="fa  fa-user"></i> <span>Funcionários</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
            <li>
              <a href="<?php echo BASE; ?>funcionarios/home">Listar Funcionários</a>
            </li>
            <li>
              <a href="<?php echo BASE; ?>funcionarios/funcionarios_add">Cadastrar Funcionário</a>
            </li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#"><i class="fa  fa-users"></i> <span>Clientes</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
            <li>
              <a href="<?php echo BASE; ?>clientes/home">Listar Clientes</a>
            </li>
            <li>
              <a href="<?php echo BASE; ?>clientes/clientes_add">Cadastrar Cliente</a>
            </li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#"><i class="fa  fa-pencil-square-o"></i> <span>Ordens Serviços</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
            <li>
              <a href="<?php echo BASE; ?>ordens/home">Listar Ordens Serviços</a>
            </li>
            <li>
              <a href="<?php echo BASE; ?>ordens/ordem_servico_add">Cadastrar Ordem Serviço</a>
            </li>
          </ul>
        </li>        
      </ul>
  </section>
</aside>