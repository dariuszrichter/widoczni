<div class="container-fluid px-5 mt-4">
        <h2>Lista klientów</h2>
        <a href="/nowy-klient" class="btn btn-success mb-3">Nowy klient</a>
        
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
                $stmt = $pdo->prepare("
                    SELECT clients.id, clients.company_name, clients.address, clients.company_email, clients.company_phone, clients.contract_date, clients.status, client_contacts.contact_name, client_contacts.contact_position, client_contacts.contact_email, client_contacts.contact_phone, service_packages.price,
                    GROUP_CONCAT(client_contacts.contact_name) AS contacts, 
                    GROUP_CONCAT(employees.employee_name) AS employees,
                    service_packages.package_name
                    FROM clients
                    LEFT JOIN service_packages ON clients.package_id = service_packages.id
                    LEFT JOIN client_contacts ON clients.id = client_contacts.client_id
                    LEFT JOIN employee_client ON clients.id = employee_client.client_id
                    LEFT JOIN employees ON employee_client.employee_id = employees.id
                    GROUP BY clients.id;
                    ");
                $stmt->execute();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>
                        <td>{$row['company_name']}</td>
                        <td>{$row['address']}<br>{$row['company_email']}<br>{$row['company_phone']}</td>
                        <td>{$row['contact_name']} <i>({$row['contact_position']})</i><br>{$row['contact_email']}<br>{$row['contact_phone']}</td>
                        <td>{$row['package_name']}<br>{$row['price']} PLN</td>
                        <td>{$row['contract_date']}<br>{$row['status']}</td>
                        <td>
                            <a href='/szczegoly?id={$row['id']}' class='btn btn-primary btn-sm mx-1' title='Opiekunowie'><i class='fa fa-user-tie' aria-hidden='true'></i>
                            <a href='#' class='btn btn-warning disabled btn-sm mx-1' title='Edytuj'><i class='fa fa-pen-to-square' aria-hidden='true'></i>
                            <a href='#' class='btn btn-danger disabled btn-sm mx-1' title='Usuń'><i class='fa fa-trash' aria-hidden='true'></i>
                        </td>
                    </tr>";
                }
                $stmts = null;
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