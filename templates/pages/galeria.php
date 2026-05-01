<?php

try {
    $dbh = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD,
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');

    $sql = "SELECT filename, filepath, uploaded_at, uploadedUser FROM images ORDER BY uploaded_at DESC";
    $stmt = $dbh->query($sql);
    $kepek = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Adatbázis hiba: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Galéria</title>
</head>
<body>
<h1>Galéria</h1>
<div id="galeria">
    <?php if ($kepek) {
        ?>
        <?php
        foreach ($kepek as $kep): ?>
            <div class="kep">
                <img src="<?= htmlspecialchars($kep['filepath']) ?>">
                <p class="kep_name"><strong>Név:</strong> <?= htmlspecialchars($kep['filename']) ?></p>
                <p class="kep_uploader"><strong>Feltöltő:</strong> <?= htmlspecialchars($kep['uploadedUser']) ?></p>
                <p class="kep_date"><strong>Dátum:</strong> <?= date($DATUMFORMA, strtotime($kep['uploaded_at'])) ?></p>
            </div>
        <?php endforeach;
    } else {
        ?>
        <h1>A galéria üres</h1>
        <?php
    }
    ?>
</div>
</body>
</html>
