<div class="container-fluid px-5 mt-4">
        <h2>Pakiety</h2>
        <a href="/nowy-pakiet" class="btn btn-success mb-3 disabled">Nowy pakiet</a>
        
        <table id="datatables" class="display hover" style="width:100%">
            <thead>
                <tr>
                    <th>Lp.</th>
                    <th>Pakiet</th>
                    <th>Opis</th>
                    <th>Cena</th>
                    <th>Utworzony</th>
                    <th>Akcje</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $lp = 1;
                $stmt = $pdo->prepare("
                    SELECT *
                    FROM service_packages
                ");
                $stmt->execute();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>
                        <td>{$lp}</td>
                        <td style='min-width: 150px;'>{$row['package_name']}</td>
                        <td>{$row['package_description']}</td>
                        <td style='min-width: 100px;'>{$row['price']} PLN</td>
                        <td>{$row['created_at']}</td>
                        <td style='min-width: 100px;'>
                            <a href='#' class='btn btn-warning disabled btn-sm mx-1' title='Edytuj'><i class='fa fa-pen-to-square' aria-hidden='true'></i>
                            <a href='#' class='btn btn-danger disabled btn-sm mx-1' title='Usuń'><i class='fa fa-trash' aria-hidden='true'></i>
                        </td>
                    </tr>";
                    $lp++;
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