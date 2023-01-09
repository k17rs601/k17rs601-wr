<!DOCTYPE html>
<link rel="stylesheet" href="receptionist.css">
<html lang="ja">

<head>
    <link rel="stylesheet" href="register.css">
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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

<body>
    <div class="select">
        <a>座席番号</a>
        <form action="a.php" name="zaseki" method="post">
            <input type="text" name="zaseki_number" maxlength="16" class="text" readonly>
            <a id="text">番</a>
            <div class="column">
                <div class="col1">
                    <input type="button" value="1" id="btn" onClick="add(this.value)">
                    <input type="button" value="2" id="btn" onClick="add(this.value)">
                    <input type="button" value="3" id="btn" onClick="add(this.value)"><br>
                </div>
                <div class=col2>
                    <input type="button" value="4" id="btn" onClick="add(this.value)">
                    <input type="button" value="5" id="btn" onClick="add(this.value)">
                    <input type="button" value="6" id="btn" onClick="add(this.value)"><br>
                </div>
                <div class="col3">
                    <input type="button" value="7" id="btn" onClick="add(this.value)">
                    <input type="button" value="8" id="btn" onClick="add(this.value)">
                    <input type="button" value="9" id="btn" onClick="add(this.value)"><br>
                </div>
                <div class="col4">
                    <input type="button" value="0" id="btn" onClick="add(this.value)">
                    <input type="reset" value="取消" id="btn2">
                    <input type="submit" value="OK" id="btn2">
                </div>
            </div>
        </form>

    </div>
    <a id="title">お好きな座席を選択してください。</a>
    <div class="image">
        <img src="zaseki_guest.png" width="60%">
    </div>
</body>