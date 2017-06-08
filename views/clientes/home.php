<?php

/*
** Exibe mensagem referente as ações realizadas no cadastro do cliente.
** Se a $_SESSION[] for diferente de 1,
** exibe mensagem de que a ação não foi realizada.
*/

if (isset($_SESSION['msg-cliente-cadastrado']) && !empty($_SESSION['msg-cliente-cadastrado'])) {

    if ($_SESSION['msg-cliente-cadastrado'] == 1) {
        echo "<div class=\"alert alert-success\" role=\"alert\">
                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">×</span>
                </button>{$_SESSION['msg-f']}
             </div>";
    } else {
        echo "<div class=\"alert alert-danger\" role=\"alert\">
                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">×</span>
                </button>{$_SESSION['msg-f']}
             </div>";        
    }

    /*
    ** Destruindo as variáveis de sessão específicas.
    */

    unset( $_SESSION['msg-cliente-cadastrado'] );
    unset( $_SESSION['msg-f'] );
}

if (isset($_SESSION['msg-cliente-atualizado']) && !empty($_SESSION['msg-cliente-atualizado'])) {

    if ($_SESSION['msg-cliente-atualizado'] == 1) {
        echo "<div class=\"alert alert-success\" role=\"alert\">
                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">×</span>
                </button>{$_SESSION['msg-f']}
             </div>";
    } else {
        echo "<div class=\"alert alert-danger\" role=\"alert\">
                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">×</span>
                </button>{$_SESSION['msg-f']}
             </div>";        
    }

    /*
    ** Destruindo as variáveis de sessão específicas.
    */

    unset( $_SESSION['msg-cliente-atualizado'] );
    unset( $_SESSION['msg-f'] );
}

if (isset($_SESSION['msg-cliente-delete']) && !empty($_SESSION['msg-cliente-delete'])) {

    //echo 'aqui na home';
    //exit;

    if ($_SESSION['msg-cliente-delete'] == 1) {
        echo "<div class=\"alert alert-success\" role=\"alert\">
                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">×</span>
                </button>{$_SESSION['msg-f']}
             </div>";
    } else {
        echo "<div class=\"alert alert-danger\" role=\"alert\">
                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">×</span>
                </button>{$_SESSION['msg-f']}
             </div>";        
    }

    /*
    ** Destruindo as variáveis de sessão específicas.
    */

    unset( $_SESSION['msg-cliente-delete'] );
    unset( $_SESSION['msg-f'] );
}

?>
<div class="row">
    <div class="clientes add col-md-10 columns content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <legend>Clientes</legend>
                <ul class="nav nav-pills nav-stacked">
                    <li>
                        <div class="btn-group">
                            <button type="button" class="btn btn-danger">Ação</button>
                            <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="<?php echo BASE; ?>clientes/clientes_add">Cadastrar Cliente</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
                <br/>
            </div>
            <br/>
            <div class="box-body">
                <div class="panel panel-info">
                    <div class="panel-heading">Pesquisar</div>
                    <div class="panel-body">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <form action="<?php echo BASE; ?>clientes/search?>" method="get">
                                    <fieldset>
                                        <div class="form-group">
                                            <label for="categoria-id">Cliente</label>
                                            <input type="text" name="nome" id="nome" placeholder="Digite o nome do cliente..." class="form-control" required="required">
                                        </div>
                                    </fieldset>
                                    <button class="btn btn-success" type="submit">Pesquisar</button>
                                </form>                        
                            </li>
                        </ul>
                    </div>
                </div>
            </div>                
            <div class="box-body">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th style="text-align: center">Nome</th>
                            <th style="text-align: center">Contato</th>
                            <th style="text-align: center">Ativo</th>                            
                            <th class="actions" style="text-align: center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($clientes as $c): ?>
                        <tr>                
                            <td><?= $c['cli_tx_nome_cliente']; ?></td>
                            <td style="text-align: center"><?= $c['cli_tx_telefone']; ?></td>
                            <?php
                            	/*
                            	** Imprime sim ou não para o status do cliente.
                            	*/
                            	$status = 'Sim';
                            	if ($c['cli_in_desativado'] == 1) {
                            		$status = 'Não'; 
                            	}
                            ?>
							<td style="text-align: center"><?= $status; ?></td>                            
                            <td class="actions" style="white-space:nowrap; text-align: center">
                            	<a href="<?= BASE; ?>clientes/clientes_edit/<?= $c['cli_id_cliente']; ?>" class="btn btn-warning btn-xs">Editar</a>
								<a href="<?= BASE; ?>clientes/cliente_del/<?= $c['cli_id_cliente']; ?>" class="btn btn-danger btn-xs" onclick="if (confirm(&quot;Voc\u00ea realmente deseja excluir o cliente # <?= $c['cli_tx_nome_cliente']; ?>&quot;)) { document.post.submit(); } event.returnValue = false; return false;">Excluir</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <!-- falta paginacao -->
            </div>
        </div>
    </div>
</div>