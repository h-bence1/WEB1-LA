<?php
if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['last_name']) && isset($_POST['first_name'])) {
    try {
        // Kapcsolódás
        $dbh = new PDO(
            DB_DSN,
            DB_USERNAME,
            DB_PASSWORD,
            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
        );
        $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');

        $sqlSelect = "select id from users where username = :username";
        $sth = $dbh->prepare($sqlSelect);
        $sth->execute(array(':username' => $_POST['username']));
        if ($row = $sth->fetch(PDO::FETCH_ASSOC)) {
            $uzenet = "A felhasználói név már foglalt!";
            $ujra = "true";
        } else {
            $sqlInsert = "insert into users(id, last_name, first_name, username, password)
                          values(0, :last_name, :first_name, :username, :password)";
            $stmt = $dbh->prepare($sqlInsert);
            $stmt->execute(array(
                ':last_name' => $_POST['last_name'],
                ':first_name' => $_POST['first_name'],
                ':username' => $_POST['username'],
                ':password' => sha1($_POST['password'])
            ));
            if ($stmt->rowCount() > 0) {
                $newUserId = $dbh->lastInsertId();
                $log = "insert into logs(userId, action) values(:userId, :action)";
                $sth = $dbh->prepare($log);
                $sth->execute(array(':userId' => $newUserId, ':action' => 'Új felhasználó regisztrált'));
                $uzenet = "A regisztrációja sikeres.<br>Azonosítója: {$newUserId}";
                $ujra = false;
            } else {
                $uzenet = "A regisztráció nem sikerült.";
                $ujra = true;
            }
        }
    } catch (PDOException $e) {
        $uzenet = "Hiba: " . $e->getMessage();
        $ujra = true;
    }
} else {
    header("Location: .");
}
?>
