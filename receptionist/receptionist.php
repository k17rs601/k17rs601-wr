<!DOCTYPE html>
<link rel="stylesheet" href="receptionist.css">
<html lang="ja">

<head>
    <link rel="stylesheet" href="register.css">
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>ユーザー登録</title>
</head>

<body>
    <?php
    date_default_timezone_set('Asia/Tokyo');
    $datetime = date('Y-m-d H:i');
    $date = date('Y-m-d');
    $recenumber = $_POST["recenumber"];
    if ($recenumber > 18) {
        exit("入力した人数が多過ぎます.
        19名を超える際は店員に申し付け下さい。<br>
        <a href='top.php'>TOPに戻る</a>");
    }
    if ($recenumber == null) {
        exit("0名は無効です。人数を入力し直してください。<br>
        <a href='receptionist.html'>戻る</a>");
    }
    $con = new mysqli("localhost", "root", "", "FARVAS"); //MySQLサーバへ接続
    $con->set_charset('utf8'); //データベースとの通信をUTF8で行う。
    $sql = "SELECT res_number FROM `tel_res` WHERE DATE(res_datetime) = '$date' AND res_number <= 999 ORDER BY res_number DESC";

    $rs = $con->query($sql);
    $row = $rs->fetch_assoc();

    if ($row != null) { //予約番号を作成
        $recep_number = $row["res_number"] + 1;
    } else {
        $recep_number = 100;
    }

    if ($recenumber <= 6) { //必要なテーブル数の計算
        $zaseki_number = 1;
    } else {
        $zaseki_number = $recenumber / 6 + 1;
    }


    $sql1 = "INSERT INTO `tel_res`(res_number,people_number,table_number,receptionist) VALUES ($recep_number,$recenumber,$zaseki_number,3)";
    $con->query($sql1);
    echo $sql1;
    //データベースに問い合わせ、残りの空き席数を検索

    //　データベースに新規登録(reception = 3,table_number,poeple_number)
    //　
    //　
    //　
    //　
    //　
    //　

    ?>
    <a href="top.php">TOPに戻る</a>

</body>

</html>