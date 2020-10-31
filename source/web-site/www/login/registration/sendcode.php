<?php
$mail = $_POST["mail"];
$code = $_POST["code"];
$headers = "Content-type: text/html; charset=windows-1251 \r\n";
$headers .= "From: От кого письмо <halol@peopletok.ru>\r\n";
$headers .= "Reply-To: admin@peopletok.ru\r\n";
$to = "<".$mail.">";
mail($to, "Your code for peopletok!", "<p>Code for end of registration: <strong>".$code."</strong></p>", $headers);
?>