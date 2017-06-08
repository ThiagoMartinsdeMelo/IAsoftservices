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
  <link rel="stylesheet" href="<?= BASE ?>assets/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?= BASE ?>assets/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="<?= BASE ?>assets/css/skin-blue.min.css">
  <link rel="stylesheet" href="<?= BASE ?>assets/js/plugins/datepicker/datepicker3.css">
  <link rel="stylesheet" href="<?= BASE ?>assets/css/style.css">
</head>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <?php include 'elements/header.php' // Carrega cabeçalho do Dashboard ?>
        <?php include 'elements/sidebar.php'; // Carrega menu esquerdo do Dashboard ?>
        <div class="content-wrapper">
            <section class="content">
                <div class="container-fluid">                        
                  <?php 
                    $this->loadViewInTemplate($viewName, $viewData);
                  ?>
                </div>
            </section>
        </div>
        <?php include 'elements/footer.php'; // Carrega o rodapé do Dashboard ?>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="<?= BASE ?>assets/js/jquery.mask.min.js"></script> <!-- Plugin para mascaras no formúlarios -->
    <script src="<?= BASE ?>assets/js/plugins/datepicker/bootstrap-datepicker.js"></script> <!-- Plugin para o datepicker da os -->
    <script src="<?= BASE ?>assets/js/plugins/datepicker/locales/bootstrap-datepicker.pt-BR.js"></script>
    <script src="<?= BASE ?>assets/js/app.min.js"></script> <!-- Script para o toogle do menu esquerdo -->
    <script src="<?= BASE ?>assets/js/script.js"></script> <!-- Aplicando funcionalidades no sistema -->
</body>
</html>