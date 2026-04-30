<?php
session_start();

if (isset($_SESSION["login"])) {
    try {
        $dbh = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD,
            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');

        $sql = "SELECT id FROM users WHERE username = :username";
        $sth = $dbh->prepare($sql);
        $sth->execute([':username' => $_SESSION['login']]);
        $user = $sth->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $sql = "INSERT INTO logs (userId, action) VALUES (:userId, :action)";
            $sth = $dbh->prepare($sql);
            $sth->execute([
                ':userId' => $user['id'],
                ':action' => 'Felhasználó kijelentkezett'
            ]);
        }

    } catch (PDOException $e) {
        $errormessage = "Hiba: " . $e->getMessage();

    }
}

$_SESSION = [];
session_unset();
session_destroy();
setcookie(session_name(), '', time() - 3600);

header("Location: .");
exit();
