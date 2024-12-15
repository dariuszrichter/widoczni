<?php 

class HandlePageRoutes {

    private function checkSessionLogin (){
        if (isset($_SESSION['login'])) {
            $route = isset($_GET['route']) ? $_GET['route'] : 'clients';
            return $route;
        }
        if (!isset($_SESSION['login'])) {
            $route = isset($_GET['route']) ? $_GET['route'] : 'login';
            return $route;
        }
    }

    public function routes(){
        switch ($this->checkSessionLogin()) {
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
                include 'auth.php';
                break;
            case 'wyloguj':
                include 'logout.php';
                break;
            case 'error':
                http_response_code(404);
                include '../error/error.php';
                break;
            default:
                http_response_code(404);
                include '../error/error.php';
                break;
        }
    }
    
}