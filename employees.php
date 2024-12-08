<div class="container-fluid px-5 mt-4">
        <h2>Pracownicy</h2>
        <a href="/nowy-pracownik" class="btn btn-success mb-3">Nowy pracownik</a>
        
        <table id="datatables" class="display hover" style="width:100%">
            <thead>
                <tr>
                    <th>Imię i nazwisko</th>
                    <th>Adres e-mail</th>
                    <th>Numer telefonu</th>
                    <th>Stanowisko</th>
                    <th>Przypisani klienci</th>
                    <th>Akcje</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // All employees
                $stmt = $pdo->prepare("
                    SELECT *
                    FROM employees
                ");
                //Count clients per empleyee
                $count = $pdo->prepare("
                    SELECT employee_id, COUNT(client_id) AS client_count
                    FROM employee_client
                    GROUP BY employee_id;
                ");

                $stmt->execute();
                $count->execute();

                $client_count_map = [];
                while ($clients = $count->fetch(PDO::FETCH_ASSOC)) {
                    $client_count_map[$clients['employee_id']] = $clients['client_count'];
                }
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    if (!isset($client_count_map[$row['id']])){
                        $clients_count = 0;
                    } else {
                        $clients_count = $client_count_map[$row['id']];
                    }
                    echo "<tr>
                        <td>{$row['employee_name']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['phone']}</td>
                        <td>{$row['employee_job_title']}</td>
                        <td><a href='/przypisani-klienci?id={$row['id']}' class='btn btn-info btn-sm mx-1' title='Przypisani klienci'>{$clients_count}</td>
                        <td style='min-width: 100px;'>
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