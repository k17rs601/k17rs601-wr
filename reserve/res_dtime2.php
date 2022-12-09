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

$conn = new mysqli("localhost", "root", "", "FARVAS"); //MySQLサーバへ接続
$conn->set_charset('utf8'); //データベースとの通信をUTF8で行う。
$PeopleNumber = $_POST['howp'];
$reserve_datetimest = $_POST['reserve_day'] . " " . $_POST['reserve_time'] . ":00"; //POSTで日付と時間を受け取り、Y-n-j H:i:sの形で文字列表示
$reserve_datetime = date('Y-n-j H:i:s', strtotime($reserve_datetimest)); //文字列をDATE型に変更（INSERT用）
$date = date('Y-n-j', strtotime($reserve_datetime)); //Y-n-jの形で予約時間を表示（SELECT用）

$sql1 = "SELECT MAX(res_number) FROM tbl_res WHERE res_number > 999 and DATE(res_datetime) = '$date' ;"; //即時予約の番号の最大値を取得

$rs = $conn->query($sql1);
$row = $rs->fetch_assoc();
if (!$row) {
    exit('サーバーエラーに接続できませんでした。');
}
if ($row["MAX(res_number)"] < 1000) {
    $res_number = 1000;
} else {
    $res_number = $row["MAX(res_number)"] + 1; //新しい予約番号
}


if ($PeopleNumber <= 6) { //必要なテーブル数の計算
    $TableNumber = 1;
} else {
    $TableNumber = $PeopleNumber / 6 + 1;
}
$uid = $_SESSION["uid"];

$sql = "INSERT INTO tbl_res(uid,res_datetime,people_number,table_number,res_number,reserve) VALUES ( $uid ,'$reserve_datetime', $PeopleNumber , $TableNumber , $res_number ,1);"; //予約を登録
// if (!$uid) {
//     exit("セッションタイムアウト" . $uid . "<button onclick=location.href='top.php'>TOPに戻る");
// }
$rs = $conn->query($sql);
echo "<br>" . $sql . "<br><br>";
echo $sql1 . "<br><br><br>";

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
    echo "<br>予約番号" . $res_number; //現在日付時間を表示
    echo "<br>文字列時間" . $reserve_datetimest . "<br>時間" . $reserve_datetime;
    ?>
    <button onclick="location.href='top.php'">TOPに戻る
</body>

</html>