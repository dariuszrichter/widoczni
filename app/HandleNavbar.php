<?php 

class HandleNavbar {

    public function buttons($userIsLoggedIn){
        if ($userIsLoggedIn == TRUE) {
            echo '
                <div class="menu-buttons">
                    <a href="./" class="menu-btn">Klienci</a>
                    <a href="/pakiety" class="menu-btn">Pakiety</a>
                    <a href="/pracownicy" class="menu-btn">Pracownicy</a>
                    <a href="/wyloguj" class="menu-btn">Wyloguj</a>
                </div>
            ';
        }
    }
    
}