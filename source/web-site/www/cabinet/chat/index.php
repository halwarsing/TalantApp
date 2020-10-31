<!DOCTYPE html>
<html>    
    <head>
        <title>CHAT</title>
        <script src='https://code.jquery.com/jquery-3.5.1.min.js'></script>
    </head>
    <body>
<?php
$mysqli = mysqli_connect("localhost","u1065577_halol","bikfut31","u1065577_hal");
$chat = mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT * FROM chat WHERE t='{$_COOKIE['login']}' AND f='{$_GET['user']}' OR f='{$_COOKIE['login']}' AND t='{$_GET['user']}'"));
if ($chat != "") {
    $chatall = explode("Ё", file_get_contents("info/".$chat["name"]));
    echo "<div id='chat'>";
    unset($chatall[count($chatall) - 1]);
    for ($i = 0; $i < count($chatall); $i++) {
        $c = explode("ё", $chatall[$i]);
        echo "<div id='msg'><p id='textmsg'>{$c[0]}</p><p id='date'>{$c[1]}</p><b id='from'>{$c[2]}</b></div>";
    }
    echo "</div>";
    echo "<script>name = '{$chat['name']}';</script>";
    echo "<textarea id='msginp'></textarea><input type='submit' onclick='send();' id='sendbtn' value='Отправить'>";
} else {
    $name = $_COOKIE['login'].date("Y.m.d-H:i:s");
    $new = mysqli_query($mysqli,"INSERT INTO chat (name,f,t) VALUES ('$name','{$_COOKIE['login']}','{$_GET['user']}')");
    file_put_contents("info/".$name, "Создан новый чатё".date("Y.m.d-H:i:s")."ё".$_COOKIE["login"])."Ё";
    header("Location: /cabinet/chat/?user=".$_GET["user"]);
    exit();
}
?>
        <script>
        function scroll() {
            document.getElementById("chat").scrollTop = document.getElementById("chat").scrollHeight;
        }
        scroll();
        function send() {
            var dat = {
                name: name,
                msg: document.getElementById("msginp").value
            }
            $.post("send.php",dat,function(data) {
                console.log(data);
            });
        }
        setInterval(function() {
            var dat = {
                name: name
            };
            $.post("get.php",dat,function(data) {
                document.getElementById("chat").innerHTML = data;
            });
        }, 100);
        </script>
        <style>
            #chat {
                max-width: 343px;
                max-height: 343px;
                overflow-y: auto;
            }
        </style>
    </body>
</html>