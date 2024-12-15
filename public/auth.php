<?php 

$loginVerify = new HandleAuthorization(WID_CONFIG_DB::HOST, WID_CONFIG_DB::DBNAME, WID_CONFIG_DB::USERNAME, WID_CONFIG_DB::PASSWORD);
if ($loginVerify->checkValidLogin($_POST['login'], $_POST['password'])) {
    session_regenerate_id();
    header('Location: /clients');

} else {
    header('Location: /');
}
