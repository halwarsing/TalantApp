<?php
$mysqli = mysqli_connect("localhost","u1065577_halol","bikfut31","u1065577_hal");
echo "UPDATE users SET tag='{$_POST['tag']}' WHERE login='{$_COOKIE['login']}'";
$sql = mysqli_query($mysqli, "UPDATE users SET tag = '{$_POST['tag']}' WHERE login='{$_COOKIE['login']}'");
?>