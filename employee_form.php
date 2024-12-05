<div class="container px-5 mt-4">
    <h2>Nowy pracownik</h2>
    <a href="/" class="btn btn-secondary mb-3"><i class="fa fa-arrow-left"></i> Powrót</a>

    <!-- Formularz nowego klienta -->
    <form action="/wprowadzanie-nowego-pracownika" method="POST" enctype="multipart/form-data">
        <div class="form-row flex-row">
            <div class="form-column">
                <label for="employee_name">Imię i nazwisko</label>
                <input type="text" id="employee_name" name="employee_name" placeholder="Np. Jan Kowalski" required>
            </div>
            <div class="form-column">
                <label for="employee_job_title">Stanowisko</label>
                <input type="text" id="employee_job_title" name="employee_job_title" placeholder="Np. Grafik" required>
            </div>
        </div>
        <div class="form-row flex-row">
            <div class="form-column">
                <label for="employee_email">Adres e-mail</label>
                <input type="text" id="employee_email" name="employee_email" placeholder="Np. jan.kowalski@example.com" required>
            </div>
            <div class="form-column">
                <label for="employee_phone">Telefon kontaktowy</label>
                <input type="text" id="employee_phone" name="employee_phone" placeholder="Np. 456321789" required>
            </div>
        </div>
        <div class="form-row">
            <button type="submit">Wprowadź</button>
        </div>
    </form>
</div>