<?php
if (isset($_POST['username']) && isset($_POST['password'])) {
    try {
        $dbh = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD,
            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');

        $sqlSelect = "select id, last_name, first_name, password from users where username = :username and password = sha1(:password)";
        $sth = $dbh->prepare($sqlSelect);
        $sth->execute(array(':username' => $_POST['username'], ':password' => $_POST['password']));
        $row = $sth->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $log = "insert into logs(userId, action) values(:userId, :action)";
            $sth = $dbh->prepare($log);
            $sth->execute(array(':userId' => $row["id"], ':action' => 'Felhasználó bejelentkezett'));
            $_SESSION['csn'] = $row['last_name'] . " " . $row['first_name'];
            $_SESSION['un'] = $row['password'];
            $_SESSION['login'] = $_POST['username'];
        } else {
            $errormessage = "Hibás felhasználónév vagy jelszó!";
        }
    } catch (PDOException $e) {
        $errormessage = "Hiba: " . $e->getMessage();
    }
} else {
    header("Location: .");
}
?>
