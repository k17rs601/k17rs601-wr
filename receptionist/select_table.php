<!DOCTYPE html>
<link rel="stylesheet" href="receptionist.css">
<html lang="ja">

<head>
    <link rel="stylesheet" href="register.css">
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="refresh" content="120; URL=top.php">
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


    input.text {
        width: 70%;
        height: 50px;
        font-size: 50px;
        text-align: right;
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
        margin-top: 40px;
        margin-right: 3%;
        text-align: center;
        font-size: 300%;
        float: right;
        width: 30%;
        height: 15%;
    }

    .column {
        margin-top: 50%;
        text-align: center;
        width: 100%;
        height: 100%;
    }

    .table_select {
        font-size: 100%;
    }

    .submit_button {
        font-size: 100%;
    }

    .select1 {
        font-size: 75%;
        width: 30%;
        text-align: center;
        border: 3px outset black;
    }
</style>

<?php
$con = new mysqli("localhost", "root", "", "FARVAS");
$con->set_charset('utf8');
session_start();
$res_number = $_SESSION["res_number"];
$res_table = $_SESSION["res_table"];
?>

<body>
    <div class="select">
        <a id="zaseki">座席番号</a>
        <form action="ok.php" name="zaseki" method="post">
            <select class="select1" type="text" name="zaseki_number" maxlength="2" readonly>

                <?php
                $sql = "SELECT zaseki_number FROM tel_zaseki WHERE zaseki_state = 0";
                $rs = $con->query($sql);
                $row = $rs->fetch_assoc();
                while ($row) {
                    echo '<option value="' . $row["zaseki_number"] . '">' . $row["zaseki_number"] . '</option>';
                    $row = $rs->fetch_assoc();
                }
                ?>

            </select>
            <div class="column">
                <input type="submit" class="submit_button" value="登録する">
            </div>
        </form>

    </div>
    <a id="title">お好きな座席番号を選択してください。</a>
    <div class="image">
        <img src="zaseki_guest.png" width="60%">
    </div>
</body>