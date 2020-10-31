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
    $info = mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT * FROM users WHERE login='".$_COOKIE["login"]."'"));
    $main = '"/"';
    $cabinet = '"/cabinet"';
    $create = '"/lessons/add"';
    echo "<div id='navigation'><div id='main' onclick='document.location.href=$main'>Главная</div><div id='cabinet' onclick='document.location.href=$cabinet'>Кабинет</div><div id='create' onclick='document.location.href=$create'>Создать</div></div>
    <div id='information'>
        <div id='name'>Добро пожаловать в личный кабинет {$info['name']} {$info['sname']} {$info['mname']}.</div>
        <p>Ваш id: {$info['id']}</p>
        <input type='text' id='icon' value='{$info['icon']}' placeholder='Ссылка на иконку вашего профиля' style='width: 343px;'>
        <div id='social'>
            <input type='text' value='{$info['youtube']}' id='youtube' placeholder='Ссылка на YouTube'>
            <input type='text' value='{$info['vk']}' id='vk' placeholder='Ссылка на VK'>
            <input type='text' value='{$info['instagram']}' id='instagram' placeholder='Ссылка на Instagram'>
        </div>
        <input type='submit' value='Сохранить данные' id='savebtn' onclick='save();'>
        <p id='res'></p>
    </div>";
}
?>
        <script>
        function save() {
            var dat = {
                icon: document.getElementById("icon").value,
                youtube: document.getElementById("youtube").value,
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
            
            #photo {
                width: 343px;
                height: 343px;
            }
            
            .gobtn {
                width: 171.5px;
                height: 30px;
                background-color: #5646bd;
                border: 1px solid;
            }
            
            .showdesc {
                width: 171.5px;
                height: 30px;
                background-color: #5646bd;
                border: 1px solid;
            }
            
            .gobtn:hover {
                background-color: #18078a;
            }
            
            .showdesc:hover {
                background-color: #18078a;
            }
            
            #type {
                width: 171.5px;
                height: 30px;
                background-color: #5646bd;
                border: 1px solid;
                outline: none;
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