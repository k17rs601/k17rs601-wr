<?php

class User
{
    public $name;       // 名前
    public $age;        // 年齢
    public $haveFever;  // 健康状態(true:悪い、false:良好)

    function __construct(string $name, int $age, bool $haveFever)
    {
        // アロー演算子を使ってプロパティにアクセス
        $this->name = $name;
        $this->age = $age;
        $this->haveFever = $haveFever;
    }
}

$sample_user = new User("Sato Takashi", 25, false);

echo "名前:" . $sample_user->name . "<br />";
echo "年齢:" . $sample_user->age . "<br />";

echo "健康状態:";

if ($sample_user->haveFever) {
    echo "体調不良<br />";
} else {
    echo "良好<br />";
}
$get_event_time_start = 10;
$get_event_time_end = 16;

echo "<select name=\"ご希望時間\">";
for ($i = $get_event_time_start * 2; $i <= $get_event_time_end * 2; $i++) {
    echo "<option>" . date("H時i分", strtotime("00:00 +" . $i * 30 . " minute"));
}
echo "</select>";
?>
<br>


時刻選択練習
<?php
$date = time(); ?>
<?php ?>
<?php ?>
<br>
<input type="datetime-local" value="<?php echo $date ?>" min="$date">