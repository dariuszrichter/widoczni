<?php 

$logout = new HandleAuthorization(WID_CONFIG_DB::HOST, WID_CONFIG_DB::DBNAME, WID_CONFIG_DB::USERNAME, WID_CONFIG_DB::PASSWORD);
$logout->logOut();
