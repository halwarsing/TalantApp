<?php
if ($_GET["page"] != "6") {
    if (isset($_POST["level"])) {
        $_COOKIE["level"] = $_POST["level"];
    } else {
        setcookie("level", "0", time() + (3600 * 10), "peopletok.ru");
    }
} else {
    $mysqli = mysqli_connect("localhost","u1065577_halol","bikfut31","u1065577_hal");
    $sql = mysqli_query($mysqli, "UPDATE users SET lev = '{$_POST['level']}' WHERE login='".$_COOKIE['login']."'");
    echo "UPDATE users SET lev = {$_POST['level']} WHERE login='".$_COOKIE['login']."'";
    echo "<script>document.location.href = '/';</script>";
}
?>
<html>
    <head>
        <title>TEST</title>
        <script src='https://code.jquery.com/jquery-3.5.1.min.js'></script>
        <meta charset="utf-8">
    </head>
    <body>
<?php
$test = $_POST["test"];
$info = explode("ё",explode("Ё", file_get_contents("tests/".$test.".txt"))[((int) $_GET["page"]) - 1]);
$question = str_replace("\n", "<br>", $info[0]);
$answer = $info[3];
$type = $info[2];
if ($type == "var") {
    $var = explode("^",$info[1]);
    echo "<h1>$question</h1>";
    echo "<form method='POST' id='f' action='test.php?page=".((int) $_GET['page'] + 1)."'><input type='hidden' value='$test' name='test'><input type='hidden' value='' id='level' name='level'>";
    for ($i = 0; $i < 4; $i++) {
        echo "<p><input name='var' id='var' type='radio' value='".$var[$i]."' onclick='check(this);'>{$var[$i]}</p>";
    }
    echo "</form>";
    echo "<script>a = '$answer'; level = '{$_COOKIE['level']}';</script>";
}
?>
        <script>
        function check(el) {
            if (el.value == a) {
                document.getElementById("level").value = Number(level) + 1;
                document.getElementById("f").submit();
            } else {
                document.getElementById("level").value = Number(level);
                document.getElementById("f").submit();
            }
        }
        </script>
    </body>
</html>
