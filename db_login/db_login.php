<?php            
//LOGOWANIE DO BAZY DANYCH
$username = "widoczni_admin";
$password = "password";
$server = 'mysql:host=localhost;dbname=widoczni;charset=utf8';

try {
    $pdo = new PDO($server, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>

