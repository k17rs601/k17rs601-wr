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
  <link rel="stylesheet" href="listyle.css">
</head>

<style>
  h3 {
    text-align: center;
  }

  .rnum {
    text-align: center;
  }
</style>
<h1 style="text-align:center">FAMIs予約サイト</h1>
<?php echo '<h4 style="text-align:right">ようこそ、' . $_SESSION["uname"] . 'さん<h4>' ?>
<h3>現在の順番の待ち組数</h3>
<div style="font-size:20px; text-align:center">
  <input type="text" id="rescount" name="rescount" value="0" class="txt1" style="text-align:right" readonly> 組
</div>
<h3>お客様のご予約番号</h3>
<input type="text" id="rnum" name="rescount" value="" class="txt1" placeholder="現在ご予約がございません。予約を行ってください。" style="text-align:center" readonly>
<h3>予約はコチラから</h3>

<ul style="text-align:left">
  <li><a href="res1.php">今からご来店のご予約</a></li>
  <li><a href="resi1.php">日付時間指定のご予約</a></li>
  <li><a href="res3.php">Quick予約</a></li>
  <li><button onclick="location.href='./login.html'">予約キャンセル</li>
</ul>

</body>

</html>