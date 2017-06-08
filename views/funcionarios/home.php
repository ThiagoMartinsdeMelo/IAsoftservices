<?php

/*
** Exibe mensagem referente as ações realizadas no cadastro do funcionário.
** Se a $_SESSION[] for diferente de 1,
** exibe mensagem de que a ação não foi realizada.
*/

if (isset($_SESSION['msg-func-cadastrado']) && !empty($_SESSION['msg-func-cadastrado'])) {

    if ($_SESSION['msg-func-cadastrado'] == 1) {
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

    unset( $_SESSION['msg-func-cadastrado'] );
    unset( $_SESSION['msg-f'] );
}

if (isset($_SESSION['msg-func-atualizado']) && !empty($_SESSION['msg-func-atualizado'])) {

    if ($_SESSION['msg-func-atualizado'] == 1) {
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

    unset( $_SESSION['msg-func-atualizado'] );
    unset( $_SESSION['msg-f'] );
}

if (isset($_SESSION['msg-func-delete']) && !empty($_SESSION['msg-func-delete'])) {

    if ($_SESSION['msg-func-delete'] == 1) {
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

    unset( $_SESSION['msg-func-delete'] );
    unset( $_SESSION['msg-f'] );
}


?>
<div class="row">
    <div class="funcionarios add col-md-10 columns content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <legend>Funcionários</legend>
                <ul class="nav nav-pills nav-stacked">
                    <li>
                        <div class="btn-group">
                            <button type="button" class="btn btn-danger">Ação</button>
                            <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="<?php echo BASE; ?>funcionarios/funcionarios_add">Cadastrar Funcionário</a></li>
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
                                <form action="<?php echo BASE; ?>funcionarios/search?>" method="get">
                                    <fieldset>
                                        <div class="form-group">
                                            <label for="categoria-id">Funcionário</label>
                                            <input type="text" name="nome" id="student" placeholder="Digite o nome do funcionário..." class="form-control" required="required">
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
                            <th style="text-align: center">Username</th>
                            <th style="text-align: center">Ativo</th>                            
                            <th class="actions" style="text-align: center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($funcionarios as $f): ?>
                        <tr>                
                            <td><?= $f['func_tx_nome_funcionario']; ?></td>
                            <td style="text-align: center"><?= $f['func_cd_username']; ?></td>
                            <?php
                            	/*
                            	** Imprime sim ou não para o status do funcionário.
                            	*/
                            	$status = 'Sim';
                            	if ($f['func_in_desativado'] == 1) {
                            		$status = 'Não'; 
                            	}
                            ?>
							<td style="text-align: center"><?= $status; ?></td>                            
                            <td class="actions" style="white-space:nowrap; text-align: center">
                            	<a href="<?= BASE; ?>funcionarios/funcionarios_edit/<?= $f['func_id_funcionario']; ?>" class="btn btn-warning btn-xs">Editar</a>
								<a href="<?= BASE; ?>funcionarios/funcionario_del/<?= $f['func_id_funcionario']; ?>" class="btn btn-danger btn-xs" onclick="if (confirm(&quot;Voc\u00ea realmente deseja excluir o usu\u00e1rio # <?= $f['func_tx_nome_funcionario']; ?>&quot;)) { document.post.submit(); } event.returnValue = false; return false;">Excluir</a>
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