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

    // If success close connection and redirect to home page 
    $pdo = null;
    header("Location: /", true, 302);


} catch (Exception $e) {
    // Rollback transaction if error
    $pdo->rollBack();
    echo "Błąd: " . $e->getMessage();
    // If error, close connection and show message
    $pdo = null;
}

?>
