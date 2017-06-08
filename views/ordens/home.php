<?php

/*
** Exibe mensagem referente as ações realizadas no cadastro da ordem de serviço.
** Se a $_SESSION[] for diferente de 1,
** exibe mensagem de que a ação não foi realizada.
*/

if (isset($_SESSION['msg-ordem-cadastrado']) && !empty($_SESSION['msg-ordem-cadastrado'])) {

    if ($_SESSION['msg-ordem-cadastrado'] == 1) {
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

    unset( $_SESSION['msg-ordem-cadastrado'] );
    unset( $_SESSION['msg-f'] );
}

if (isset($_SESSION['msg-ordem-atualizado']) && !empty($_SESSION['msg-ordem-atualizado'])) {

    if ($_SESSION['msg-ordem-atualizado'] == 1) {
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

    unset( $_SESSION['msg-ordem-atualizado'] );
    unset( $_SESSION['msg-f'] );
}

if (isset($_SESSION['msg-ordem-delete']) && !empty($_SESSION['msg-ordem-delete'])) {

    if ($_SESSION['msg-ordem-delete'] == 1) {
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

    unset( $_SESSION['msg-ordem-delete'] );
    unset( $_SESSION['msg-f'] );
}

?>
<div class="row">
    <div class="clientes add col-md-10 columns content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <legend>Ordens de Serviços</legend>
                <ul class="nav nav-pills nav-stacked">
                    <li>
                        <div class="btn-group">
                            <button type="button" class="btn btn-danger">Ação</button>
                            <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="<?php echo BASE; ?>ordens/ordem_servico_add">Cadastrar Ordem Serviço</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
                <br/>
            </div>
            <br/>
            <br/>
            <div class="box-body">
                <div class="panel panel-info">
                    <div class="panel-heading">Pesquisar</div>
                    <div class="panel-body">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <form action="<?php echo BASE; ?>ordens/search" method="get">
                                    <fieldset>
                                        <div class="form-group select">
                                            <label for="user-id">Funcionário</label>
                                            <select name="idfuncionario" id="user-id" class="form-control">
                                                <option value="">-- Selecione o Funcionário --</option>
                                                <?php foreach ($funcionarios as $f): ?>
                                                    <option value="<?= $f['func_id_funcionario']; ?>"><?= $f['func_tx_nome_funcionario'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>   
                                        <div class="form-group select">
                                            <label for="user-id">Cliente</label>
                                            <select name="idcliente" id="user-id" class="form-control">
                                                <option value="">-- Selecione o Cliente --</option>
                                                <?php foreach ($clientes as $c): ?>
                                                    <option value="<?= $c['cli_id_cliente']; ?>"><?= $c['cli_tx_nome_cliente'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>                                        
                                        <div class="form-inline">
                                            <div class="form-group text required">
                                                <label for="abertura">Data de Abertura</label>
                                                <input type="text" name="abertura" id="datepicker-abertura" class="form-control" maxlength="10" placeholder="__/__/____" autocomplete="off">
                                            </div>
                                           <div class="form-group text required">
                                                <label for="fechamento">Data de Fechamento</label>
                                                <input type="text" name="fechamento" id="datepicker-fechamento" class="form-control" maxlength="10" placeholder="__/__/____" autocomplete="off">
                                           </div>
                                        </div> 
                                        <div class="form-group select">
                                            <label for="user-id">Status</label>
                                            <select name="status" id="user-id" class="form-control">
                                                <option value="">-- Selecione o Status --</option>
                                                <?php foreach ($status as $key => $st): ?>
                                                    <option value="<?= $key; ?>"><?= $st ?></option>
                                                <?php endforeach; ?>
                                            </select>
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
                            <th style="text-align: center">Id</th>
                            <th style="text-align: left">Funcionário</th>
                            <th style="text-align: left">Cliente</th>
                            <th style="text-align: center">Data Abertura</th>
                            <th style="text-align: center">Data Fechamento</th>
                            <th style="text-align: center">Valor Serviço</th>
                            <th style="text-align: center">Status</th>
                            <th style="text-align: center">Ativa</th>
                            <th class="actions" style="text-align: center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($ordens as $o): ?>
                        <tr>                
                            <td style="text-align: center"><?= $o['os_id_ordem_servico']; ?></td>
                            <td><?= $o['func_tx_nome_funcionario']; ?></td>
                            <td><?= $o['cli_tx_nome_cliente']; ?></td>
                            <td style="text-align: center"><?= $o['data_abertura']; ?></td>
                            <td style="text-align: center"><?= $o['data_fechamento']; ?></td>
                            <?php
                            /*
                            ** Converte valor para formato de moeda brasileira.
                            */
                            ?>                            
                            <?php $vl_servico = number_format($o['os_vl_servico'], 2, ',', '.'); ?>
                            <td style="text-align: center"><?= $vl_servico; ?></td>
                            <td style="text-align: center"><?= $status[$o['os_cd_status']]; ?></td>
                            <?php
                            	/*
                            	** Imprime sim ou não para o situação da ordem de serviço.
                            	*/
                            	$situacao = 'Sim';
                            	if ($o['os_in_desativado'] == 1) {
                            		$situacao = 'Não'; 
                            	}
                            ?>
							<td style="text-align: center"><?= $situacao; ?></td>
                            <td class="actions" style="white-space:nowrap; text-align: center">
                            	<a href="<?= BASE; ?>ordens/ordem_servico_edit/<?= $o['os_id_ordem_servico']; ?>" class="btn btn-warning btn-xs">Editar</a>
								<a href="<?= BASE; ?>ordens/ordem_servico_del/<?= $o['os_id_ordem_servico']; ?>" class="btn btn-danger btn-xs" onclick="if (confirm(&quot;Voc\u00ea realmente deseja excluir a ordem de serviço  # <?= $o['os_id_ordem_servico']; ?>&quot;)) { document.post.submit(); } event.returnValue = false; return false;">Excluir</a>
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