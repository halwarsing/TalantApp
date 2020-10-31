<?php
setcookie("login", $_POST["login"], time() + (3600 * 24 * 31 * 12 * 2), "/", "peopletok.ru");
header("Location: https://peopletok.ru/");
exit();
?>