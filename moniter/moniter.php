<!DOCTYPE html>
<link rel="stylesheet" href="receptionist.css">
<html lang="ja">

<head>
    <title>FARVAR受付サイト</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <meta name="viewport" content="initial-scale=1.0">
    <!-- iOS/Safari用 -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <!-- Android/Chrome用 -->
    <meta name="mobile-web-app-capable" content="yes">
    <meta http-equiv="refresh" content="60; URL=">
    <!-- ５秒ごとに更新 -->
</head>

<style>
    body {
        overflow: hidden;
        background: lightgoldenrodyellow;
        width: 100%;
        height: 100%;
        aspect-ratio: 16/9;
    }

    * {
        margin: 0;
        padding: 0;
    }

    h1 {
        font-size: 1500%;
        text-align: center;
        padding-top: -5%;
        padding-bottom: -5%;
        border: 3px solid black;
    }

    .num {
        border: 5px inset black;
    }

    h3 {
        font-size: 1000%;
    }

    h2 {
        margin-top: 1%;
        font-size: 250%;
        text-align: center;
    }

    h4 {
        font-size: 750%;
        text-align: center;
    }
</style>

<?php
$con = new mysqli("localhost", "root", "", "FARVAS");
$sql = "SELECT guide_number FROM `tel_zaseki` WHERE zaseki_state = 1 ORDER BY guide_datetime DESC, guide_number DESC";
$rs = $con->query($sql);
if ($rs) {
    $row = $rs->fetch_assoc();
}

if ($row) {
    $sql1 = "SELECT zaseki_number FROM `tel_zaseki` WHERE zaseki_state = 1 AND guide_number = " . $row['guide_number'];
    $rs1 = $con->query($sql1);
    $row1 = $rs1->fetch_assoc();
}
?>

<body>
    <h2>案内番号</h2>
    <?php
    if (!$row) {
        echo "<h3>案内はございません。<h3>";
    } else {
        echo "<h1><div class='num'>" . $row['guide_number'] . "</div></h1>";
        echo "<h2>座席表を確認しながら下記の座席の番号に移動してください。<h2><h4>";
        while ($row1) {
            echo $row1['zaseki_number'];
            $row1 = $rs1->fetch_assoc();
            if ($row1) {
                echo "　　";
            }
        }
        echo "</h4>";
    }

    ?>

</body>