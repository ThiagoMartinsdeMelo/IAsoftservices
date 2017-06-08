<div class="row">
    <div class="users add col-md-10 columns content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <legend>Ordens Serviços</legend>
                <ul class="nav nav-pills nav-stacked">
                    <li>
                        <div class="btn-group">
                            <button type="button" class="btn btn-danger">Ação</button>
                            <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="<?php echo BASE; ?>ordens/home">Listar Ordens Serviços</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
                <br/>
            </div>
            <br/>
			<div class="box-body">
                <div class="users form col-md-10 columns content">
                    <form method="post" accept-charset="utf-8" role="form">
                    	<fieldset>
                        	<legend>Editar Ordem Serviço</legend>
                        		<div class="form-group text required">
                        			<label for="funcionario">Funcionário</label>
                        			<input type="text" name="idfuncionario" required="required" maxlength="60" readonly="true" id="idfuncionario" class="form-control" value="<?= $_SESSION['nome']; ?>"/>
                        		</div>
                                <div class="form-group select">
                                    <label for="user-id">Cliente</label>
                                    <select name="idcliente" id="user-id" class="form-control">
                                        <?php foreach ($clientes as $c): ?>
                                            <option value="<?= $c['cli_id_cliente']; ?>" <?php if($c['cli_id_cliente'] == $ordem['os_id_cliente']) echo " selected"; ?>><?= $c['cli_tx_nome_cliente']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-inline">
                                    <div class="form-group text required">
                                        <label for="abertura">Data de Abertura</label>
                                        <input type="text" name="abertura" id="datepicker-abertura" required="required" class="form-control" maxlength="10" placeholder="__/__/____" autocomplete="off" value="<?= $ordem['data_abertura']; ?>">
                                    </div>
                                   <div class="form-group text required">
                                        <label for="abertura">Data de Fechamento</label>
                                        <input type="text" name="fechamento" id="datepicker-fechamento" required="required" class="form-control" maxlength="10" placeholder="__/__/____" autocomplete="off" value="<?= $ordem['data_fechamento']; ?>">
                                   </div>
                                </div>
                                <div class="form-group valor required">
                                    <label for="value">Valor Serviço</label>
                                    <?php
                                    /*
                                    ** Converte valor para formato de moeda brasileira.
                                    */
                                    ?>
                                    <?php $vl_servico = number_format($ordem['os_vl_servico'], 2, ',', '.'); ?>
                                    <input type="text" name="valorservico" required="required" step="any" id="valorservio" class="form-control" value="<?= $vl_servico; ?>">
                                </div>
                                <div class="form-group select">
                                    <label for="user-id">Status</label>
                                    <select name="status" id="user-id" class="form-control">
                                        <?php foreach ($status as $key => $st): ?>
                                            <option value="<?= $key; ?>" <?php if($key == $ordem['os_cd_status']) echo " selected"; ?>><?= $st ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>                                
								<div class="form-group radio">
                                    <legend>Situação</legend>
	                  				<div class="radio">
	                    				<label for="ativacao">
	                      					<input type="radio" name="ativacao" id="optionsRadios1" value="0" <?php if ($ordem['os_in_desativado'] == 0) { echo 'checked=""'; }?>>Ativado
	                    				</label>
	                  				</div>
	                  				<div class="radio">
	                    				<label for="ativacao">
	                      					<input type="radio" name="ativacao" id="optionsRadios2" value="1" <?php if ($ordem['os_in_desativado'] == 1) { echo 'checked=""'; }?>>Desativado
	                      				</label>
	                  				</div>
                				</div>
                        </fieldset>
                    <br/>
                    <button class="btn btn-success" type="submit">Atualizar</button>
                	</form>
            	</div>
            </div>
        </div>
    </div>
</div>