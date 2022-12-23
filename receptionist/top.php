<!DOCTYPE html>
<link rel="stylesheet" href="receptionist.css">
<html lang="ja">


<?php   // 

use function PHPSTORM_META\sql_injection_subst;

date_default_timezone_set('Asia/Tokyo');
$date = date('Y-m-d');
$datetime = date('Y-m-d H:i');
$con = new mysqli('localhost', 'root', '', 'FARVAS');
$con->set_charset('utf8');
$date_res_clear = date("Y-m-d 00:00:00", strtotime($date));
//SQL命令文
$sql = "SELECT COUNT(resid) FROM `tel_res` WHERE receptionist >= 0 AND DATE(res_datetime) = '$date'";
$sql1 = "UPDATE tel_res SET receptionist = 2 WHERE receptionist = 3 AND res_datetime <= '$datetime' AND res_number > 999";
$sql2 = "SELECT res_number , receptionist FROM `tel_res` WHERE DATE(res_datetime) = '$date' AND hold = 0 AND receptionist > 0 ORDER BY receptionist , res_datetime ASC;";
$sql4 = "SELECT res_number FROM `tel_res` WHERE DATE(res_datetime) = '$date' AND hold = 1";
$sql_res_clear = "UPDATE tel_res SET reserve = 0 WHERE DATE(res_datetime) < '$date_res_clear' AND reserve = 1";
///0<受付待ちの組数、
///2<受付済みの利用客を早い順番に検索
///4<保留状態の客を検索
///res_clear 日付が過去の予約の取り消し 
$con->query($sql_res_clear);
$rs = $con->query($sql); ///0<受付待ちの組数、
$row = $rs->fetch_assoc(); //只今の順番待ち
$reserve_count = $row["COUNT(resid)"];
$hold_count;
$rs1 = $con->query($sql1); ///1<予約日付、
$rs2 = $con->query($sql2);
$row2 = $rs2->fetch_assoc();

if ($row2 != null) {
  $fst_number = $row2["res_number"];
  $next_number = $row2["res_number"];
  $sql_update = "UPDATE `tel_res` SET receptionist = 1 WHERE DATE(res_datetime) = '$date' AND res_number = $fst_number;";

  if ($row2["receptionist"] >= 2) { //
    $rs3 = $con->query($sql_update);
  }
}
if ($row2 != null) {
}

$rs4 = $con->query($sql4);
$row4 = $rs4->fetch_assoc(); ///保留状態の客チェック

?>

<head>
  <title>FARVAR受付サイト</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width">
  <meta name="viewport" content="initial-scale=1.0">
  <!-- iOS/Safari用 -->
  <meta name="apple-mobile-web-app-capable" content="yes">
  <!-- Android/Chrome用 -->
  <meta name="mobile-web-app-capable" content="yes">
  <meta http-equiv="refresh" content="10; URL=">
  <!-- ５秒ごとに更新 -->
</head>

<style>
  * {
    font-size: 30px;
  }
</style>

<body>
  <div class="receptionist_table">
    <table border="1" width="25%" align="right">
      <tr>
        <th width="50%">受付済み</th>
        <th width="50%">保留中</th>
      </tr>
      <?php
      for ($i = 1; $i < 11; $i++) {
        if (!$row2) {
          echo "<tr align='right'><td>" . "　" . "</td>";
        } else if ($row2 != null) {
          echo "<tr align='right'><td>" . $row2["res_number"] . "</td>";
          $row2 = $rs2->fetch_assoc();
        }
        if (!$row4) {
          echo "<td>" . "　" . "</td></tr>";
        } else if ($row4 != null) {
          echo "<td>" . $row4["res_number"] . "</td></tr>";
          $row4 = $rs4->fetch_assoc();
        }
      }
      echo "</table></div>次の案内：";

      if ($row["COUNT(resid)"] == 0 || $row == null) {
        echo "現在順番待ちはございません。";
      } else {
        if ($row2 != null) {
          echo $next_number . "番<br>";
        } else {
          echo "なし<br>";
        }
        echo "現在待ち数：" . $row["COUNT(resid)"] . "組";
      }
      ?>
      <table class="table">
        <tr>
          <th>予約なしはこちら</th>
          <th>予約済みはこちら</th>
        </tr>
        <tr>
          <td><a href="receptionist.html">受付</a></td>
          <td><a href="checkin.html">チェックインする</a>
          </td>
        </tr>
      </table>
      <!-- <br>
      予約なしはこちら
      <a href="receptionist.html">受付</a>

      <br>
      予約済みはこちら
      <a href="checkin.html">チェックインする</a>
      <br> -->

      <!-- 保留中のお客様はこちら
  <a href="checkin.php">チェックインする</a>
  <br> -->

</body>