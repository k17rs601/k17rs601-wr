<!DOCTYPE html>
<link rel="stylesheet" href="receptionist.css">
<html lang="ja">

<head>
    <link rel="stylesheet" href="register.css">
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="refresh" content="60; URL=staff.php">
    <title>座席選択</title>
</head>

<script type="text/javascript">
    //////////
    function add(str) {
        document.zaseki.zaseki_number.value += str;
    }
</script>

<style>
    * {
        margin: 0;
        padding: 0;
    }

    img {
        margin-left: 1%;
        border: 1px double black;
        padding: 1%;
        background-color: white;
    }

    a#title {
        margin: 10px;
        font-size: 200%;
        margin-left: 0px;
        margin-right: 0px;
        padding-left: 10px;
        padding-top: 2%;
    }

    div.select {
        margin-top: 1%;
        margin-right: 10%;
        text-align: center;
        font-size: 300%;
        float: right;
        width: 30%;
        height: 15%;
    }


    .column {
        float: right;
        width: 40%;
    }

    .table_select {
        float: right;
        width: 40%;
    }

    .decide {
        font-size: 80%;
        width: 80%;
    }

    .select1 {
        font-size: 80%;
        width: 80%;
    }
</style>

<?php
$con = new mysqli("localhost", "root", "", "FARVAS");
$con->set_charset('utf8');
?>

<body>
    <div class="select">
        <form action="guide_check.php" name="zaseki" method="post">
            <?php

            $sql = "SELECT zaseki_number FROM tel_zaseki WHERE zaseki_state = 1";
            $rs = $con->query($sql);
            $row = $rs->fetch_assoc();
            if ($row) {
                echo '<div class="column"><input type="submit" class="decide" value="退席"></div>';
                echo '<div class="table_select">';
                echo '<select class="select1" type="text" name="zaseki_number" maxlength="15" readonly>';
                while ($row) {
                    echo '<option value="' . $row["zaseki_number"] . '">' . $row["zaseki_number"] . '</option>';
                    $row = $rs->fetch_assoc();
                }
                echo '</select></div>';
            } else {
                echo '</select></div>';
            }
            ?>
        </form>

    </div>
    <a id="title">退席処理を行う座席を選択してください。</a>
    <div class="image">
        <img src="zaseki_staff.png" width="60%">
    </div>
</body>