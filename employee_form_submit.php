<?php
// Collect data from form
$employee_name = $_POST['employee_name'];
$employee_job_title = $_POST['employee_job_title'];
$employee_email = $_POST['employee_email'];
$employee_phone = $_POST['employee_phone'];


// Map of field names to user-friendly names
$field_names = [
    'employee_name' => 'Imię i nazwisko pracownika',
    'employee_job_title' => 'Stanowisko pracownika',
    'employee_email' => 'Adres e-mail pracownika',
    'employee_phone' => 'Telefon kontaktowy pracownika',
];

// Validation
$errors = [];

if (empty($employee_name) || !preg_match("/^[a-zA-Z-' ]*$/",$employee_name)) {
    $errors[] = $field_names['employee_name'];
}
if (empty($employee_job_title)) {
    $errors[] = $field_names['employee_job_title'];
}
if (empty($employee_email) || !filter_var($employee_email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = $field_names['employee_email'];
}
if (empty($employee_phone) || !preg_match("/^[0-9()+\s]+$/",$employee_phone)) {
    $errors[] = $field_names['employee_phone'];
}
if (!empty($errors)) {
    echo "<div class='container my-5 py-3 alert-warning'>";
    echo "Proszę poprawić następujące pola: <b>" . implode(', ', $errors) . "</b>";
    echo "</div>
    <div class='container my-1 mx-auto justify-content-center'>
        <div class='row justify-content-center'>
            <a href='/nowy-pracownik' class='btn btn-secondary'><i class='fa fa-arrow-left'></i> Powrót do formularza</a>
        </div>
    </div>
    ";
    exit;
}

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

    // if success show message with back button
    $pdo = null;
    echo "<div class='container my-5 py-3 alert-success'>";
    echo "Pracownik wprowadzony prawidłowo.";
    echo "</div>
    <div class='container my-1 mx-auto justify-content-center'>
        <div class='row justify-content-center'>
            <a href='/pracownicy' class='btn btn-secondary'><i class='fa fa-arrow-left'></i> Powrót</a>
        </div>
    </div>
    ";

} catch (Exception $e) {
    // Rollback transaction if error
    $pdo->rollBack();
    echo "Błąd: " . $e->getMessage();
    // If error, close connection and show message
    $pdo = null;
}

?>
