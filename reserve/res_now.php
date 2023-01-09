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
    「今からご来店のご予約」を行います。<br>
    本日ご来店で現在の時刻より２時間後以降、または後日ご来店のお客様はTOPページの<a href="res_dtime.php">「日付時間指定のご予約」</a>からご予約ください。
    <h2>今からご来店のご予約</h2>
    <h3>・人数を選択してください</h3>

    <form action="res_now2.php" method="post">
        <!-- <input type="text" list="list" size="20px" style="text-align:right" readonly>
            <datalist id="list"> -->
        <div class="box">
            <select class="select1" name="howp" required>
                <option value="">--人数を選択してください--</option>
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
            <a id="mintext"> --19名以上の人数のご予約はお店に直接ご予約ください。</a>
        </div>
        <!-- </datalist>名<br> 
            <input type="reset" class="botm" value="リセット"> -->
        <div class="button">
            <input type="submit" class="botm" value="登録する">
        </div>
    </form>
</body>

</html>