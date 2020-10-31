<?php
$icon = $_POST["icon"];
$youtube = $_POST["youtube"];
$vk = $_POST["vk"];
$instagram = $_POST["instagram"];
$mysqli = mysqli_connect("localhost","u1065577_halol","bikfut31","u1065577_hal");
$sql = mysqli_query($mysqli, "UPDATE users SET icon='$icon', youtube='$youtube', vk='$vk', instagram='$instagram' WHERE login='{$_COOKIE['login']}'");
?>