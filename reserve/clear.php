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

    <title>FARVAS</title>
    <meta http-equiv="refresh" content="1; URL=">
</head>

<style>
    .text1 {
        font-size: 20px;
    }

    .number_area {
        margin-top: 10px;
        padding-top: 10px;
        padding: 10px;
        margin-top: 10px;
        font-size: 20px;
        border: 7px groove black;
    }
</style>


<body>


    <?php
    $con = new mysqli("localhost", "root", "", "FARVAS");
    $con->set_charset("utf8");
    $uid = $_SESSION["uid"];
    $sql = "SELECT res_number,res_datetime FROM `tel_res` WHERE uid = $uid AND guide = 0";
    $rs = $con->query($sql);
    $row = $rs->fetch_assoc();
    if (!$row) {
        exit("セッションエラーです。再度ログインしてください");
    } else {
        $res_number = $row["res_number"];
        $res_datetime = $row["res_datetime"];
        echo '<div class=number_area>予約番号： ' . $res_number . ' 番<br>予約時間：' . $res_datetime . '</div>';
    }
    ?>
    <br>
    <div class=text1>上記の予約を取り消しますか？？</div><br>
    <div>はい</div>
    <div>いいえ</div>
    <div></div>
    <div></div>

</body>