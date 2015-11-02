<!DOCTYPE html>
<?php ?>
<html ng-app="SyncTV">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Index</title>   

    <!--Bootstrap-->
    <link rel="stylesheet" type="text/css" href="bootstrap-3.3.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="bootstrap-3.3.2-dist/css/bootstrap-theme.min.css">

    <!--CSS-->
    <link rel="stylesheet" type="text/css" href="css/general.css">
    <link rel="stylesheet" type="text/css" href="css/index.css">
    
    
    <script src="angular-1.0.7/angular.js"></script>
    <script src="angular-1.0.7/angular-locale_pt-br.js"></script>

    <script src="ui.bootstrap/ui-bootstrap-tpls-0.12.1.js"></script>
    <script src="js/controllers.js"></script>
    <script src="dist/angular-file-upload.min.js"></script>

  </head>
  <body ng-controller="LoginController">
  
    
    <div class="container">

        <div class="jumbotron">
          <h1>SyncTV!</h1>
          <p></p>
        </div>

        <div align="center" >
            <div class="jumbotron" style="max-width: 350px;" align="left">
                <form name="formLogin" method="post" action="auth.php" role="form">
                    <h4>Acessar</h4>
                    <div class="form-group" ng-class="{ 'has-error' : formLogin.user.$invalid && !formLogin.user.$pristine }">
                        <input type="text" class="form-control" name="user" placeholder="Digite seu email ou usuário" ng-model="user" required>   
                        <label ng-show="formLogin.user.$invalid && !formLogin.user.$pristine" class="help-block">Email ou usuário é obrigatório</label>                  
                    </div>
                    <div class="form-group" ng-class="{ 'has-error' : formLogin.pass.$invalid && !formLogin.pass.$pristine }">
                        <input type="password" class="form-control" name="pass" placeholder="Digite sua senha" ng-model="pass" required>
                        <label ng-show="formLogin.pass.$invalid && !formLogin.pass.$pristine" class="help-block">Senha é obrigatória</label> 
                    </div>
                    <div class="checkbox">
                      <label><input type="checkbox">Lembrar-me</label>
                    </div>
                    <div class="btn-group">
                      <button class="btn btn-default btn-md" ng-click="cadastrar()">Cadastrar</button>
                      <button type="submit" class="btn btn-danger btn-md" name="logIn" ng-disabled="formLogin.$invalid">Entrar</button>
                    </div>
                </form>
            </div>  
        </div>

    </div>
      
    <!--JS-->
    
    


  </body>
</html> 