<?php
$uzenet = array();
$MAPPA = $_SERVER['DOCUMENT_ROOT'] . '/kepek/';
$MAXMERET = 2 * 1024 * 1024;
$MEDIATIPUSOK = ['image/jpeg', 'image/png', 'image/gif'];

if (!is_dir($MAPPA)) {
    if (!mkdir($MAPPA, 0777, true)) {
        die("A mappa nem hozható létre: $MAPPA");
    }
}

if (isset($_POST['kuld'])) {
    foreach ($_FILES as $fajl) {
        if ($fajl['error'] == 4) {
        } elseif (!in_array($fajl['type'], $MEDIATIPUSOK)) {
            $uzenet[] = "Nem megfelelő típus: " . $fajl['name'];
        } elseif ($fajl['error'] == 1 || $fajl['error'] == 2 || $fajl['size'] > $MAXMERET) {
            $uzenet[] = "Túl nagy állomány: " . $fajl['name'];
        } else {
            $celutvonal = $MAPPA . strtolower(basename($fajl['name']));
            $relativUt = 'kepek/' . strtolower(basename($fajl['name']));

            if (file_exists($celutvonal)) {
                $uzenet[] = "Már létezik: " . $fajl['name'];
            } else {
                if (!is_writable($MAPPA)) {
                    die("A mappa nem írható: $MAPPA");
                }

                if (move_uploaded_file($fajl['tmp_name'], $celutvonal)) {
                    $uzenet[] = "A fájl sikeresen feltöltve: " . $fajl['name'];

                    try {
                        $dbh = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, [
                            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                        ]);
                        $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');

                        $uploadedUser = isset($_SESSION['login']) ? $_SESSION['login'] : 'ismeretlen';

                        $stmt = $dbh->prepare("INSERT INTO images (filename, filepath, uploadedUser)
                            VALUES (:filename, :filepath, :uploadedUser)");
                        $stmt->execute([
                            ':filename' => $fajl['name'],
                            ':filepath' => $relativUt,
                            ':uploadedUser' => $uploadedUser
                        ]);
                        $uzenet[] = 'Adatbázisba sikeres beszúrás: ' . $fajl['name'];
                        $sqlSelect = "SELECT id FROM users WHERE username = :username";
                        $sth = $dbh->prepare($sqlSelect);
                        $sth->execute(array(':username' => $_SESSION['login']));
                        $row = $sth->fetch(PDO::FETCH_ASSOC);

                        if ($row) {
                            $log = "INSERT INTO logs(userId, action) VALUES(:userId, :action)";
                            $sth = $dbh->prepare($log);
                            $sth->execute(array(
                                ':userId' => $row["id"],
                                ':action' => 'Képfeltöltés történt: ' . $fajl['name']
                            ));
                            $uzenet[] = 'Feltöltés logolva: ' . $fajl['name'];
                        }
                    } catch (PDOException $e) {
                        $uzenet[] = "Adatbázis hiba: " . $e->getMessage();
                    }
                } else {
                    $uzenet[] = 'Hiba a fájl mentésekor: ' . $fajl['name'];
                }
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Galéria</title>
</head>
<body>
<h1>Feltöltés a galériába:</h1>
<?php if (!empty($uzenet)) : ?>
    <ul>
        <?php foreach ($uzenet as $u) echo "<li>$u</li>"; ?>
    </ul>
<?php endif; ?>
<form action="kepfeltoltes" method="post" enctype="multipart/form-data">
    <label>Első:
        <input type="file" name="elso" required>
    </label>
    <input type="submit" name="kuld" value="Feltöltés">
</form>
</body>
</html>
