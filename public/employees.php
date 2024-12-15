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
                $connection = new GetDataFromMySQL(WID_CONFIG_DB::HOST,WID_CONFIG_DB::DBNAME, WID_CONFIG_DB::USERNAME, WID_CONFIG_DB::PASSWORD);
                $query = "
                        SELECT *
                        FROM employees
                        ";
                $data = $connection->getIndividualData($query);
                $query2 = "
                        SELECT employee_id, COUNT(client_id) AS client_count
                        FROM employee_client
                        GROUP BY employee_id;
                        ";
                $data2 = $connection->getIndividualData($query2);

                $client_count_map = [];
                foreach ($data2 as $clients) {
                    $client_count_map[$clients['employee_id']] = $clients['client_count'];
                }
                foreach ($data as $row) {
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