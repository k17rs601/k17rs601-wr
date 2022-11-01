<?php
session_start();
session_regenerate_id();

?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-TYPE" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="listyle.css">
</head>

<body>
    <?php
    $uid = $_POST['uid'];
    $pass = $_POST['pass'];
    $con = mysqli_connect('localhost', 'root', '', 'FAMIs');
    $sql1 = "SELECT email , upass FROM tbl_user WHERE email ='{$uid}' AND upass='{$pass}'";

    $conn = new mysqli("localhost", "root", "", "FAMIs"); //MySQLサーバへ接続
    if ($conn->connect_errno) {
        die($conn->connect_error);
    }
    $conn->set_charset('utf8');
    $rs = $conn->query("SELECT uid , upass ,uname FROM tbl_user WHERE uid ='{$uid}' AND upass ='{$pass}'");

    if (!$rs) die('エラー: ' . $conn->error);
    $row = $rs->fetch_assoc(); //問合せ結果を1行受け取る
    if (!$row) {
        echo '<h2 style ="text-align:center;">ログイン失敗</h2><h4>ユーザーIDまたはパスワードが間違っています。再度入力してください。</h4>';
        exit('<a href="login.html">戻る</a>');
    }
    $_SESSION["uid"] = $row['uid'];
    $_SESSION["uname"] = $row['uname'];
    $_SESSION["upass"] = $row['upass'];
    header("Location:top.php");
    ?>
</body>

</html>