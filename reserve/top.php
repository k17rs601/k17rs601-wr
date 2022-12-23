<?php
session_start();
session_regenerate_id();
?>

<!DOCTYPE html>
<html>

<head>
  <meta http-equiv="Content-TYPE" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width">
  <link rel="stylesheet" href="login.css">
  <title>FARVAS予約サイト</title>
  <meta http-equiv="refresh" content="1; URL=">
</head>

<style>
  * {
    margin: 0;
    padding: 0;
  }

  hr#start {
    width: 90%;
    height: 4px;
    background-color: red;
    border: none;
  }

  h1 {
    margin-top: 10px;
    margin-bottom: 2px;
  }

  .sheet {
    background-color: white;
    padding-top: -5px;
    margin: 5px;
    border: 1px groove black;
    border-radius: 10px 10px 10px 10px;
  }

  h3 {
    margin: 10px;
    margin-bottom: 0px;
    font-family: sans-serif;
    text-align: center;
    border: 3px groove #f8b400;
    background-color: #f8b400;
  }

  h4 {
    margin-bottom: 10px;
  }

  h3#listtwo {
    border-color: #93deff;
    background-color: #93deff;
    margin;
  }

  .border1 {
    background-color: white;
    margin-left: 10px;
    margin-right: 10px;
    line-height: 80px;
    font-size: 30px;
    border: 3px groove #f8b400;
    border-top: 0;
  }

  .border#bor1 {
    font-size: 25;
  }

  .border2 {
    background: white;
    font-size: 25px;
    border: 3px groove #f8b400;
    border-top: 0;
    padding: 7px;
    margin-left: 10px;
    margin-right: 10px;
    margin-bottom: 10px;
    line-height: 40px;
  }

  ul li,
  ol li {
    font-size: 20px;
    color: black;
    border-left: solid 14px rgb(241, 157, 0);
    background: whitesmoke;
    /*背景色 */
    margin-bottom: 5px;
    /*下のバーとの余白*/
    margin-left: 5px;
    margin-right: 5px;
    line-height: 1.5;
    border-radius: 0 10px 10px 0;
    /*右側の角だけ丸く*/
    padding: 0.5em;
    list-style-type: none !important;
  }
</style>

<body>
  <?php

  if (isset($_SESSION["count1"])) {
    die("セッションエラーです。再度ログインしてください。");
  }
  date_default_timezone_set("Asia/Tokyo");
  $date = date("Y-m-d");
  $conn = new mysqli("localhost", "root", "", "FARVAS"); //MySQLサーバへ接続
  $conn->set_charset('utf8'); //データベースとの通信をUTF8で行う。 
  $uid = $_SESSION["uid"];
  ////////////sql////////////
  $sql = "SELECT res_number FROM tel_res WHERE uid = '$uid' AND guide = 0 AND reserve = 1"; //ユーザ識別番号が一致する予約番号を取得
  $sql_recepnumber = "SELECT COUNT(res_number) FROM `tel_res` WHERE DATE(res_datetime) = '$date' AND receptionist > 0"; //待ち組数を検索
  $sql_res_userdate = "SELECT res_number , res_datetime FROM `tel_res` WHERE reserve = 1 AND guide = 0 AND DATE(res_datetime) >= '$date'"; //ユーザのデータ(予約時間・番号を取得)

  ////////////sqlからのデータ///////////
  $rs = $conn->query($sql);
  if (!$rs) {
  } else {
    $row = $rs->fetch_assoc();
  }

  $rs1 = $conn->query($sql_recepnumber);
  $row1 = $rs1->fetch_assoc();
  $rs_userdate = $conn->query($sql_res_userdate);
  $row_userdate = $rs_userdate->fetch_assoc();
  if ($row_userdate != null) {
    $userdate_datetime1 = $row_userdate["res_datetime"];
    $userdate_datetime = date("m月d日 H時i分", strtotime($userdate_datetime1));
    $userdate_number = $row_userdate["res_number"];
  }

  ////////////本文////////////
  echo "<h1 style='text-align:center'>FARVAS予約サイト</h1>";
  echo '<h4 style="text-align:right">ようこそ!!' . $_SESSION["uname"] . 'さん。<h4>';
  echo "<hr id='start'>";
  echo "<div class='sheet'>";
  echo "<h3>>>>現在の順番の待ち組数<<< </h3>";
  if ($row1["COUNT(res_number)"] == 0) {
    echo '<div style="text-align:center" class="border1" id ="bor1">';
    echo '現在お待ちのお客様はございません。';
    echo '</div>';
  } else {
    echo '<div style="text-align:center" class="border1">';
    echo $row1["COUNT(res_number)"] . '組';
    echo '</div>';
  }

  ?>

  <h3>>>>お客様のご予約情報<<< </h3>
      <?php
      if (!$row) {
        echo '<div style="text-align:center" class="border2">';
        echo 'お客様のご予約情報はございません。<br>予約を行ってください。';
        echo '</div>';
      } else {
        echo '<div style="text-align:center" class="border2">';
        echo '番号：' . $userdate_number . "<br>予約日時：" . $userdate_datetime;
        echo '</div></div>';
      }
      ?>
      <div>
        <h3 id="listtwo">>>>予約はコチラから<<< </h3>
            <ul style="text-align:left">
              <?php
              if (!$row) {
                echo '<li><a href="res_now.php">今からご来店のご予約</a></li>';
                echo '<li><a href="res_dtime.php">日付時間指定のご予約</a></li>';
                //<!-- <li><a href="res3.php">Quick予約</a></li> -->
              } else {
                //   echo '<li><u>今からご来店のご予約</u>';
                //   echo '<li><u>日付時間指定のご予約</u>';
                // }
                // if ($row) {
                echo '<li><a href="clear.php">予約キャンセル</a></li>';
              }
              ?>
            </ul>

            <div>予約が既に存在する場合は、キャンセルするまで新たな予約を行えません。</div>
      </div>
      <div style="text-align:center"><button onclick="location.href='./login.html'">TOPに戻る</div>
</body>

</html>