<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main</title>

    <!--Bootstrap-->
    <link rel="stylesheet" type="text/css" href="bootstrap-3.3.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="bootstrap-3.3.2-dist/css/bootstrap-theme.min.css">

    <!--CSS-->
    <link rel="stylesheet" type="text/css" href="css/general.css">
    
    <?php
        include("security.php"); // Inclui o arquivo com o sistema de segurança
        protectPage();
    ?>

</head>

<body ng-app="SyncTV">

<div ng-controller="MainController">
    <div class="text-center">
        <div id="content" class="divMain">
            <tabset type="pills" justified="true">
                <tab>
                    <tab-heading><span class="glyphicon glyphicon-home"></span> Home </tab-heading>
                    <div class="divContent">
                        <?php include('home.php'); ?>
                    </div>
                </tab>
                <tab>
                    <tab-heading><span class="glyphicon glyphicon-refresh"></span> SyncTV </tab-heading>
                    <div class="divContent"> 
                        <?php include('synctv.php'); ?>
                    </div>
                </tab>
                <tab>
                    <tab-heading><span class="glyphicon glyphicon-user"></span> Perfil </tab-heading>
                    <div class="divContent" > 
                        <?php include('perfil.php'); ?>
                    </div>
                </tab>
            </tabset>
        </div>





        <!--<div class="bs-example">
        	<ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
                <li class="active"><a href="#geral" data-toggle="tab"><span class="glyphicon glyphicon-home"></span> Geral </a></li>
                <li><a href="#perfil" data-toggle="tab"><span class="glyphicon glyphicon-user"></span> Perfil </a></li>
                <li><a href="#channels" data-toggle="tab"><span class="glyphicon glyphicon-th-list"></span> Canais </a></li>
                <li><a href="#schedules" data-toggle="tab"><span class="glyphicon glyphicon-calendar"></span> Programações </a></li>
                <li><a href="#multimedia" data-toggle="tab"><span class="glyphicon glyphicon-facetime-video"></span> Multimídia </a></li>
                <li><a href="#applications" data-toggle="tab"><span class="glyphicon glyphicon-phone"></span> Aplicações </a></li>
            </ul>
             <div id="my-tab-content" class="tab-content">
                <div class="tab-pane active" id="geral">
                    <h1>Geral</h1>
                </div>
                <div class="tab-pane" id="perfil">
                    <h1>Perfil</h1>
                    <?php //include("perfil.php") ?>
                </div>
                <div class="tab-pane" id="channels">
                    <h1>Canais</h1>
                    <?php //include("channels.php") ?>
                </div>
                <div class="tab-pane" id="schedules">
                    <h1>Programações</h1>
                    <?php //include("schedules.php") ?>
                </div>
                <div class="tab-pane" id="multimedia">
                    <h1>Multimídia</h1>
                    <?php //include("multimedia.php") ?>
                </div>
                <div class="tab-pane" id="applications">
                    <h1>Aplicações</h1>
                    <?php //include("applications.php") ?>
                </div>
            </div>
        </div>
        -->
    </div>
</div>


    <script src="angular-1.0.7/angular.js"></script>
    <script src="angular-1.0.7/angular-locale_pt-br.js"></script>

    <script src="ui.bootstrap/ui-bootstrap-tpls-0.12.1.js"></script>
    <script src="js/controllers.js"></script>
    <script src="dist/angular-file-upload.min.js"></script>


</body>

</html>                  