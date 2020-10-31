<!DOCTYPE html>
<html>
    <head>
        <title>MAIN</title>
        <meta charset="utf-8">
        <script src='https://code.jquery.com/jquery-3.5.1.min.js'></script>
        <meta charset="utf-8">
    </head>
    <body>
        
<?php 
if ($_COOKIE["login"] == "") {
    echo "<a href='login/'>Авторизируйтесь</a>";
} else {
    $mysqli = mysqli_connect("localhost","u1065577_halol","bikfut31","u1065577_hal");
    mysqli_set_charset($mysqli, "utf8");
    $sqlles = mysqli_query($mysqli, "SELECT * FROM lessons");
    $main = '"/"';
    $cabinet = '"/cabinet"';
    $create = '"/lessons/add"';
    echo "<div id='navigation'><div id='main' onclick='document.location.href=$main'>Главная</div><div id='cabinet' onclick='document.location.href=$cabinet'>Кабинет</div><div id='create' onclick='document.location.href=$create'>Создать</div></div>";
    echo "<select size='1' id='type' onchange='sort(this);'><option value='constest'>Конкурсы</option><option value='lesson'>Занятия</option><option value='webinar'>Вебинары</option><option value='profile'>Люди</option></select>
    <select size='1' id='subtag' onchange='sort(this);'>
        <option value='All'>All</option>
        <option value='python'>python</option>
    </select>
    <input type='submit' value='Обновить' onclick='sort();' id='refsub'>";
    echo "<div id='information'>";
    $info = mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT * FROM users WHERE login='".$_COOKIE["login"]."'"));
    $sqlles = mysqli_query($mysqli, "SELECT * FROM lessons WHERE type='constest' AND subtag='".$info["tag"]."'");
    $arr = array();
    while ($arrles = mysqli_fetch_array($sqlles)) {
        if ($arrles["level"] == $info["lev"]) {
            $img = $arrles["img"];
            if (!@GetImageSize($img)) {
                $img = "img/none.jpg";
            }
            $arr[] = "<h1 id='name'>".$arrles["name"]."</h1><img src='".$img."' id='photo'><input class='gobtn' type='submit' value='Перейти' id='".$arrles["idname"]."' onclick='go(this);'><input type='submit' class='showdesc' name='show' id='".$arrles["uid"]."' onclick='showdesc(this)' value='Показать описание'><p id='".$arrles["uid"]."-description' style='visibility: hidden;'>".$arrles["description"]."</p>";
        }
    } 
    $i = count($arr);
    while ($i > -1) {
        echo $arr[$i];
        $i--;
    }
    echo "</div>";
}
?>
        <script>
            function go(el) {
                document.location.href = "lessons/lesson.php?page=1&id=" + el.id;  
            }
            
            function showdesc(el) {
                if (el.name == "show") {
                    document.getElementById(el.id + "-description").style.visibility = "visible";
                    document.getElementById(el.id).value = "Спрятать описание";
                    document.getElementById(el.id).name = "hide";
                    
                } else if (el.name == "hide") {
                    document.getElementById(el.id + "-description").style.visibility = "hidden";
                    document.getElementById(el.id).value = "Показать описание";
                    document.getElementById(el.id).name = "show";
                }
            }
            
            function sort() {
                var dat = {
                    type: document.getElementById("type").value,
                    tag: document.getElementById("subtag").value
                };
                $.post("get.php", dat, function(data) {
                    document.getElementById("information").innerHTML = data; 
                });
            }
            
            function goprf(el) {
                document.location.href = "cabinet/cabinet.php?user=" + el.id;
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
            
            #refsub {
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
                width: 170px;
                height: 30px;
                background-color: #5646bd;
                border: 1px solid;
                display: inline-block;
                outline: none;
            }
            
            #tag {
                width: 170px;
                height: 30px;
                background-color: #5646bd;
                border: 1px solid;
                display: inline-block;
                outline: none;
            }
            
            #subtag {
                width: 170px;
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
            }
        </style>
    </body>
</html>