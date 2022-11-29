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
        .box select {
            /* border:1px solid; */
            font-size: 20px;
            width: 16em;
            background-color: white;
        }
    </style>
    <div style="margin-top:30px"></div>
    <h1>FAMIs予約サイト</h1>
    <hr>
    「日付時間指定のご予約」を行います。<br>
    すぐにご来店（二時間以内にお店にご到着予定のお客様）は、<a href="res1.php">「今からご来店のご予約」</a>からご予約ください。
    <h2>今からご来店のご予約</h2>
    ・人数を選択してください<br>
    <form action="resi2.php" method="post">
        <!-- <input type="text" list="list" size="20px" style="text-align:right" readonly>
            <datalist id="list"> -->
        <div class="">

        </div>
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
        </div>
        <a> --19名以上の人数のご予約はお店に直接ご予約ください。<br>
            --テーブルを複数ご利用される場合は
        </a><br>
        <select name="reserve_day">
        <?php
            
            for ($i = 0; $i < 7; $i++) :
                $this_day = date("n月j日", mktime(0, 0, 0, $month, $day + $i, $year));
            
            echo '<option value="'.$this_day.'">'.$this_day.'</option>';
            endfor; ?>
            <div>
                <label for="time-date">予約希望時刻</label>
                <input type="time" name="reserve_time" min="7:00" max="23:00" required/>
            </div>
        </select>

        <!-- <div class="container">
            <div class="row">
                <div class='col-sm-6'>
                    <div class="form-group">
                        <div class='input-group date' id='datetimepicker1'>
                            <input type='text' class="form-control" />
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>
                </div>
                <script type="text/javascript">
                $(function () {
                $('#datetimepicker1').datetimepicker();
                });
                </script>
            </div>
        </div> -->

        <!-- </datalist>名<br> 
            <input type="reset" class="botm" value="リセット"> -->
            <br>
        <input type="submit" class="botm" value="登録する">
    </form>
</body>

</html>