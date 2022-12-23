<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="register.css">
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>ユーザー登録</title>
</head>

<body>
    <?php
    $na = $_POST['name'];
    $ema = $_POST['email'];
    $pas  = $_POST['pass'];
    $uid = $_POST['uid'];
    $con = new mysqli('localhost', 'root', '', 'FARVAS');
    if (!$uid || !$na || !$ema || !$pas) {
        if (!$na) {
            echo "「ユーザーネーム」";
        }
        if (!$ema) {
            echo "「メールアドレス」";
        }
        if (!$uid) {
            echo "「ユーザーID」";
        }
        if (!$pas) {
            echo "「パスワード」";
        }
        exit("が設定されていません。再度入力し直してください。<br><button style='text-align:center;' onclick='history.back()'>戻る</button>");
    }
    if (!$con) {
        exit('データベースに接続できませんでした。');
    }

    $result = mysqli_select_db($con, 'FARVAS');
    if (!$result) {
        exit('データベースを選択できませんでした。');
    }

    $result = mysqli_query($con, "SELECT * FROM tel_user");
    if (!$result) {
        exit('文字コードを指定できませんでした。');
    }

    //////uidとメールアドレスの被り防止//////
    // $result = $con->query('SELECT loginid FROM tel_user WHERE loginid ="{$uid}"');
    // if (!$result) {
    //     exit('errer');
    // }
    // foreach ($result as $row) {
    //     echo $row['loginid'];
    // }
    ////////////s

    // $coun = mysqli_query($con,"SELECT COUNT(*) FROM tel_user;");
    $result = mysqli_query($con, "INSERT INTO tel_user(loginid,uname, email, upass) VALUES('$uid','$na', '$ema', '$pas')");
    if (!$result) {
        exit('データを登録できませんでした。');
    }

    $con = mysqli_close($con);
    ?>
    <p>登録が完了しました。<br /><a href="login.html">戻る</a></p>
</body>

</html>