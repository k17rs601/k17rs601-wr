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
$sql = "SELECT COUNT(resid) FROM `tel_res` WHERE receptionist >= 0 AND DATE(res_datetime) = '$date' AND reserve = 1";
$sql1 = "UPDATE tel_res SET receptionist = 2 WHERE receptionist = 3 AND res_datetime <= '$datetime' AND res_number > 999";
$sql2 = "SELECT res_number , receptionist ,table_number  FROM `tel_res` WHERE DATE(res_datetime) = '$date' AND hold = 0 AND receptionist > 0 ORDER BY receptionist , res_datetime ASC;";
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

if ($row2) {
  $fst_number = $row2["res_number"];
  $next_number = $row2["res_number"];
  $sql_update = "UPDATE `tel_res` SET receptionist = 1 WHERE DATE(res_datetime) = '$date' AND res_number = $fst_number;";

  if ($row2["receptionist"] >= 2) { //
    $rs3 = $con->query($sql_update);
  }
}

$rs4 = $con->query($sql4);
$row4 = $rs4->fetch_assoc(); ///保留状態の客チェック


//空席時の案内処理
if ($row2) {
  $table_count = $row2['table_number'];
  $tbl_sql = "SELECT COUNT(zaseki_state) FROM `tel_zaseki` WHERE zaseki_state = 0";
  $rs_tbl = $con->query($tbl_sql);
  $row_tbl = $rs_tbl->fetch_assoc();

  if ($row_tbl) {
    $t = $row_tbl["COUNT(zaseki_state)"];
    if ($table_count <= $t) {

      $select_zaseki_sql = "SELECT zaseki_number FROM `tel_zaseki` WHERE zaseki_state = 0;";
      $rs_select_zaseki = $con->query($select_zaseki_sql);
      $row_select_zaseki = $rs_select_zaseki->fetch_assoc();
      $i = 0;
      $s = 0;
      while ($i < $table_count) {
        echo "o";
        $tabl = $row_select_zaseki['zaseki_number'];

        $sql5 = "UPDATE `tel_zaseki` SET zaseki_state = 1 ,guide_number = $fst_number , guide_datetime = '$datetime' WHERE zaseki_number = $tabl;";
        $rs5 = $con->query($sql5);

        $row_select_zaseki = $rs_select_zaseki->fetch_assoc();
        $i++;
      }
      //最初の案内を完了する。
      $sql_fst_clear = "UPDATE `tel_res` SET guide = 1 , reserve = 0 ,receptionist = 0 WHERE res_number = $fst_number";
      $rs_fst = $con->query($sql_fst_clear);
    }
  }
}


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

  .nextguide_text {
    margin-top: 2%;
    margin-left: 2%;
  }

  .nextguide {
    margin-top: 4%;
    margin-left: 2%;
    font-size: 170%;
    text-align: center;
  }

  a#text_number {
    font-size: 120%;
  }

  .table {
    margin-top: 4%;
    width: 73%
  }

  #href1 {
    background-color: pink;
    width: 45%;
    text-align: center;
    padding: 5%;
    border: 4px solid black;
    margin-left: 2%;
    margin-right: 2%;
  }

  #href2 {
    background-color: lightblue;
    width: 45%;
    text-align: center;
    padding: 5%;
    padding-left: 0;
    padding-right: 0;
    border: 4px solid black;
  }

  #reservein {
    font-size: 95%;
  }

  #reserveout {
    font-size: 95%;
  }

  #taptext1 {
    font-size: 300%;
  }

  #taptext2 {
    font-size: 200%;
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


      // $sql_resereve = "UPDATE `tbl_res SET reserve = 0 WHERE "


      for ($i = 1; $i < 13; $i++) {
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
      echo '</table></div><div class="nextguide_text">次の案内：';
      if ($row["COUNT(resid)"] == 0 || !$row2) {
        echo "現在順番待ちはございません。</div>";
      } else {
        echo "<a id ='text_number'>" . $next_number . "番</a><br></div>";
      }
      echo '<div class ="nextguide">';
      echo "現在待ち数：" . $row["COUNT(resid)"] . "組";
      echo "</div>";

      ?>
      <table class="table">
        <tr>
          <th id="reserveout">予約なしはこちら</th>
          <th id="reservein">予約済み・保留中はこちら</th>
        </tr>
        <tr>
          <td id="href1"><a href="receptionist.html" id="taptext1">受付</a></td>
          <td id="href2"><a href="checkin.html" id="taptext2">チェックイン</a>
          </td>
        </tr>
      </table>
</body>