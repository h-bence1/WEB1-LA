<h2>Küldjön nekünk üzenetet</h2>
<form id="kapcsolat" action="kapcs" method="post">
    <fieldset>
        <legend>Üzenet</legend>
        <div>
            <label for="email">Email cím: </label>
            <input type="email" id="email" name="email" placeholder="Email cím" required>
        </div>
        <div>
            <label for="message">Üzenet: </label>
            <textarea name="message" id="" cols="30" rows="10" required minlength="10" placeholder="Üzenet"></textarea>
        </div>
    </fieldset>
    <button type="submit" class="button">Üzenet elküldése</button>
</form>

