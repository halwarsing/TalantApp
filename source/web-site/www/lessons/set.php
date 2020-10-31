<?php
$mysqli = mysqli_connect("localhost", "u1065577_halol", "bikfut31", "u1065577_hal");
$info = mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT * FROM users WHERE login='".$_COOKIE["login"]."'"));
$new = (int) $info["lev"] + 1;
$sql = mysqli_query($mysqli, "UPDATE users SET lev='$new' WHERE login='".$_COOKIE["login"]."'");
?>