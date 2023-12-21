<?php
// requireは別ファイルに書かれた処理を実行すること
// ./ は「現在のディレクトリ」を意味
require("./dbconnect.php");
session_start(); // サーバー側にデータを保存する仕組み

if (!empty($_POST)) { // フォーム送信された場合のみ中の内容を実行
    /* 入力情報の不備を検知 */
    if ($_POST['userName'] === "") {
        $error['userName'] = 'blank';
    }
    if ($_POST['email'] === "") {
        $error['email'] = "blank";
    }
    if ($_POST['password'] === "") {
        $error['password'] = "blank";
    }

    /* メールアドレスの重複を検知 */
    if (!isset($error)) {
        $member = $db->prepare('SELECT COUNT(*) as cnt FROM user WHERE email=?');
        $member->execute(array(
            $_POST['email']
        ));
        $record = $member->fetch();
        if ($record['cnt'] > 0) {
            $error['email'] = 'duplicate';
        }
    }

    /* エラーがなければ次のページへ */
    if (!isset($error)) {
        $_SESSION['join'] = $_POST;   // フォームの内容をセッションで保存
        header('Location: check.php');   // check.phpへ移動
        exit();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 'companyType' の値を取得
    $companyType = isset($_POST['companyType']) ? $_POST['companyType'] : '';

    // バリデーション
    if ($companyType === 'none') {
        $error['companyType'] = '---';
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
    <title>アカウント作成</title>
    <link href="https://unpkg.com/sanitize.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="content">
        <form action="" method="POST">
            <h1>アカウント作成</h1>
            <p>当サービスをご利用するために、次のフォームに必要事項をご記入ください。</p>
            <br>

            <div class="control">
                <label for="UserName">ユーザー名</label>
                <input id="UserName" type="text" name="UserName">
                <?php if (!empty($error["userName"]) && $error['userName'] === 'blank') : ?>
                    <p class="error">＊ユーザー名を入力してください</p>
                <?php endif ?>
            </div>

            <div class="control">
                <label for="email">メールアドレス<span class="required">必須</span></label>
                <input id="email" type="email" name="email">
                <?php if (!empty($error["email"]) && $error['email'] === 'blank') : ?>
                    <p class="error">＊メールアドレスを入力してください</p>
                <?php elseif (!empty($error["email"]) && $error['email'] === 'duplicate') : ?>
                    <p class="error">＊このメールアドレスはすでに登録済みです</p>
                <?php endif ?>
            </div>

            <div class="control">
                <label for="password">パスワード<span class="required">必須</span></label>
                <input id="password" type="password" name="password">
                <?php if (!empty($error["password"]) && $error['password'] === 'blank') : ?>
                    <p class="error">＊パスワードを入力してください</p>
                <?php endif ?>
            </div>

            <div class="control">
                <label for="companyType">所属会社<span class="required">必須</span></label>
                <select id="companyType" name="companyType" style="text-align: center;">
                    <option value="none" id="none">---</option>
                    <option value="audit" id="audit">監査法人</option>
                    <option value="client" id="client">クライアント</option>
                </select>
                <?php if (!empty($error["companyType"]) && $error['companyType'] === '---') : ?>
                    <p class="error">＊所属会社を選択してください</p>
                <?php endif ?>
            </div>
            <div class="control">
                <button type="submit" class="btn">確認する</button>
            </div>
        </form>
    </div>
</body>

</html>