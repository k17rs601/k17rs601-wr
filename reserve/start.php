<!DOCTYPE HTML>
<html lang ="ja">
  <head>
    <meta charset="UTF-8">
    <link rel = "stylesheet" href="login.css">
    <link rel = "stylesheet" href="listyle.css">
    <h1 style="text-align:center">FAMIs予約サイト</h1>
    <meta name="viewport" content="width=device-width">
  </head>

  <body>
    <?php
    $con = mysqli_connect('localhost','root','','FAMIs');

    $rezu = mysqli_query($con,"FAMIs");
    ?>
    <h3>現在の順番の待ち組数</h3>
    <div style="font-size:20px; text-align:center">
      <input id="rescount" type="text" name="rescount" value="" class="txt1" readonly>組
    </div>
    <h3>お客様のご予約番号</h3
    <h3>予約はコチラから</h3>
    
  </body>
  <ul>
    <li><a href="nxetsv.php">今からご来店のご予約</a></li>
    <li><a href=".php">日付時間指定のご予約</a></li>
    <li><a href=".php">Quick予約</a></li>
    <li><button onclick="location.href='./login.html'">予約キャンセル</li>
  </ul>
  
</html>