<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>IASoft | Services</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <link rel="stylesheet" href="<?= BASE ?>assets/css/AdminLTE.min.css"/>
    </head>
    <body class="hold-transition login-page">
    	<div class="login-box">
    		<div class="login-logo">
    			<a href=""><b>IASoft Services</b></a>
            </div>
            <div class="login-box-body">
            	<p class="login-box-msg">Informe seus dados de acesso:</p>

				<?php
					/*
					** Exibe a mensagem de erro, caso login
					** ou senha sejam inválidos
					*/
					if(!empty($erro)) { ?>
						<div class="alert alert-danger" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">×</span>
							</button><?= $erro; ?>
						</div>
				<?php } ?>

            	<form method="post" accept-charset="utf-8" role="form">
            		<div class="form-group has-feedback">
    					<input type="text" name="username" maxlength="16" class="form-control" placeholder="Username" required="required" autofocus>
    					<span class="glyphicon glyphicon-user form-control-feedback"></span>
					</div>
					<div class="form-group has-feedback">
    					<input type="password" name="senha" class="form-control" placeholder="Password" required="required">
    					<span class="glyphicon glyphicon-lock form-control-feedback"></span>
					</div>
					<div class="row">
					    <div class="col-xs-8">
					    </div>
					    <div class="col-xs-4">
					        <button type="submit" class="btn btn-primary btn-block btn-flat">Entrar</button>
					    </div>
					</div>
				</form>
            </div>
        </div>
		<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </body>
</html>