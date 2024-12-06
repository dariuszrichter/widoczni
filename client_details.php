<div class="container-fluid px-5 mt-4">
        <h2>Szczegóły</h2>
        <a href="/" class="btn btn-secondary mb-3"><i class="fa fa-arrow-left"></i> Powrót</a>
        <?php
        $stmt = $pdo->prepare("
            SELECT *
            FROM clients 
            LEFT JOIN service_packages ON clients.package_id = service_packages.id 
            LEFT JOIN client_contacts ON clients.id = client_contacts.client_id
            LEFT JOIN employee_client ON clients.id = employee_client.client_id
            LEFT JOIN employees ON employee_client.employee_id = employees.id 
            WHERE clients.id = ?
            LIMIT 1;
        ");
        $stmt->bindParam(1, $_GET['id'], PDO::PARAM_INT);
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $company_name = $row['company_name'];
            $address = $row['address'];
            $company_email = $row['company_email'];
            $company_phone = $row['company_phone'];
            $contact_name = $row['contact_name'];
            $contact_position = $row['contact_position'];
            $contact_email = $row['contact_email'];
            $contact_phone = $row['contact_phone'];
        };
        ?>
        <div class="container-fluid my-4">
            <div class="row">
                
                <div class="col-sm">
                    <b>Dane klienta:</b>
                </div>
                <div class="col-sm">
                    <?php 
                    echo "
                    {$company_name}<br>
                    {$address}<br>
                    {$company_email}<br>
                    {$company_phone}<br>
                    ";
                    ?>
                </div>
                <div class="col-sm">
                    <b>Dane reprezentanta:</b>
                </div>
                <div class="col-sm">
                <?php 
                    echo "
                    {$contact_name}<br>
                    {$contact_position}<br>
                    {$contact_email}<br>
                    {$contact_phone}<br>
                    ";
                    ?>
                </div>
                <div class="col-sm">
                    
                </div>
                <div class="col-sm">
                    
                </div>
                <div class="col-sm">
                    
                </div>
            </div>
            
        </div>
        <table id="datatables" class="display hover" style="width:100%">
            <thead>
                <tr>
                    <th>Opiekun</th>
                    <th>Stanowisko</th>
                    <th>Adres e-mail</th>
                    <th>Telefon</th>
                    <th>Akcje</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stmt = null; 
                $stmt = $pdo->prepare("
                    SELECT *
                    FROM clients 
                    LEFT JOIN service_packages ON clients.package_id = service_packages.id 
                    LEFT JOIN client_contacts ON clients.id = client_contacts.client_id
                    LEFT JOIN employee_client ON clients.id = employee_client.client_id
                    LEFT JOIN employees ON employee_client.employee_id = employees.id 
                    WHERE clients.id = ?;
                ");
                $stmt->bindParam(1, $_GET['id'], PDO::PARAM_INT);
                $stmt->execute();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>
                        <td>{$row['employee_name']}</td>
                        <td>{$row['employee_job_title']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['phone']}</td>
                        <td>
                            <a href='#' class='btn btn-warning disabled btn-sm mx-1' title='Edytuj'><i class='fa fa-pen-to-square' aria-hidden='true'></i>
                            <a href='#' class='btn btn-danger disabled btn-sm mx-1' title='Usuń'><i class='fa fa-trash' aria-hidden='true'></i>
                        </td>
                    </tr>";
                }
                $stmt = null;
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