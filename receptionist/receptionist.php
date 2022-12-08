
<!DOCTYPE html>
<link rel="stylesheet" href="receptionist.css">
<html lang="ja">
<head>
    <link rel="stylesheet" href="register.css">
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>ユーザー登録</title>
</head>

<body>
    <?php
    $recenumber = $_POST["recenumber"];
    echo $recenumber;
    if ($recenumber > 18 ){
        exit ("入力した人数が多過ぎます.
        19名を超える際は店員に申し付け下さい。
        ") ;
    }

    $sql ="SELECT";//最大予約番号を取得する。
    $sql1 ="INSERT";//受付登録を行う。

    ?>

</body>