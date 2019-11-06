<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="História Médica">
  <meta name="keyword" content="Web System, Odontologic System, Dentist">
  <title>História Médica</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/bootstrap-theme.css" rel="stylesheet">
  <link href="css/elegant-icons-style.css" rel="stylesheet" />
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet" />
  <link rel="stylesheet" href="css/main.css">
  <link rel="icon" type="image/png" href="images/icons/iconEdent.png"/>
</head>

<body>
  <section id="container" class="">
    <header class="header dark-bg">
      <div class="toggle-nav">
        <div class="icon-reorder tooltips" data-original-title="Menu lateral" data-placement="bottom"><i class="icon_menu"></i></div>
      </div>
      <a class="navbar-brand" href="#">
        <img src="images/icons/E-DENT-3.png" class="nav-item" alt="logo" style="width: 90px">
      </a>
    </header>

    <?php
      include('aside.php');
    ?>

    <section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <section class="panel">
              <header class="panel-heading">
                HISTORIA MÉDICA
              </header>
              <div class="panel-body">
                <div class="form">
                  <form class="form-validate form-horizontal" id="register_form" method="POST" action="cadastrar_historia_medica.php">
                    <div class="form-group">
                      <label for="" class="control-label col-lg-2">Queixa Principal <span class="required">*</span></label>
                      <div class="col-lg-10">
                        <textarea class="form-control" name="queixaPrincipal" style="width:100%; height:80px;" required="required"></textarea>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="" class="control-label col-lg-2">Historia da doença atual <span class="required">*</span></label>
                      <div class="col-lg-10">
                        <textarea class="form-control" name="historia_doenca_atual" style="width:100%; height:80px;" required="required"></textarea>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="" class="control-label col-lg-2">Historia Progresssa <span class="required">*</span></label>
                      <div class="col-lg-10">
                        <textarea class="form-control" name="historia_progressa" style="width:100%; height:80px;" required="required"></textarea>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="" class="control-label col-lg-2">Historia Familiar <span class="required">*</span></label>
                      <div class="col-lg-10">
                        <textarea class="form-control" name="historia_familiar" style="width:100%; height:100px;" required="required"></textarea>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="" class="control-label col-lg-2">Historia Pessoal e Social <span class="required">*</span></label>
                      <div class="col-lg-10">
                        <textarea class="form-control" name="historia_pessoal_social" style="width:100%; height:100px;" required="required"></textarea>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="" class="control-label col-lg-2">Observações <span class="required">*</span></label>
                      <div class="col-lg-10">
                        <textarea class="form-control" name="observacao" style="width:100%; height:100px;" required="required"></textarea>
                      </div>
                    </div>
                    <center>
                    <div>
                      <small id="" class="form-text text">
                        OBS: Antes de encerrar o cadastro verificar e com o auxilio do paciente verificar se todos os dados estão corretos.
                      </small>
                    </div>
                    <br>

                    <div class="form-group">
                      <div class="col-lg-offset-2 col-lg-10">
                        <button class="btn btn-primary" type="submit" value = "salvar_historiaM">Salvar</button>
                        <button class="btn btn-default" type="button">Cancelar</button>
                      </div>
                    </div>
                    </center>
                  </form>
                </div>
              </div>
            </section>
          </div>
        </div>
      </section>
    </section>
  </section>

  <script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
  <script src="js/jquery-ui-1.10.4.min.js"></script>
  <script src="js/jquery-1.8.3.min.js"></script>
  <script src="js/jquery.scrollTo.min.js"></script>
  <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
  <script src="js/jquery.customSelect.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/jquery-ui-1.9.2.custom.min.js"></script>
  <script src="js/scripts.js"></script>
</body>

</html>
