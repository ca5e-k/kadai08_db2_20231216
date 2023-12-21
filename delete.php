<?php
require("./dbconnect.php");

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = $_GET['id'];

    $stmt = $db->prepare("DELETE FROM parentconsults WHERE ParentConsultID = ?");
    $stmt->execute([$id]);

    echo "削除が完了しました。";
    // 削除後に別のページにリダイレクトすることもできます
    header("Location: top.php");
    exit;
}
?>