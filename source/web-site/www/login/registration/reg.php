<?php
$login = $_POST["login"];
$passw = $_POST["passw"];
$email = $_POST["email"];
$level = $_POST["level"];
$name = $_POST["name"];
$sname = $_POST["sname"];
$mname = $_POST["mname"];
$code = $_POST["code"];
$mysqli = mysqli_connect("localhost","u1065577_halol","bikfut31","u1065577_hal");
mysqli_set_charset($mysqli, "utf8");
mysqli_query($mysqli,"UPDATE users SET login='$login', passw='$passw', email='$email', level='$level', name='$name', sname='$sname', mname='$mname' WHERE code='$code'");
?>