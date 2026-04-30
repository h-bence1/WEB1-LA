<?php
if (isset($_POST['email']) && isset($_POST['message'])) {
    try {
        $dbh = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD,
            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
        $sqlInsert = "insert into contact(id, email, message)
                          values(0, :email, :message)";
        $stmt = $dbh->prepare($sqlInsert);
        $stmt->execute(array(
            ':email' => $_POST['email'],
            ':message' => $_POST['message'],
        ));
        if ($stmt->rowCount() > 0) {
            $ujra = false;
        } else {
            $ujra = true;
        }
    } catch (PDOException $e) {
        $errormessage = "Hibás email vagy üzenet";
        $ujra = true;
    }
}else{
    header("Location: .");
}
?>
