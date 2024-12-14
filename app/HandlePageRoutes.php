<?php 

class HandlePageRoutes {

    public function routes(){
        $route = isset($_GET['route']) ? $_GET['route'] : 'login';
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
            case 'clients':
                include 'clients.php';
                break;
            case 'login':
                include 'login.php';
                break;
            case 'autoryzacja':
                include '../auth.php';
                break;
            case 'error':
                http_response_code(404);
                include 'error.php';
                break;
            default:
                http_response_code(404);
                include 'error.php';
                break;
        }
    }
    
}