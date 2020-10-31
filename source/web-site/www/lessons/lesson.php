<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
    	<title></title>
    	<script src='https://code.jquery.com/jquery-3.5.1.min.js'></script>
    </head>
    <body>
<?php
$name = $_GET["id"];
$page = $_GET["page"];
if (file_exists("add/info/".$name.".txt")) {
    $f = file_get_contents("add/info/".$name.".txt");
    $f = explode("Ё", $f);
    $i = 0;
    $mp = ((int) count($f)) - 1;
    echo "<script>mp = '".$mp."';</script>";
    while ($i < count($f) - 1) {
        $l = explode("ё", $f[$i]);
        if ($l[2] == $page) {
            echo "<script>type = '".$l[0]."';</script>";
            if ($l[0] == "page") {
                echo "<div id='page'>".$l[1]."</div>";
            }
            
            if ($l[0] == "q&a") {
                $s = explode("0110",$l[1]);
                echo "<div><h1>".$s[0]."</h1 id='question'><select size='1' id='ansonque'><option value='".$s[1]."'>".$s[1]."</option><option value='".$s[2]."'>".$s[2]."</option><option value='".$s[3]."'>".$s[3]."</option><option value='".$s[4]."'>".$s[4]."</option></select><input type='hidden' id='answer' value='".$s[5]."'><input type='submit' onclick='check()' id='chsub' value='Ответить'><p id='res'></p></div><script>var answe = document.getElementById('answer'); answer = answe.value; answe.remove();</script>";
            }
        }
        $i++;
    }
} else {
    echo "<h1>Такого урока не существует :(</h1>";
}
?>
        <div id='navigation'>
            <input type='submit' value='назад' id='back' onclick="back();" disabled="true">
            <input type='submit' value='вперёд' id='next' onclick="next();" disabled="true">
        </div>
        <script>
            function $_GET(key) {
                var p = window.location.search;
                p = p.match(new RegExp(key + '=([^&=]+)'));
                return p ? p[1] : false;
            }
            
            function back() {
                document.location.href = "lesson.php?page=" + (Number($_GET("page")) - 1) + "&id=" + $_GET("id");
            }
            
            function next() {
                if ($_GET("page") != mp) {
                    document.location.href = "lesson.php?page=" + (Number($_GET("page")) + 1) + "&id=" + $_GET("id");
                } else if($_GET("page") == mp) {
                    document.location.href = "/";
                }
            }
            
            function check() {
                if (type == "q&a") {
                    var sel = document.getElementById("ansonque").options.selectedIndex;
                    if (document.getElementById("ansonque").options[sel].value == answer) {
                        document.getElementById("res").textContent = "Ответ правильный! Можете продолжать дальше.";
                        document.getElementById("res").style.color = "#00ff09";
                        if ($_GET("page") != mp) {
                            document.getElementById("next").disabled = false;
                        } else {
                            document.getElementById("res").textContent = "На этом урок окончен. Через 5 секунд автоматически выйдет.";
                            document.getElementById("res").style.color = "#00ff09";
                            $.get("set.php");
                            setTimeout(function() {document.location.href = "/";}, 5000);
                        }
                    } else {
                        document.getElementById("res").textContent = "Неправильно! попробуйте снова.";
                        document.getElementById("res").style.color = "#f00";
                    }
                }
            }
            if (type == "page") {
                if ($_GET("page") != mp) {
                    document.getElementById("next").disabled = false;
                }
                if ($_GET("page") == mp) {
                    document.getElementById("next").disabled = false;
                    document.getElementById("next").value = "Закончить";
                }
            }
            if (Number($_GET("page")) != 1) {
                document.getElementById("back").disabled = false;
            }
        </script>
        <style>
            #question {
                width: 343px;
                word-wrap: break-word;
            }
        
            #page {
                width: 343px;
                word-wrap: break-word;
            }
        
            #navigation {
                width: 343px;
            }
        
            #back {
                width: 160px;
                height: 30px;
                background-color: #5646bd;
                border: 1px solid;
            }
            #next {
                width: 160px;
                height: 30px;
                background-color: #5646bd;
                border: 1px solid;
                margin-left: 19px;
            }
            
            #ansonque {
                width: 343px;
                height: 50px;
                background-color: #5646bd;
                border: 1px solid;
            }
            
            #chsub {
                width: 343px;
                height: 50px;
                background-color: #5646bd;
                border: 1px solid;
            }
            #res {
                color: #f00;
                text-align: center;
            }
        </style>
    </body>
</html>