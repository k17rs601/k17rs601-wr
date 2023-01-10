<!DOCTYPE html>
<link rel="stylesheet" href="receptionist.css">
<html lang="ja">

<?php
$con = new mysqli("localhost", "root", "", "FARVAS"); //MySQLサーバへ接続
$con->set_charset('utf8'); //データベースとの通信をUTF8で行う。
date_default_timezone_set('Asia/Tokyo');
$date = date("Y-m-d");
session_start();


$res_number = $_POST["recenumber"];
$_SESSION['res_number'] = $res_number;
$sql_wait = "SELECT COUNT(resid) FROM `tel_res` WHERE receptionist > 0 AND DATE(res_datetime) = '$date' AND guide = 0 AND hold = 0 AND res_number != $res_number";
$rs = $con->query($sql_wait);
$row = $rs->fetch_assoc();
$wait_num = $row["COUNT(resid)"];
$sql_zaseki = "SELECT COUNT(zaseki_number) FROM `tel_zaseki` WHERE zaseki_state = 0";
$rs = $con->query($sql_zaseki);
$row = $rs->fetch_assoc();
$zaseki_count = $row["COUNT(zaseki_number)"];
$sql = "SELECT table_number FROM `tel_res` WHERE res_number = $res_number AND DATE(res_datetime) = '$date'";
$rs = $con->query($sql);
$row = $rs->fetch_assoc();
$user_table_number = $row['table_number'];
//現在の待ち数 wait_num

?>

<head>
    <?php
    if ($wait_num > 0) {
        echo ' <meta http-equiv="refresh" content="10; URL=top.php">';
    } else if ($zaseki_count > $user_table_number) {
        echo ' <meta http-equiv="refresh" content="10; URL=select_table.php">';
    }
    ?>
    <link rel="stylesheet" href="register.css">
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>ユーザー登録</title>
</head>

<style>
    .evo {
        text-align: center;
    }

    .error {
        font-size: 200%;
        text-align: center;
    }
</style>





<body>
    <?php
    // 座席数を選択する。
    $con = new mysqli("localhost", "root", "", "FARVAS"); //MySQLサーバへ接続
    $con->set_charset('utf8'); //データベースとの通信をUTF8で行う。
    $sql = "SELECT table_number,res_number,reserve,receptionist,hold,guide FROM `tel_res` WHERE res_number = $res_number AND DATE(res_datetime) = '$date'";

    if ($res_number > 9999 || $res_number < 100 || !$res_number) { //異常な予約番号の排除
        exit('<div class = "evo"><a class="error">番号『' . $res_number . '番』は不正な番号です。<br>予約番号をご確認の上、再度番号を入力してください。</a></div><br>
        <a href="top.php">戻る</a>');
    }
    $rs = $con->query($sql);
    $row = $rs->fetch_assoc();

    if (!$row) {
        echo '<div class = "evo"><a class="error">検索結果がございません。<br>番号をお確かめの上、再度番号を入力してください。</a></div>';
        exit("<br>
        <a href='top.php'>戻る</a>");
    } else {

        //$res_num = $row["res_number"];
        if ($row["hold"] == 1) { //保留状態のお客を戻す。
            $sql = "UPDATE `tel_res` SET hold = 0 , receptionist = 2 WHERE res_number = $res_number AND DATE(res_datetime) = '$date'";
            $con->query($sql);
        } else if ($row["receptionist"] != 0) {
            exit("こちらの番号の受付は完了しています。順番が来るまでもうしばらくお待ちください。<br>
            <a href='top.php'>戻る</a>");
        } else if ($row["guide"] != 0) {
            exit("こちらの番号の案内は完了しております。再度番号をお確かめください。<br>
            <a href='top.php'>戻る</a>");
        } else {
            $sql = "UPDATE `tel_res` SET receptionist = 3 WHERE DATE(res_datetime) ='$date' AND res_number = $res_number";
            $con->query($sql);
        }
    }


    ///ここから案内待ち分岐と座席数分岐
    //現在の待ち数==wait_num
    //空席数==zaseki_count
    //予約席数==user_table_number

    $sql11 = "UPDATE `tel_zaseki` SET guide_number = $res_number ,guide_datetime = '$date' WHERE guide_number = null";
    $_SESSION["res_table"] =  $user_table_number;

    if ($wait_num > 0) { //空き席がある場合の処理
        echo "<h4>受付が完了しました。</h4>";
        echo "<h3>現在案内可能なお席がございません。下記の番号でお待ち下さい。</h3>";
        echo "<h3>案内番号</h3> <h2>$res_number 番</h2> ";
    } else if ($zaseki_count <= $user_table_number) { //空席が案内テーブル数より少ない場合の処理
        echo "<h4>受付が完了しました。</h4>";
        echo "<h3>現在案内可能なお席がございません。下記の番号でお待ち下さい。</h3>";
        echo "<h3>案内番号</h3> <h2>$res_number 番</h2> ";
    } else if ($zaseki_count > $user_table_number) {
        echo "<h4>受付が完了しました。</h4>";
        echo "<h3>空席が複数存在するので座席選択画面に移ります。</h3>";
        echo '<button onclick="location.href=' . "'select_table.php'" . '">座席選択画面へ</button>';
        exit();
    }
    session_destroy();

    ?>
    <button onclick="location.href='top.php'">TOPに戻る</button>

</body>

</html>