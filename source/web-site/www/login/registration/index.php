<html>
    <head>
        <title>REGISTRATION</title>
        <script src='https://code.jquery.com/jquery-3.5.1.min.js'></script>
        <meta charset="utf-8">
    </head>
    <body>
<?php
$mysqli = mysqli_connect("localhost","u1065577_halol","bikfut31","u1065577_hal");
$cod = mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT * FROM users WHERE code='{$_GET['code']}'"));
if ($cod["login"] != "") {
    $cod = "";
}
$level = "";
if (isset($_POST["level"])) {
    $level = $_POST["level"];
} elseif ($_GET["level"] != "") {
    $level = $_GET["level"];
} else {
    header("Location: /");
    exit();
}

if($cod != "") {
    echo "<input type='hidden' id='level' value='".$level."'><div id='reg'><script>codereg = '{$_GET['code']}'</script>
        <input type='text' id='name' placeholder='Ваше имя'>
        <input type='text' id='sname' placeholder='Ваше фамилия'>
        <input type='text' id='mname' placeholder='Ваше Отчество (если есть)'>
        <input type='login' id='login' placeholder='Придумайте логин'>
        <input type='email' id='mail' placeholder='Почта'>
        <input type='password' id='passw' placeholder='Пароль от 8 символов до 20'>
        <input type='submit' onclick='check();' value='Зарегистрироваться' id='subreg'>
    </div>
    <p id='res'></p>";
} else {
    echo "<h1>Error 1. Not found code</h1>";
}
?>
        <script>
            name = "";
            sname = "";
            mname = "";
            code = "";
            ncode = "";
            passw = "";
            login = "";
            email = "";
            
            function gencode() {
                var gen = "bcdefghijklmnopqrstuvwxyz1234567890";
                var rs = "";
                while (rs.length < 8) {
                    rs += gen[Math.floor(Math.random() * gen.length)];
                }
                return rs;
            }
            
            function check() {
                
                var dat = {
                    login: document.getElementById("login").value,
                    mail: document.getElementById("mail").value
                };
                name = document.getElementById("name").value,
                sname = document.getElementById("sname").value,
                mname = document.getElementById("mname").value
                if (dat["name"] !== "" && dat["sname"] !== "") {
                    if (dat["login"] !== "") {
                        if (dat["mail"].indexOf("@") != -1) {
                            if ((document.getElementById("passw").value).length > 7 && (document.getElementById("passw").value).length < 21) {
                                $.post("check.php",dat, function(data) {
                                    if (data === "") {
                                        document.getElementById("res").textContent = "Вам на почту отправлено письмо!";
                                        document.getElementById("res").style.color = "#00ff09";
                                        passw = document.getElementById("passw").value;
                                        login = document.getElementById("login").value;
                                        email = dat["mail"];
                                        document.getElementById("reg").innerHTML = "<div id='auth'></div><input type='text' id='code' placeholder='Код с почты'><input type='submit' value='Подтвердить' onclick='finish();' id='subcode'><input type='hidden' id='ncode'>";
                                        code = gencode();
                                        
                                        var dats = {
                                            mail: dat["mail"],
                                            code: code
                                        };
                                        var dati = {
                                            code: code,
                                            type: "de"
                                        }
                                        $.post("recorder.php",dati, function(data) {
                                            document.getElementById("ncode").value = data;
                                        });
                                        $.post("sendcode.php", dats);
                                        code = "";
                                    } 
                                    else {
                                        document.getElementById("res").textContent = "Логин или почта уже используется!";
                                    }
                                });
                            } else {
                               document.getElementById("res").textContent = "Пароль слишком короткий или длинный!";
                            }
                        } else {
                            document.getElementById("res").textContent = "Неправильно была введена почта!";
                        }
                    } else {
                        document.getElementById("res").textContent = "Неправильно введён логин";
                    }
                } else {
                    document.getElementById("res").textContent = "Неправильно введён имя или фамилия"
                }
            }
            
            function finish() {
                var dat = {
                    type: "re",
                    code: document.getElementById("ncode").value
                };
                $.post("recorder.php",dat,function(data) {
                    if (document.getElementById("code").value == data) {
                        var res = {
                            code: codereg,
                            login: login,
                            passw: passw,
                            email: email,
                            name: name,
                            sname: sname,
                            mname: mname,
                            level: document.getElementById("level").value
                        }
                        if (passw !== "" && login !== "" && email !== "" && typeof(document.getElementById("level")) !== "undefined" && document.getElementById("level").value !== "") {
                            $.post("reg.php",res,function(data) {
                                var dati = {
                                    login: res["login"]
                                };
                                
                                $.post("cookie.php", dati, function(data) {
                                    document.getElementById("auth").innerHTML = "<form id='authi' method='POST' action='cookie.php'><input type='hidden' name='login' value='"+login+"'></form>";
                                    document.getElementById("authi").submit();
                                });
                            });
                        } else {
                            alert("Вы изменили данные или случился баг! Перезагрузите страницу.");
                        }
                    }
                });
            }
        </script>
        <style>
            #res {
                text-align: center;
                color: #f00;
            }
            #subcode {
                padding-left: 10px;
                margin-top: 20px;
                background-color: #6f59ff;
                border: 1px solid #170a69;
                border-radius: 10px;
                width: 343px;
                height: 50px;
                font-size: 20px;
                outline: none;
            }
            
            #code {
                padding-left: 10px;
                margin-top: 50px;
                width: 343px;
                height: 50px;
                background-color: #6f59ff;
                border: 1px solid #170a69;
                border-radius: 10px;
                font-size: 20px;
                outline: none;
            }
            
            #reg {
                width: 343px;
                position: relative;
            }
            
            #login {
                padding-left: 10px;
                background-color: #6f59ff;
                border: 1px solid #170a69;
                border-radius: 10px;
                width: 343px;
                height: 50px;
                font-size: 20px;
                outline: none;
            }
            
            #name {
                padding-left: 10px;
                background-color: #6f59ff;
                border: 1px solid #170a69;
                border-radius: 10px;
                width: 343px;
                height: 50px;
                font-size: 20px;
                outline: none;
            }
            
            #mname {
                padding-left: 10px;
                background-color: #6f59ff;
                border: 1px solid #170a69;
                border-radius: 10px;
                width: 343px;
                height: 50px;
                font-size: 20px;
                outline: none;
            }
            
            #sname {
                padding-left: 10px;
                background-color: #6f59ff;
                border: 1px solid #170a69;
                border-radius: 10px;
                width: 343px;
                height: 50px;
                font-size: 20px;
                outline: none;
            }
            
            #mail {
                padding-left: 10px;
                margin-top: 20px;
                background-color: #6f59ff;
                border: 1px solid #170a69;
                border-radius: 10px;
                width: 343px;
                height: 50px;
                font-size: 20px;
                outline: none;
            }
            
            #passw {
                 padding-left: 10px;
                margin-top: 20px;
                background-color: #6f59ff;
                border: 1px solid #170a69;
                border-radius: 10px;
                width: 343px;
                height: 50px;
                font-size: 20px;
                outline: none;
            }
            
            #subreg {
                padding-left: 10px;
                margin-top: 20px;
                background-color: #6f59ff;
                border: 1px solid #170a69;
                border-radius: 10px;
                width: 343px;
                height: 50px;
                font-size: 20px;
                outline: none;
            }
            
            #subreg:hover {
                background-color: #4529ff;
            }
            
            #subcode:hover {
                background-color: #4529ff;
            }
            
            #login::-webkit-input-placeholder {color:#000000;}
            #login::-moz-placeholder          {color:#000000;}
            #login:-moz-placeholder           {color:#000000;}
            #login:-ms-input-placeholder      {color:#000000;}
            #mail::-webkit-input-placeholder {color:#000000;}
            #mail::-moz-placeholder          {color:#000000;}
            #mail:-moz-placeholder           {color:#000000;}
            #mail:-ms-input-placeholder      {color:#000000;}
            #passw::-webkit-input-placeholder {color:#000000;}
            #passw::-moz-placeholder          {color:#000000;}
            #passw:-moz-placeholder           {color:#000000;}
            #passw:-ms-input-placeholder      {color:#000000;}
            #code::-webkit-input-placeholder {color:#000000;}
            #code::-moz-placeholder          {color:#000000;}
            #code:-moz-placeholder           {color:#000000;}
            #code:-ms-input-placeholder      {color:#000000;}
            #name::-webkit-input-placeholder {color:#000000;}
            #name::-moz-placeholder          {color:#000000;}
            #name:-moz-placeholder           {color:#000000;}
            #name:-ms-input-placeholder      {color:#000000;}
            #sname::-webkit-input-placeholder {color:#000000;}
            #sname::-moz-placeholder          {color:#000000;}
            #sname:-moz-placeholder           {color:#000000;}
            #sname:-ms-input-placeholder      {color:#000000;}
            #mname::-webkit-input-placeholder {color:#000000;}
            #mname::-moz-placeholder          {color:#000000;}
            #mname:-moz-placeholder           {color:#000000;}
            #mname:-ms-input-placeholder      {color:#000000;}
        </style>
    </body>
</html>