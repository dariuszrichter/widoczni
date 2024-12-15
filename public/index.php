
<?php 
session_start();
require("../config/config.php");
require("../app/MySQLConnection.php");
require('../app/GetDataFromMySQL.php');
require('../app/HandleAuthorization.php');
require('../app/HandlePageRoutes.php');
require('../app/HandleNavbar.php');

?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>WIDOCZNI</title>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <!-- Own CSS -->
    <link rel='stylesheet' type='text/css' media='screen' href='styles.css?<?=time()?>'>
    <!-- Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="navbar-own">
        <a href="/"><img src="public/img/widoczni-logo.svg" style="max-height: 50px;"/></a>
        <?php 
            $navbar = new HandleNavbar;
            $navbar->buttons(isset($_SESSION['login']));
        ?>
    </div>
        <?php
            $routes = new HandlePageRoutes;
            // $routes->routes();
            $routes->pageArray();
        ?>
</body>
</html>
