<?php
$msg = $_POST["msg"];
$from = $_COOKIE["login"];
$date = date("Y.m.d-H:i:s");
$msga = $msg."ё".$date."ё".$from."Ё";
file_put_contents("info/".$_POST["name"], file_get_contents("info/".$_POST["name"]).$msga);
?>