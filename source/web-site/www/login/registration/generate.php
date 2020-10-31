<?php
$mysqli = mysqli_connect("localhost","u1065577_halol","bikfut31","u1065577_hal");
$level = mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT * FROM users WHERE login='{$_COOKIE['login']}'"));
if ($level["level"] == "teacher") {
    function gen($length) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    $code = gen(100);
    $s = mysqli_fetch_assoc(mysqli_query($mysqli,"SELECT * FROM users WHERE code='$code'"));
    if ($s == "") {
        $ge = mysqli_query($mysqli,"INSERT INTO users (code) VALUES ('$code')");
        echo "Url for registration: https://peopletok.ru/login/registration/?code=".$code."&level=student or Enter code: ".$code;
    } else {
        header("Location: generate.php");
        exit();
    }
} else {
    header("Location: /");
    exit();
}
?>