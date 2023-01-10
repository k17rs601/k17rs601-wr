<!DOCTYPE html>
<link rel="stylesheet" href="receptionist.css">
<html lang="ja">

<head>
    <link rel="stylesheet" href="register.css">
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="refresh" content="60; URL=guide.php">
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
        margin-right: 3%;
        text-align: center;
        font-size: 300%;
        float: right;
        width: 30%;
        height: 15%;
    }

    a#text {
        width: 25%;
        height: 50px;
    }

    .column {
        margin-top: 10px;
        text-align: center;
        font-size: 50%;
        width: 100%;
        height: 100%;
    }

    #btn {
        width: 30%;
        padding-top: 1%;
        font-size: 250%;
        text-align: center;
    }

    #btn2 {
        width: 30%;
        padding-top: 1%;
        font-size: 150%;
        text-align: center;
    }
</style>

<?php
$con = new mysqli("localhost", "root", "", "FARVAS");
$con->set_charset('utf8');
?>

<body>
    <div class="select">
        <a>座席番号</a>
        <form action="guide_check.php" name="zaseki" method="post">
            <div class="table_select">
                <select class="select1" type="text" name="zaseki_number" maxlength="2" readonly>
                    <?php
                    $sql = "SELECT zaseki_number FROM tel_zaseki WHERE zaseki_state = 1";
                    $rs = $con->query($sql);
                    $row = $rs->fetch_assoc();
                    while ($row) {
                        echo '<option value="1">' . $row["zaseki_number"] . '</option>';
                        $row = $rs->fetch_assoc();
                    }
                    ?>
                </select>
            </div>
            <div class="column">
                <input type="submit" class="botm" value="登録する">
            </div>
        </form>

    </div>
    <a id="title">退席処理を行う座席を選択してください。</a>
    <div class="image">
        <img src="zaseki_staff.png" width="60%">
    </div>
</body>