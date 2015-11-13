<?php
        include("security/security.php"); // Inclui o arquivo com o sistema de segurança
        protectPage();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main</title>

    <!--Bootstrap-->
    <!--<link rel="stylesheet" type="text/css" href="bootstrap-3.3.2-dist/css/bootstrap.min.css">-->
    <link rel="stylesheet" type="text/css" href="../lib/css/bootstrap.min.css">

    <!--<link href="dist/css/flat-ui.css" rel="stylesheet">-->
    <link rel="stylesheet" type="text/css" href="../lib/css/flat-ui.css" >

    <!--CSS-->
    <!--<link rel="stylesheet" type="text/css" href="css/general.css">-->
    <link rel="stylesheet" type="text/css" href="../lib/css/general.css">


</head>

<body ng-app="SyncTV">

<div ng-controller="MainController">
    <div class="text-center">
        <div id="content" class="divMain">
            <tabset type="pills" justified="true">
                <tab>
                    <tab-heading><span class="glyphicon glyphicon-home"></span> Home </tab-heading>
                    <div class="divContent">
                        <?php include('home/home.php'); ?>
                    </div>
                </tab>
                <tab active="isActive">
                    <tab-heading><span class="glyphicon glyphicon-refresh"></span> SyncTV </tab-heading>
                    <div class="divContent"> 
                        <?php include('synctv/synctv.php'); ?>
                    </div>
                </tab>
                <tab>
                    <tab-heading><span class="glyphicon glyphicon-user"></span> Perfil </tab-heading>
                    <div class="divContent" > 
                        <?php include('profile/profile.php'); ?>
                    </div>
                </tab>
            </tabset>
        </div>

    </div>
</div>


    <!--<script src="angular-1.0.7/angular.js"></script>
    <script src="angular-1.0.7/angular-locale_pt-br.js"></script>

    <script src="ui.bootstrap/ui-bootstrap-tpls-0.12.1.js"></script>
    <script src="js/controllers.js"></script>
    <script src="dist/angular-file-upload.min.js"></script>-->

    <script src="../lib/js/angular.js"></script>
    <script src="../lib/js/angular-locale_pt-br.js"></script>
    <script src="../lib/js/ui-bootstrap-tpls-0.12.1.js"></script>
    <script src="../lib/js/controllers.js"></script>
    <script src="../lib/js/angular-file-upload.min.js"></script>


</body>

</html>                  