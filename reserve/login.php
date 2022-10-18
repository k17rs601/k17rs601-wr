<!DOCTYPE html>
<html><head>
    <meta http-equiv="Content-TYPE" content="text/html; charset=UTF-8">    
    <meta name="viewport" content="width=device-width">
    <link rel = "stylesheet" href="listyle.css">
    <link rel = "stylesheet" href="login.css">
</head>
    <body>
    <?php
        $uid = $_POST['uid'];
        $pass = $_POST['pass'];
        $sql1 = "SELECT emael , upass FROM tbl_user WHERE email ='{$uid}' AND upass='{$pass}'";

        $conn = new mysqli("localhost","root","","FAMIs");//MySQLサーバへ接続
        if($conn->connect_errno){
            die($conn->connect_error);
        }
        $conn->set_charset('utf8');

        $rs = $conn->query("SELECT uid , upass FROM tbl_user WHERE uid ='{$uid}' AND upass ='{$pass}'");
        if (!$rs) die('エラー: ' . $conn->error);

        $row= $rs->fetch_assoc();//問合せ結果を1行受け取る

        if(!$row){
            echo '<h2 style ="text-align:center;">ログイン失敗</h2><h4>ユーザーIDまたはパスワードが間違っています。再度入力してください。</h4>';
             exit('<a href="login.html">戻る</a>');
        }
        ?>
    <h1 style="text-align:center">FAMIs予約サイト</h1>
        <h3>現在の順番の待ち組数</h3>
    <div style="font-size:20px; text-align:center">
      <input id="rescount" type="text" name="rescount" value="" class="txt1" readonly>組
    </div>
    <h3>お客様のご予約番号</h3
    <h3>予約はコチラから</h3>
    
  <ul>
    <li><a href="res1.html">今からご来店のご予約</a></li>
    <li><a href="res2.html">日付時間指定のご予約</a></li>
    <li><a href=".php">Quick予約</a></li>
    <li><button onclick="location.href='./login.html'">予約キャンセル</li>
  </ul>
        

    </body>

</html>