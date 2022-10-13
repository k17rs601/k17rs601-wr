<!DOCTYPE html>
<html><head>
    <meta http-equiv="Content-TYPE" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width">
    </head>
    <body>
    <?php
        $uid = $_POST['uid'];
        $pass = $_POST['pass'];
        $sql = "SELECT * FROM tbl_user WHERE uid='{$uid}' AND upass='{$pass}'";

        $conn = new mysqli("localhost","root","","FAMIs");//MySQLサーバへ接続
        if($conn->connect_errno){
            die($conn->connect_error);
        }
        $conn->set_charset('utf8');

        $rs = $conn->query($sql);//SQL文をサーバーに送信し実行
        if (!$rs) die('エラー: ' . $conn->error);

        $row= $rs->fetch_assoc();//問合せ結果を1行受け取る

        if($row){
            header('Location:start.php');
        }else{
             echo '<h2>ログイン失敗</h2><h4>ユーザーIDまたはパスワードが間違っています。再度入力してください。</h4>';
             echo '<a href="login.html">戻る</a>';
        }
    ?>
    </body>
</html>