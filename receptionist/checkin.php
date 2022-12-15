<!DOCTYPE html>
<link rel="stylesheet" href="receptionist.css">
<html lang="ja">

<head>
    <link rel="stylesheet" href="register.css">
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>ユーザー登録</title>
</head>

<?php
date_default_timezone_set('Asia/Tokyo');
$date = date("Y-m-d");
session_start();
$res_number = $_POST["res_number"];
?>

<body>
    <?php
    // 座席数を選択する。
    $con = new mysqli("localhost", "root", "", "FARVAS"); //MySQLサーバへ接続
    $con->set_charset('utf8'); //データベースとの通信をUTF8で行う。
    $sql = "SELECT res_number,reserve,receptionist,hold,guide FROM `tbl_res` WHERE res_number = $res_number AND DATE(res_datetime) = '$date'";

    if ($res_number > 9999 || $res_number < 100 || $res_number == null) { //異常な予約番号の排除
        exit("予約番号が不正です。再度番号を入力し直してください。<br>
        <a href='receptionist.html'>戻る</a>");
    }
    $rs = $con->query($sql);
    $row = $rs->fetch_assoc();

    if ($row == null) {
        echo "検索結果がございません。番号をお確かめの上、再度番号を入力してください。";
        exit("<br>
        <a href='receptionist.html'>戻る</a>");
    } else {
        if ($row["hold"] == 1) { //保留状態のお客を戻す。
            $sql = "UPDATE `tbl_res` SET hold = 0 , receptionist = 2 WHERE res_number = $res_number AND DATE(res_datetime) = '$date'";
            $con->query($sql);
        } else if ($row["receptionist"] != 0) {
            exit("こちらの番号の受付は完了しています。順番が来るまでもうしばらくお待ちください。<br>
            <a href='receptionist.html'>戻る</a>");
        } else if ($row["guide"] != 0) {
            exit("こちらの番号の案内は完了しております。再度番号をお確かめください。<br>
            <a href='receptionist.html'>戻る</a>");
        } else {
            $sql = "UPDATE `tbl_res` SET receptionist = 3 WHERE DATE(res_datetime) ='$date' AND res_number = $res_number";
            $con->query($sql);
        }
    }
    ?>
    <a href="top.php">TOPに戻る</a>

</body>

</html>