<?php

// Collect data from form
$company_name = $_POST['company_name'];
$company_email = $_POST['company_email'];
$company_phone = $_POST['company_phone'];
$company_address = $_POST['company_address'];
$package_id = $_POST['package'];
$contract_date = $_POST['contract_date'];

$contact_name = $_POST['contact_name'];
$contact_position = isset($_POST['contact_position']) ? $_POST['contact_position'] : '';  // Sprawdzenie istnienia klucza
$contact_email = $_POST['contact_email'];
$contact_phone = $_POST['contact_phone'];

$employee_id = $_POST['employee'];

$status = $_POST['status'];


// Map of field names to user-friendly names
$field_names = [
    'company_name' => 'Nazwa firmy',
    'company_email' => 'Adres e-mail firmy',
    'company_phone' => 'Telefon kontaktowy firmy',
    'company_address' => 'Adres siedziby firmy',
    'package_id' => 'Pakiet',
    'contract_date' => 'Data kontraktu',
    'contact_name' => 'Imię i nazwisko osoby kontaktowej',
    'contact_position' => 'Stanowisko osoby kontaktowej',
    'contact_email' => 'Adres e-mail osoby kontektowej',
    'contact_phone' => 'Telefon osoby kontaktowej',
    'employee_id' => 'Opiekun',
    'status' => 'Status kontraktu'
];

// Validation
$errors = [];

if (empty($company_name)) {
    $errors[] = $field_names['company_name'];
}
if (empty($company_email) || !filter_var($company_email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = $field_names['company_email'];
}
if (empty($company_phone) || !preg_match("/^[0-9()+\s]+$/",$company_phone)) {
    $errors[] = $field_names['company_phone'];
}
if (empty($company_address)) {
    $errors[] = $field_names['company_address'];
}
if (empty($package_id)) {
    $errors[] = $field_names['package_id'];
}
if (empty($contract_date)) {
    $errors[] = $field_names['contract_date'];
}
if (empty($contact_name) || !preg_match("/^[a-zA-Z-' ]*$/",$contact_name)) {
    $errors[] = $field_names['contact_name'];
}
if (empty($contact_position)) {
    $errors[] = $field_names['contact_position'];
}
if (empty($contact_email) || !filter_var($contact_email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = $field_names['contact_email'];
}
if (empty($contact_phone) || !preg_match("/^[0-9()+\s]+$/",$contact_phone)) {
    $errors[] = $field_names['contact_phone'];
}
if (empty($employee_id)) {
    $errors[] = $field_names['employee_id'];
}
if (empty($status)) {
    $errors[] = $field_names['status'];
}
if (!empty($errors)) {
    echo "<div class='container my-5 py-3 alert-warning'>";
    echo "Proszę poprawić następujące pola: <b>" . implode(', ', $errors) . "</b>";
    echo "</div>
    <div class='container my-1 mx-auto justify-content-center'>
        <div class='row justify-content-center'>
            <a href='/nowy-klient' class='btn btn-secondary'><i class='fa fa-arrow-left'></i> Powrót do formularza</a>
        </div>
    </div>
    ";
    exit;
}

$pdo->beginTransaction();

try {
    // Insert data into clients table
    $insert_client = "INSERT INTO clients (company_name, company_email, company_phone, address, package_id, contract_date, status) 
                      VALUES (:company_name, :company_email, :company_phone, :company_address, :package_id, :contract_date, :status)";
    $stmt = $pdo->prepare($insert_client);
    $stmt->bindParam(':company_name', $company_name);
    $stmt->bindParam(':company_email', $company_email);
    $stmt->bindParam(':company_phone', $company_phone);
    $stmt->bindParam(':company_address', $company_address);
    $stmt->bindParam(':package_id', $package_id);
    $stmt->bindParam(':contract_date', $contract_date);
    $stmt->bindParam(':status', $status);
    $stmt->execute();

    // Getting the ID of a newly added client
    $client_id = $pdo->lastInsertId();

    // Insert data into client_contacts table
    $insert_contact = "INSERT INTO client_contacts (client_id, contact_name, contact_position, contact_email, contact_phone) 
                       VALUES (:client_id, :contact_name, :contact_position, :contact_email, :contact_phone)";
    $stmt = $pdo->prepare($insert_contact);
    $stmt->bindParam(':client_id', $client_id);
    $stmt->bindParam(':contact_name', $contact_name);
    $stmt->bindParam(':contact_position', $contact_position);
    $stmt->bindParam(':contact_email', $contact_email);
    $stmt->bindParam(':contact_phone', $contact_phone);
    $stmt->execute();

    // Insert data into employee_client table
    $insert_employee_client = "INSERT INTO employee_client (client_id, employee_id) 
                               VALUES (:client_id, :employee_id)";
    $stmt = $pdo->prepare($insert_employee_client);
    $stmt->bindParam(':client_id', $client_id);
    $stmt->bindParam(':employee_id', $employee_id);
    $stmt->execute();

    // Commit transaction
    $pdo->commit();

    // if success show message with back button
    echo "<div class='container my-5 py-3 alert-success'>";
    echo "Klient wprowadzony prawidłowo.";
    echo "</div>
    <div class='container my-1 mx-auto justify-content-center'>
        <div class='row justify-content-center'>
            <a href='/' class='btn btn-secondary'><i class='fa fa-arrow-left'></i> Powrót</a>
        </div>
    </div>
    ";
    $pdo = null;

} catch (Exception $e) {
    // Rollback transaction if error
    $pdo->rollBack();
    echo "Błąd: " . $e->getMessage();
    // If error, close connection and show message
    $pdo = null;
}

?>
