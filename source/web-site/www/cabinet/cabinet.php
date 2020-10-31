<!DOCTYPE html>
<html>
    <head>
        <title>MAIN</title>
        <meta charset="utf-8">
        <script src='https://code.jquery.com/jquery-3.5.1.min.js'></script>
    </head>
    <body>
        
<?php 
if ($_COOKIE["login"] == "") {
    echo "<a href='login/'>Авторизируйтесь</a>";
} else {
    $mysqli = mysqli_connect("localhost","u1065577_halol","bikfut31","u1065577_hal");
    mysqli_set_charset($mysqli, "utf8");
    $info = mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT * FROM users WHERE id='".$_GET["user"]."'"));
    if ($info != "") {
        $main = '"/"';
        $cabinet = '"/cabinet"';
        $create = '"/lessons/add"';
        $img = $info['icon'];
        if (!@GetImageSize($img)) {
            $img = "/img/none.jpg";   
        }
        $login = $info["login"]; 
        $ch = '"chat/?user='.$login.'"';
        echo "<div id='navigation'><div id='main' onclick='document.location.href=$main'>Главная</div><div id='cabinet' onclick='document.location.href=$cabinet'>Кабинет</div><div id='create' onclick='document.location.href=$create'>Создать</div></div>
        <div id='information'>
            <div id='name'>Это личный кабинет пользователя {$info['name']} {$info['sname']} {$info['mname']}.</div>
            <img src='$img' id='icon' style='width: 343px; height: 343px;'>
            <input type='submit' onclick='document.location.href = $ch;' id='chatbtn' value='Чат'>
            <div id='social'>
                <a id='youtube' href='{$info['youtube']}' target='_blank'>Ссылка на YouTube</a>
                <a id='vk' href='{$info['vk']}' target='_blank'>Ссылка на VK</a>
                <a id='instagram' href='{$info['instagram']}' target='_blank'>Ссылка на Instagram</a>
            </div>
        </div>";
    } else {
        echo "<a href='/'>Такого пользователя не существует <h1 id='hk'>:(</h1></a>";
    }
}
?>
        <script>
        function save() {
            var dat = {
                icon: document.getElementById("icon").value,
                twitch: document.getElementById("twitch").value,
                vk: document.getElementById("vk").value,
                instagram: document.getElementById("instagram").value
            }
            $.post("save.php", dat, function(data) {
                document.getElementById("res").textContent = "Данные успешно сохранены. Через 5 секунд надпись исчезнет.";
                document.getElementById("res").style.color = "#00ff09";
                setTimeout(function() {
                    document.getElementById("res").textContent = "";
                }, 5000);
                console.log(data);
            });
        }
        </script>
        <style>
            #name {
                width: 343px;
                word-wrap: break-word;
            }
            
            #hk {
                font-size: 343px;
            }
            
            #main {
                width: 85.75px;
                height: 30px;
                background-color: #5646bd;
                border: 1px solid;
                outline: none;
                font-size: 20px;
                text-align: center;
                padding-top: 5px;
                display: inline-block;
            }
            
            #cabinet {
                width: 85.75px;
                height: 30px;
                background-color: #5646bd;
                border: 1px solid;
                outline: none;
                font-size: 20px;
                text-align: center;
                padding-top: 5px;
                display: inline-block;
                margin-left: 0.5px;
            }
            
            #chat {
                width: 85.75px;
                height: 30px;
                background-color: #5646bd;
                border: 1px solid;
                outline: none;
                font-size: 20px;
                text-align: center;
                padding-top: 5px;
                display: inline-block;
                margin-left: 0.5px;
            }
            
            #create {
                width: 85.75px;
                height: 30px;
                background-color: #5646bd;
                border: 1px solid;
                outline: none;
                font-size: 20px;
                text-align: center;
                padding-top: 5px;
                display: inline-block;
                margin-left: 0.5px;
            }
        </style>
    </body>
</html>