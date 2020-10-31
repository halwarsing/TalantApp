<?php
setcookie("login", $_POST["login"], time() + (3600 * 24 * 30 * 12 * 3), "peopletok.ru");
header("Location: talant/");
exit();
?>