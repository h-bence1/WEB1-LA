<?php

try {
    $dbh = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD,
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');

    $sql = "SELECT id, email, message FROM contact ORDER BY id DESC";
    $stmt = $dbh->query($sql);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Adatbázis hiba: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Kapcsolatfelvételi kérelmek</title>
</head>
<body>
<h1>Kapcsolatfelvételi kérelmek</h1>
<div id="kapcsolatikerelem">
    <?php
    if ($rows) {
        ?>
        <table>
            <thead>
            <tr>
                <th class="table_id">Azonosító</th>
                <th class="table_email">Email cím</th>
                <th class="table_message">Üzenet</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($rows as $item) {
                ?>
                <tr>
                    <td class="table_id"><?= $item['id'] ?></td>
                    <td class="table_email"><?= $item['email'] ?></td>
                    <td class="table_message"><?= $item['message'] ?></td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
        <?php
    }
    ?>
</div>
</body>
</html>
