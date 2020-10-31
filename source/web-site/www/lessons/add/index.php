<?php
$mysqli = mysqli_connect("localhost","u1065577_halol","bikfut31","u1065577_hal");
if (isset($_COOKIE["login"])) {
    $sql = mysqli_query($mysqli,"SELECT * FROM users WHERE login='".$_COOKIE["login"]."'");
    $res = mysqli_fetch_assoc($sql);
    if ($res["level"] == "teacher") {
        echo "<div id='lesson'>
            <select size='1' id='type'><option value='constest'>constest</option><option value='lesson'>lesson</option><option value='webinar'>webinar</option></select>
            <input type='text' id='namelesson' placeholder='Name Lesson'>
            <img src='/img/none.jpg' id='image' style='width: 343px; height: 343px;'>
            <input type='text' id='urlimg' placeholder='Ссылка на картинку' onchange='img();'>
            <input type='text' id='tag' placeholder='Главный тег'>
            <input type='text' id='subtag' placeholder='Под тег'>
            <input type='text' id='level' placeholder='Уровень сложности'>
            <textarea id='desc' placeholder='Описание урока'></textarea>
            <div id='dpages'>
                <textarea maxlength='5000' rows='50' cols='100' id='page' placeholder='Обычная страница'></textarea>
            </div>
            <input type='submit' onclick='addpage();' value='Добавить страницу'>
            <input type='text' id='typetask'>
            <input type='submit' onclick='addtask();' value='Добавить задачу'>
            <input type='submit' onclick='publish();' value='Опубликовать'>
        </div>";
    } else {
        header("Location: /");
        exit();
    }
} else {
    header("Location: /");
    exit();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>ADD LESSON</title>
	    <script src='https://code.jquery.com/jquery-3.5.1.min.js'></script>
    </head>
    <body>
        <script>
            types = ["q&a", "python"]; 
            dpages = document.getElementById("dpages");
            function addpage() {
                page = document.createElement("textarea");
                page.rows = "50";
                page.cols = "100";
                page.setAttribute("maxlength","5000");
                page.id = "page"
                dpages.appendChild(page);
            }
            
            function addtask() {
                var type = document.getElementById("typetask").value;
                if (types.indexOf(type) != -1) {
                    if (type == "q&a") {
                        var div = document.createElement("div");
                        div.id = "q&a";
                        var question = document.createElement("input");
                        question.type = "text";
                        question.setAttribute("placeholder","question");
                        div.appendChild(question);
                        var i = 0;
                        while (i < 4) {
                            var answ = document.createElement("input");
                            answ.id = "answ";
                            answ.type = "text";
                            answ.setAttribute("placeholder","answer #" + (i + 1));
                            div.appendChild(answ)
                            i++;
                        }
                        var answer = document.createElement("input");
                        answer.type = "text";
                        answer.id = "answer";
                        answer.setAttribute("placeholder", "correct answer");
                        div.appendChild(answer);
                        
                        dpages.appendChild(div);
                    }
                    if (type == "python") {
                        var div = document.createElement("div");
                        div.id = "python";
                        var result = document.createElement("textarea");
                        result.type = "text";
                        result.setAttribute("placeholder","correct result");
                        var task = document.createElement("textarea");
                        task.type = "text";
                        task.setAttribute("placeholder","task");
                        div.appendChild(task);
                        div.appendChild(result);
                        dpages.appendChild(div);
                    }
                } else {
                    alert("Такого типа не существует.");
                }
            }
            
            function publish() {
                var info = document.getElementById("namelesson").value + "ё" + document.getElementById("urlimg").value + "ё" + document.getElementById("desc").value + "ё" + document.getElementById("tag").value + "ё" + document.getElementById("subtag").value + "ё" + document.getElementById("level").value + "^";
                var childs = dpages.children;
                var i = 0;
                while (i < childs.length) {
                    if (childs[i].id == "page") {
                        info += "pageё" + childs[i].value + "ё" + (i+1) + "Ё";
                    }
                    if (childs[i].id == "q&a") {
                        info += "q&aё" + childs[i].children[0].value + "0110" + childs[i].children[1].value + "0110" + childs[i].children[2].value + "0110" + childs[i].children[3].value + "0110" + childs[i].children[4].value + "0110" + childs[i].children[5].value + "ё" + (i+1) + "Ё";
                    }
                    i++;
                }
                if (info !== "") {
                    var dat = {
                        info: info,
                        name: document.getElementById("namelesson").value,
                        type: document.getElementById("type").value
                    };
                    $.post("write.php",dat,function(data) {
                        document.location.href = "/";
                    });
                }
            }
            
            function img() {
                document.getElementById("image").setAttribute("src", document.getElementById("urlimg").value);
            }
        </script>
        <style>
            #page {
                width: 343px;
                resize: none;
            }
        </style>
    </body>
</html>