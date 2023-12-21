<!-- http://localhost/kadai08_db2_20231216/top.php -->

<?php

require("./dbconnect.php");
session_start();

$sql = 'SELECT ParentConsultID, Title, ContentText, PermissionID, StatusID FROM parentconsults';
$stmt = $db->query($sql);

echo "<table border='1'>\n";
echo "\t<thead>\n";
echo "\t\t<tr>\n";
echo "\t\t\t<th>タイトル</th><th>質問内容</th><th>ステータス</th>\n";
echo "\t\t</tr>\n";
echo "\t</thead>\n";
echo "\t<tbody>\n";
while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $titleLink = "<a href='details.php?id={$result['ParentConsultID']}'>{$result['Title']}</a>";
    echo "\t\t<tr>\n";
    echo "\t\t\t<td>{$titleLink}</td>\n";
    echo "\t\t\t<td>{$result['ContentText']}</td>\n";
    echo "\t\t\t<td>{$result['StatusID']}</td>\n";
    echo "<td><a href='delete.php?id={$result['ParentConsultID']}'>削除</a></td>";
    echo "\t\t</tr>\n";
}
echo "\t</tbody>\n";
echo "</table>\n";

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="newquestion.php" method="post">
    <label for="title">タイトル:</label><br>
    <input type="text" id="title" name="title"><br>

    <label for="content">質問内容:</label><br>
    <textarea id="content" name="content"></textarea><br>

    <input type="submit" value="登録">
</form>
</body>
</html>
