<?php
//Import database credentials
include './db_login/db_login.php';
//Import custom functions
include './functions.php';
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>WIDOCZNI</title>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
        <img src = "./img/widoczni-logo.svg" alt="My Happy SVG" style="max-height: 50px;"/>
        <div class="menu-buttons">
            <button class="menu-btn" type="button" onclick="location.href='./'">Klienci</button>
            <button class="menu-btn" type="button" onclick="location.href='/pakiety'">Pakiety</button>
            <button class="menu-btn" type="button" onclick="location.href='/pracownicy'">Pracownicy</button>
        </div>
    </div>
        <?php
            //Clean pages
            $route = isset($_GET['route']) ? $_GET['route'] : 'home';
            switch ($route) {
                case 'przypisani-klienci':
                    include 'clients_for_employee.php';
                    break;
                case 'pracownicy':
                    include 'employees.php';
                    break;
                case 'wprowadzanie-nowego-pracownika':
                    include 'employee_form_submit.php';
                    break;
                case 'wprowadzanie-nowego-klienta':
                    include 'client_form_submit.php';
                    break;
                case 'nowy-pracownik':
                    include 'employee_form.php';
                    break;
                case 'nowy-klient':
                    include 'client_form.php';
                    break;
                case 'szczegoly':
                    include 'client_details.php';
                    break;
                case 'nowy-pakiet':
                    include 'packages_form.php';
                    break;
                case 'pakiety':
                    include 'packages.php';
                    break;
                default:
                    include 'home.php';
                    break;
            }
    ?>
</body>
</html>
