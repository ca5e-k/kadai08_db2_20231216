<?php
require("./dbconnect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];

    $stmt = $db->prepare("UPDATE parentconsults SET Title = ?, ContentText = ? WHERE ParentConsultID = ?");
    $stmt->execute([$title, $content, $id]);

    echo "更新が完了しました。";
}
?>