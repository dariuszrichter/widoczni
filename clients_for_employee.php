<?php 
$employee_id = $_GET['id'];

$stmt = $pdo->prepare("
    SELECT id, employee_name
    FROM employees
    WHERE id = :get_employee;
");
$stmt->bindParam(':get_employee', $employee_id);
$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $current_employee_name = $row['employee_name'];
}
$stmt = null;
?>


<div class="container-fluid px-5 mt-4">
        <h2><b>Klienci pracownika:</b>  <?php echo $current_employee_name; ?></h2>
        <a href="/pracownicy" class="btn btn-secondary mb-3"><i class="fa fa-arrow-left"></i> Powrót</a>
        
        <table id="datatables" class="display hover" style="width:100%">
            <thead>
                <tr>
                    <th>Nazwa firmy</th>
                    <th>Adres firmowy<br>Kontakt ogólny</th>
                    <th>Dane do kontaktu</th>
                    <th>Wykupiony pakiet<br>Cena</th>
                    <th>Data kontraktu<br>Status</th>
                    <th>Akcje</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // All employees
                $stmt = $pdo->prepare("
                    SELECT clients.id AS client_id, clients.company_name, clients.company_email, clients.company_phone, clients.address, clients.contract_date, clients.status, client_contacts.contact_name, client_contacts.contact_position, client_contacts.contact_phone, client_contacts.contact_email, service_packages.package_name, service_packages.price, employees.employee_name
                    FROM employee_client
                    JOIN clients ON employee_client.client_id = clients.id
                    JOIN client_contacts ON client_contacts.client_id = clients.id
                    JOIN service_packages ON clients.package_id = service_packages.id
                    JOIN employees ON employee_client.employee_id = employees.id
                    WHERE employee_client.employee_id = :employee_id;
                ");
                $stmt->bindParam(':employee_id', $employee_id);
                $stmt->execute();

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>
                        <td>{$row['company_name']}</td>
                        <td>{$row['address']}<br>{$row['company_email']}<br>{$row['company_phone']}</td>
                        <td>{$row['contact_name']} <i>({$row['contact_position']})</i><br>{$row['contact_email']}<br>{$row['contact_phone']}</td>
                        <td>{$row['package_name']}<br>{$row['price']} PLN</td>
                        <td>{$row['contract_date']}<br>{$row['status']}</td>
                        <td>
                            <a href='/szczegoly?id={$row['client_id']}' class='btn btn-primary btn-sm mx-1' title='Opiekunowie'><i class='fa fa-user-tie' aria-hidden='true'></i>
                            <a href='#' class='btn btn-warning disabled btn-sm mx-1' title='Edytuj'><i class='fa fa-pen-to-square' aria-hidden='true'></i>
                            <a href='#' class='btn btn-danger disabled btn-sm mx-1' title='Usuń'><i class='fa fa-trash' aria-hidden='true'></i>
                        </td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
        <!-- Datatables scripts -->
        <script>
            let table = new DataTable('#datatables', {
                language: {
                    url: '/lang/pl.json',
                },
            });
        </script>
    </div>