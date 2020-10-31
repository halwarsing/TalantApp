<?php
$chatall = explode("Ё", file_get_contents("info/".$_POST["name"]));
unset($chatall[count($chatall) - 1]);
for ($i = 0; $i < count($chatall); $i++) {
    $c = explode("ё", $chatall[$i]);
    echo "<div id='msg'><p id='textmsg'>{$c[0]}</p><p id='date'>{$c[1]}</p><b id='from'>{$c[2]}</b><div>";
}
?>