<?php
session_start();
if (isset($_SESSION["count1"])) {
    die("セッションエラーです。再度ログインしてください。");
}
?>
<!DOCTYPE html>
<html lang="ja">


<?php
date_default_timezone_set('Asia/Tokyo');     //基準時刻を日本に設定
$date = date('Y-m-d');
$conn = new mysqli("localhost", "root", "", "FARVAS"); //MySQLサーバへ接続
$conn->set_charset('utf8'); //データベースとの通信をUTF8で行う。
$sql1 = "SELECT MAX(res_number) FROM tel_res WHERE res_number < 1000 and DATE(res_datetime) = '$date' ;"; //即時予約の番号の最大値を取得
$PeopleNumber = $_POST['howp']; //人数取得

$rs = $conn->query($sql1);
$row = $rs->fetch_assoc();
if (!$row) {
    exit('サーバーエラーに接続できませんでした。');
}
if ($row["MAX(res_number)"] < 100) {
    $res_number = 100;
} else {
    $res_number = $row["MAX(res_number)"] + 1; //新しい予約番号
}

if ($PeopleNumber <= 6) { //必要なテーブル数の計算
    $TableNumber = 1;
} else if ($PeopleNumber <= 12) {
    $TableNumber = 2;
} else if ($PeopleNumber <= 18) {
    $TableNumber = 3;
}
$uid = $_SESSION["uid"];

$sql = "INSERT INTO tel_res (uid,people_number,table_number,res_number,reserve) VALUES ($uid,$PeopleNumber,$TableNumber,$res_number,1);";
$rs = $conn->query($sql);

?>

<style>
    .reserve_position {
        width: 100%;
        text-align: center;
    }

    .reserve_number {
        border: 3px dotted black;
        text-align: center;
        font-size: 140%;
    }

    #btn_save {
        margin-top: 3%;
        font-size: 110%;

    }
</style>

<head>
    <title>FARVAS</title>
    <link rel="stylesheet" href="login.css">
    <meta http-equiv="Content-TYPE" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width">
</head>

<body>

    予約が完了いたしました。<br>
    <h2>注文内容</h2>
    <div class="reserve_position">
        <div class="reserve_number">
            <?php
            echo date('Y-m-d H:i') . "<br>予約番号 " . $res_number; //現在日付時間を表示
            ?>

        </div>
        <button id="btn_save" onclick="location.href='top.php'">TOPに戻る
    </div>
</body>

</html>