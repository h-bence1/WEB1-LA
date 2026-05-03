<?php
if (isset($_SESSION["csn"]) && isset($_SESSION["login"]) && isset($_SESSION["un"])) {
    try {
        $dbh = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD,
            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');

        $sqlSelect = "
            SELECT logs.id, logs.userId, logs.action, users.username, users.last_name, users.first_name
            FROM logs
            JOIN users ON logs.userId = users.id
        ";
        $sth = $dbh->prepare($sqlSelect);
        $sth->execute();
        $rows = $sth->fetchAll(PDO::FETCH_ASSOC); // Több sor lekérése

        if ($rows) {
            ?>
            <table>
                <thead>
                <tr>
                    <th class="table_id">Azonosító</th>
                    <th class="table_userId">User_ID</th>
                    <th class="table_user">Felhasználó Név</th>
                    <th class="table_last_name">Vezetéknév</th>
                    <th class="table_first_name">Keresztnév</th>
                    <th class="table_action">Művelet</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($rows as $item) {
                    ?>
                    <tr>
                        <td class="table_id"><?= $item['id'] ?></td>
                        <td class="table_userId"><?= $item['userId'] ?></td>
                        <td class="table_user"><?= $item['username'] ?></td>
                        <td class="table_last_name"><?= $item['last_name'] ?></td>
                        <td class="table_first_name"><?= $item['first_name'] ?></td>
                        <td class="table_action"><?= $item['action'] ?></td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
            <?php
        }
    } catch (PDOException $e) {
        $errormessage = "Hiba: " . $e->getMessage();
    }
} else {
    ?>
    <h1>Az oldal megtekintéséhez elsőnek <a href="belepes">jelentkezz</a> be</h1>
    <?php
}
?>
