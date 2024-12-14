<div class="container px-5 mt-5">
    <form action="/autoryzacja" method="POST" enctype="multipart/form-data">
        <div class="form-row">
            <label for="login">Użytkownik</label>
            <input type="text" id="login" name="login" placeholder="" required>
        </div>
        <div class="form-row">
            <label for="password">Hasło</label>
            <input type="password" id="password" name="password" placeholder="" required>
        </div>
        <div class="form-row">
            <button type="submit">Zaloguj</button>
        </div>
    </form>
</div>