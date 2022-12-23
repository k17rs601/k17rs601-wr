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
//$sql2 = "SELECT COUNT(*) AS cnt FROM tel_res WHERE res_number < 1000 and DATE(res_datetime) = '$date' ;";
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
} else {
    $TableNumber = $PeopleNumber / 6 + 1;
}
$uid = $_SESSION["uid"];
// if (!$uid) {
//     exit("セッションタイムアウト" . $uid . "<button onclick=location.href='top.php'>TOPに戻る");
// }

$sql = "INSERT INTO tel_res (uid,people_number,table_number,res_number,reserve) VALUES ($uid,$PeopleNumber,$TableNumber,$res_number,1);";
$rs = $conn->query($sql);

?>

<head>
    <title>FARVAS</title>
    <link rel="stylesheet" href="login.css">
    <meta http-equiv="Content-TYPE" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width">
</head>

<body>

    予約が完了いたしました。<br>
    <h2>注文内容</h2><br>
    <?php
    echo date('Y-m-d H:i') . " 予約番号" . $res_number; //現在日付時間を表示
    ?>
    <button onclick="location.href='top.php'">TOPに戻る
</body>

</html>