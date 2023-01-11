<?php
session_start();

?>

<!DOCTYPE html>
<link rel="stylesheet" href="res.css">
<link rel="stylesheet" href="list.css">
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title></title>
</head>

<body>
    <?php
    date_default_timezone_set('Asia/Tokyo');
    $date = time();
    $year = date("Y");
    $month = date("n");
    $day = date("j");
    ?>
    <style>
        .box {
            text-align: center;
        }

        .box select {
            /* border:1px solid; */
            padding-left: 5px;
            font-size: 20px;
            width: 18em;
            background-color: white;
            text-align: center;
        }

        #mintext {
            font-size: 80%;
        }

        .timetext {
            font-size: 20px;
            width: 18em;
            background-color: white;
            text-align: center;
        }

        .box#selecttext {
            font-size: 16px;
        }

        .botm {
            padding: 2px;
            width: 9em;
            font-size: 16px;
            border: 3px inset black;
        }

        .button {
            margin-top: 5%;
            text-align: center;
        }
    </style>
    <div style="margin-top:30px"></div>
    <h1>FARVAS予約サイト</h1>
    <hr>
    「日付時間指定のご予約」を行います。<br>
    すぐにご来店（２時間以内にお店にご到着予定のお客様）は、<a href="res_now.php">「今からご来店のご予約」</a>からご予約ください。
    <h2>今からご来店のご予約</h2>
    <h3>ご利用人数</h3>
    <form action="res_dtime2.php" method="post">
        <!-- <input type="text" list="list" size="20px" style="text-align:right" readonly>
            <datalist id="list"> -->

        <div class="box">
            <select class="select1" name="howp" required>
                <option value="" id="selecttext">--人数を選択してください--</option>
                <optgroup label="テーブル１席">
                    <option value="1">１名</option>
                    <option value="2">２名</option>
                    <option value="3">３名</option>
                    <option value="4">４名</option>
                    <option value="5">５名</option>
                    <option value="6">６名</option>
                </optgroup>
                <optgroup label="テーブル２席">
                    <option value="7">７名</option>
                    <option value="8">８名</option>
                    <option value="9">９名</option>
                    <option value="10">１０名</option>
                    <option value="11">１１名</option>
                    <option value="12">１２名</option>
                </optgroup>
                <optgroup label="テーブル３席">
                    <option value="13">１３〜１８名</option>
                </optgroup>
            </select>
            <br>
            <a id="mintext"> ※19名以上の人数のご予約はお店に直接ご予約ください。</a>
        </div>
        <h3>ご来店予定の日にち</h3>

        <div class="box">
            <select name="reserve_day">
                <?php
                for ($i = 0; $i < 7; $i++) :
                    $this_day = date("Y-n-j", mktime(0, 0, 0, $month, $day + $i, $year));

                    echo '<option value="' . $this_day . '">' . $this_day = date("Y年n月j日 ", mktime(0, 0, 0, $month, $day + $i, $year)) . '</option>';
                endfor; ?>
            </select>
        </div>

        <h3>ご来店予定時間</h3>
        <div class="box">
            <input type="time" class="timetext" name="reserve_time" min="07:00:00" max="23:00:00" required />
        </div>


        <div class="button">
            <input type="submit" class="botm" value="登録する">
        </div>
    </form>
</body>

</html>