<!DOCTYPE html>
<html lang="ja">
<?php 
session_start();
echo $_COOKIE['PHPSESSID']."<br>"; 
?>
    <head>
        <title>FAMIs</title>
        <link rel = "stylesheet" href="login.css">
        <meta http-equiv="Content-TYPE" content="text/html; charset=UTF-8">    
        <meta name="viewport" content="width=device-width">
    </head>
    <body>
        
        予約が完了いたしました。<br>
        <h2>注文内容</h2><br>
        <?php
        echo date('Y-m-d')." ";//現在日付 2020-06-22
        echo date('H:i')."<br/>\n";//現在時間 12:55:41
?>
        予約番号
        <button onclick="location.href='./top.php'">TOPに戻る
    </body>
</html>