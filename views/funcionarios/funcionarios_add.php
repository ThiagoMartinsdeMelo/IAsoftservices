<div class="row">
    <div class="users add col-md-10 columns content">
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
                                <li><a href="<?php echo BASE; ?>funcionarios/home">Listar Funcionários</a></li>
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
                        	<legend>Cadastrar Funcionário</legend>
                        		<div class="form-group text required">
                        			<label for="nome">Nome</label>
                        			<input type="text" name="nome" required="required" maxlength="60" id="nome" class="form-control"/>
                        		</div>
                        		<div class="form-group username required">
                        			<label for="username">Username</label>
                        			<input type="text" name="username" required="required" maxlength="16" id="username" class="form-control"/>
                        		</div>
                        		<div class="form-group password required">
                        			<label for="password">Password</label>
                        			<input type="password" name="senha" required="required" id="password" class="form-control"/>
                        		</div>
								<div class="form-group radio">
                                    <legend>Status</legend>
	                  				<div class="radio">
	                    				<label for="status">
	                      					<input type="radio" name="status" id="optionsRadios1" value="0" checked="">Ativado
	                    				</label>
	                  				</div>
	                  				<div class="radio">
	                    				<label for="status">
	                      					<input type="radio" name="status" id="optionsRadios2" value="1">Desativado
	                      				</label>
	                  				</div>
                				</div>
                        </fieldset>
                    <br/>
                    <button class="btn btn-success" type="submit">Cadastrar</button>
                	</form>
            	</div>
            </div>
        </div>
    </div>
</div>