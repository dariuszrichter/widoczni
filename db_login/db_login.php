<?php            
//LOGOWANIE DO BAZY DANYCH
$username = "USERNAME";
$password = "PASSWORD";
$server = 'mysql:host=localhost;dbname=DATABASE;charset=utf8';

try {
    $pdo = new PDO($server, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>

