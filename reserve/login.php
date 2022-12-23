<?php
session_start();
session_regenerate_id();


$loginid = $_POST['loginid'];
$pass = $_POST['pass'];

$con = new mysqli('localhost', 'root', '', 'FARVAS');
$sql1 = "SELECT email , upass FROM tel_user WHERE email ='{$loginid}' AND upass='{$pass}'";
$sql2 = "SELECT uid,loginid,upass,uname FROM tel_user WHERE loginid ='{$loginid}' AND upass ='{$pass}'";
$conn = new mysqli("localhost", "root", "", "FARVAS"); //MySQLサーバへ接続
if ($conn->connect_errno) {
    die($conn->connect_error);
}
$conn->set_charset('utf8');
$rs = $conn->query($sql2);

if (!$rs) die('エラー: ' . $conn->error);
$row = $rs->fetch_assoc(); //問合せ結果を1行受け取る
if (!$row) {
    echo '<h2 style ="text-align:center;">ログイン失敗</h2><h4>ユーザーIDまたはパスワードが間違っています。再度入力してください。</h4>';
    exit('<a href="login.html">戻る</a>');
}
$_SESSION["loginid"] = $row['loginid'];
$_SESSION["uname"] = $row['uname'];
$_SESSION["upass"] = $row['upass'];
$_SESSION["uid"] = $row['uid'];
header('Location:top.php');
