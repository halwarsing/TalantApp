<?php
$mysqli = mysqli_connect("localhost","u1065577_halol","bikfut31","u1065577_hal");
$sql = mysqli_fetch_assoc(mysqli_query($mysqli,"SELECT * FROM users WHERE login='".$_POST["login"]."' OR email='".$_POST["mail"]."'"));
echo $sql;
?>