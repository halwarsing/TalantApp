<?php
$mysqli = mysqli_connect("localhost","u1065577_halol", "bikfut31", "u1065577_hal");
$pas = $_POST["passw"];
$log = $_POST["login"];
$auth = mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT * FROM users WHERE passw='".$pas."' AND login='".$log."' OR passw='".$pas."' AND email='".$log."'"));
if ($auth == "") {
    $out = "yes";
} else {
    $out = "no";
}
echo $out;
?>