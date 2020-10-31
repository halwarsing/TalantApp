<?php
$info = explode("^", $_POST["info"]);
$infos = explode("ё",$info[0]);
file_put_contents("info/".$_POST["name"].date("H:i:s-d.m.Y").".txt",$info[1]);
$mysqli = mysqli_connect("localhost", "u1065577_halol", "bikfut31", "u1065577_hal");
mysqli_query($mysqli, "INSERT INTO lessons (name, img, description, idname, type, tag, subtag, level) VALUES ('{$_POST['name']}', '{$infos[1]}', '{$infos[2]}', '{$_POST['name']}".date("H:i:s-d.m.Y")."', '{$_POST['type']}', '{$infos[3]}', '{$infos[4]}', {$infos[5]})");
?>