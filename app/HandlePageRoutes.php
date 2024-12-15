<?php 

class HandlePageRoutes {

    private function defaultPage (){
        if (isset($_SESSION['login'])) {
            $route = isset($_GET['route']) ? WID_CONFIG_PAGES::pages[$_GET['route']] : WID_CONFIG_PAGES::pages['clients'];
            return $route;
        }
        if (!isset($_SESSION['login'])) {
            $route = isset($_GET['route']) ? WID_CONFIG_PAGES::pagesWithoutLogin[$_GET['route']] : WID_CONFIG_PAGES::pagesWithoutLogin['login'];
            return $route;
        }
    }

    public function pageArray (){

            if (isset($_GET['route']) && !isset(WID_CONFIG_PAGES::pagesWithoutLogin[$_GET['route']]) && !isset($_SESSION['login'])) {
                http_response_code(404);
                include WID_CONFIG_PAGES::pagesWithoutLogin['error'];
                exit;
            } 
            if (isset($_GET['route']) && !isset(WID_CONFIG_PAGES::pages[$_GET['route']]) && isset($_SESSION['login'])) {
                http_response_code(404);
                include WID_CONFIG_PAGES::pages['error'];
                exit;
            } 

            include $this->defaultPage();
        }

    public function routes(){
        switch ($this->defaultPage()) {
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