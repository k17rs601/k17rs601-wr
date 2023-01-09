<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-TYPE" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="login.css">

    <title>FARVAS</title>
    <meta http-equiv="refresh" content="20; URL=">
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
    if (isset($_SESSION["count1"])) {
        die("セッションエラーです。再度ログインしてください。");
    }

    $uid = $_SESSION['uid'];
    $con = new mysqli("localhost", "root", "", "FARVAS");
    $con->set_charset("utf8");
    $sql_update = "UPDATE `tel_res` SET reserve = 0 WHERE reserve = 1 AND uid = $uid";

    if (isset($_POST['service'])) {
        $rs_update = $con->query($sql_update);
        header("Location:top.php");
    }




    $sql = "SELECT res_number,res_datetime FROM `tel_res` WHERE uid = $uid AND guide = 0 AND reserve = 1";
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
    <form action="clear.php" method="post">
        <input type="submit" name="service" value="はい" />
        <input type="button" onclick="location.href='top.php'" value="いいえ" />
    </form>


</body>