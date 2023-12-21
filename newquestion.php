<?php
require("./dbconnect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $content = $_POST['content'];

    // SQLインジェクション対策として、プリペアドステートメントを使用
    $stmt = $db->prepare("INSERT INTO parentconsults (Title, ContentText) VALUES (?, ?)");
    $stmt->execute([$title, $content]);

    echo "新規登録が完了しました。";
}
?>
