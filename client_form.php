<div class="container px-5 mt-4">
    <h2>Nowy klient</h2>
    <a href="/" class="btn btn-secondary mb-3"><i class="fa fa-arrow-left"></i> Powrót</a>

    <!-- Formularz nowego klienta -->
    <form action="/wprowadzanie-nowego-klienta" method="POST" enctype="multipart/form-data">
        <div class="form-row">
            <label for="company_name">Nazwa firmy</label>
            <input type="text" id="company_name" name="company_name" placeholder="Np. Example Sp. z o.o." required>
        </div>
        <div class="form-row flex-row">
            <div class="form-column">
                <label for="company_email">Adres e-mail</label>
                <input type="text" id="company_email" name="company_email" placeholder="Np. kontakt@example.com" required>
            </div>
            <div class="form-column">
                <label for="company_phone">Telefon kontaktowy</label>
                <input type="text" id="company_phone" name="company_phone" placeholder="Np. 456321789" required>
            </div>
        </div>
        <div class="form-row">
            <label for="company_address">Adres firmy</label>
            <input type="text" id="company_address" name="company_address" placeholder="Np. Poznańska 12, 62-423 Poznań" required>
        </div>
        <div class="form-row flex-row">
            <div class="form-column">
                <label for="contact_name">Reprezentant do kontaktu </label>
                <input type="text" id="contact_name" name="contact_name" placeholder="Np. Jan Kowalski" required>
            </div>
            <div class="form-column">
                <label for="contact_position">Stanowisko</label>
                <input type="text" id="contact_position" name="contact_position" placeholder="Np. Dyrektor" required>
            </div>
        </div>
        <div class="form-row flex-row">
            <div class="form-column">
                <label for="contact_email">Adres e-mail reprezentanta</label>
                <input type="text" id="contact_email" name="contact_email" placeholder="Np. jan.kowalski@example.com" required>
            </div>
            <div class="form-column">
                <label for="contact_phone">Telefon kontaktowy reprezentanta</label>
                <input type="text" id="contact_phone" name="contact_phone" placeholder="Np. 456321789" required>
            </div>
        </div>
        <div class="form-row flex-row">
            <?php
            //SQL QUERY FOR SERVICE PACKAGES
            $stmt = $pdo->prepare("
                SELECT *
                FROM service_packages
            ");
            $stmt->execute();
            ?>
            <div class='form-column'>
                <label for='package'>Pakiet</label>
                <select id='package' name='package' required>
                    <?php
                    //PRINT ALL OPTIONS FROM DB
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "
                            <option value='{$row['id']}'>{$row['package_name']} - {$row['price']} PLN</option>
                        ";
                    }
                    $stmt = null;
                    ?>
                </select>
            </div>                
            <div class="form-column">
                <label for="contract_date">Data kontraktu</label>
                <input type="date" id="contract_date" name="contract_date" value="<?= date('Y-m-d') ?>" required>
            </div>
        </div>
        <div class="form-row flex-row">
            <?php
            //SQL QUERY FOR EMPLOYEES LIST
            $stmt = $pdo->prepare("
                SELECT id, employee_name, employee_job_title
                FROM employees
            ");
            $stmt->execute();
            ?>
            <div class='form-column'>
                <label for='employee'>Opiekun</label>
                <select id='employee' name='employee' required>
                    <?php
                    //PRINT ALL OPTIONS FROM DB
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "
                            <option value='{$row['id']}'>{$row['employee_name']} ({$row['employee_job_title']})</option>
                        ";
                    }
                    $stmt = null;
                    ?>
                </select>
            </div>   
            <div class='form-column'>
                <label for='status'>Status kontraktu</label>
                <select id='status' name='status' required>                    
                    <option value='aktywny'>Aktywny</option>
                    <option value='nieaktywny'>Nieaktywny</option>
                </select>
            </div> 
        </div>
        <div class="form-row">
            <button type="submit">Wprowadź</button>
        </div>
    </form>
</div>