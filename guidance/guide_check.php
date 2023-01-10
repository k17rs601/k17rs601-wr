<!DOCTYPE html>
<link rel="stylesheet" href="receptionist.css">
<html lang="ja">

<head>
    <link rel="stylesheet" href="register.css">
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>座席選択</title>
</head>

<?php
$zaseki = $_POST["zaseki"];
$con = new mysqli("localhost", "root", "", "FARVAS"); //MySQLサーバへ接続
$con->set_charset('utf8'); //データベースとの通信をUTF8で行う。
$sql = "UPDATE `tel_zaseki` SET zaskei_state = 0 , guide_datetime = null, guide_number = null WHERE guide_number = $res_number";
$rs = $con->query($sql);
header("Location:guide.php");
?>