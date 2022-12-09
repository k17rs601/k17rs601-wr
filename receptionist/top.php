<!DOCTYPE html>
<link rel="stylesheet" href="receptionist.css">
<html lang="ja">


<?php   // 
date_default_timezone_set('Asia/Tokyo');
$date = date('Y-m-d');
$datetime = date('Y-m-d H:i');
$con = new mysqli('localhost', 'root', '', 'FARVAS');
$con->set_charset('utf8');

//SQL命令文
$sql = "SELECT COUNT(resid) FROM `tbl_res` WHERE register >= 0 AND DATE(res_datetime) = '$date'";
$sql1 = "UPDATE tbl_res SET register = 2 WHERE register = 3 AND res_datetime = '$datetime' AND res_number > 999";
$sql2 = "SELECT res_number FROM `tbl_res` WHERE DATE(res_datetime) = '$date' AND hold = 0 AND register > 0  ORDER BY register , res_datetime ASC;";
$sql4 = "SELECT res_number FROM `tbl_res` WHERE DATE(res_datetime) = '$date' AND hold = 1";

///0<受付待ちの組数、1<予約日付、2<受付済みの利用客を早い順番に検索 
$rs = $con->query($sql);
$row = $rs->fetch_assoc(); //只今の順番待ち

$rs1 = $con->query($sql1);

$rs2 = $con->query($sql2);
$row2 = $rs2->fetch_assoc();

if ($row2["register"] = 2 || $row2["register"] = 3) {
  $rs3 = $con->query("UPDATE `tbl_res` SET register = 1 WHERE DATE(res_datetime) = '$date' AND res_number = " . $row2['res_number'] . " ;");
}

$rs4 = $con->query($sql4);
$row4 = $rs4->fetch_assoc();


$regi_num; //順番待ち数
$next_num; //次の番号
$regi_number; //全待ち番号
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


  <?php
  if ($row["COUNT(resid)"] > 0) {
    echo '<meta http-equiv="refresh" content="10; URL="'; //<!-- ５秒ごとに更新 -->
    echo "５秒ごとに更新";
  }
  ?>

</head>


<body>
  次の案内：
  <?php
  if ($row["COUNT(resid)"] == 0) {
    echo "順番待ちはございません。";
  } else {
    echo $row2["res_number"] . "番<br>";
    echo "現在待ち数：" . $row["COUNT(resid)"] . "組";
  }
  ?>
  <br>
  予約なしはこちら
  <a href="receptionist.html">受付</a>

  <br>
  予約済みはこちら
  <a href="checkin.php">チェックインする</a>
  <br>

  <table>
    <tr>
      <th>受付済み</th>
      <th>保留中</th>
    </tr>
    <?php
    for ($i = 1; $i < 10; $i++) {
      if (!$row2) {
        echo "<tr><th>" . "" . "</th>";
      } else {
        echo "<tr><th>" . $row2["res_number"] . "</th";
        $row2 = $rs2->fetch_assoc();
      }

      if (!$row4) {
        echo "<th>" . "" . "</th></tr>";
      } else {
        echo "<th>" . $row4["res_number"] . "</th></tr>";
        $row4 = $rs4->fetch_assoc();
      }
    }

    ?>
  </table>

</body>