<!-- データベースに接続するためのスクリプト -->

<?php
try {
    $db = new PDO('mysql:host=localhost;dbname=ac_db;charset=utf8', 'root', '');// データベースサーバーに接続するための新しいPDOオブジェクトを作成
}   catch (PDOException $e) {// 例外処理が起きたら、$eに格納
    echo "データベース接続エラー：".$e->getMessage();// データベース接続エラーという文言＋エラー内容が表示
}
?>