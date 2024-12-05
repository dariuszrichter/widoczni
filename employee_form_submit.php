<?php
// Włącz raportowanie błędów
ini_set('display_errors', 1);
error_reporting(E_ALL);
// Collect data from form
$employee_name = $_POST['employee_name'];
$employee_job_title = $_POST['employee_job_title'];
$employee_email = $_POST['employee_email'];
$employee_phone = $_POST['employee_phone'];

$pdo->beginTransaction();

try {
    // Insert data into clients table
    $insert_client = "INSERT INTO employees (employee_name, email, phone, employee_job_title) 
                      VALUES (:employee_name, :email, :phone, :employee_job_title)";
    $stmt = $pdo->prepare($insert_client);
    $stmt->bindParam(':employee_name', $employee_name);
    $stmt->bindParam(':email', $employee_email);
    $stmt->bindParam(':phone', $employee_phone);
    $stmt->bindParam(':employee_job_title', $employee_job_title);
    $stmt->execute();

    // Commit transaction
    $pdo->commit();

    // If success close connection and redirect to home page 
    $pdo = null;
    header("Location: /pracownicy", true, 302);


} catch (Exception $e) {
    // Rollback transaction if error
    $pdo->rollBack();
    echo "Błąd: " . $e->getMessage();
    // If error, close connection and show message
    $pdo = null;
}

?>
