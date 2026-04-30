<form action="belep" method="post">
    <fieldset>
        <legend>Bejelentkezés</legend>
        <br>
        <input type="text" name="username" placeholder="felhasználó" required><br><br>
        <input type="password" name="password" placeholder="jelszó" required><br><br>
        <input type="submit" name="belepes" value="Belépés">
        <br>&nbsp;
    </fieldset>
</form>
<h2>Regisztrálja magát, ha még nem felhasználó!</h2>
    <form action="regisztral" method="post">
        <fieldset>
            <legend>Regisztráció</legend>
            <br>
            <input type="text" name="last_name" placeholder="vezetéknév" required><br><br>
            <input type="text" name="first_name" placeholder="utónév" required><br><br>
            <input type="text" name="username" placeholder="felhasználói név" required><br><br>
            <input type="password" name="password" placeholder="jelszó" required><br><br>
            <input type="submit" name="regisztracio" value="Regisztráció">
            <br>&nbsp;
        </fieldset>
    </form>
