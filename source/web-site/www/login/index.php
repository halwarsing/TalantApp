<!DOCTYPE html>
<html>
    <head>
        <title>LOGIN</title>
        <meta charset="utf-8">
        <script src='https://code.jquery.com/jquery-3.5.1.min.js'></script>
    </head>
    <body>
<?php
if ($_COOKIE["login"] == "") {
    echo "<a href='/'>Вы уже Авторизированы</a>";
} else {
    echo '<div id="reg">
            <form method="POST" action="registration/" id="forma">
                <h1 id="rin">Регистрация</h1>
                <select size="1" name="level" id="level">
                    <option value="student">Ребёнок</option>
                    <option value="teacher">Преподаватель</option>
                </select>
                <input type="text" placeholder="Введите код регистрации" id="code">
                <input type="button" onclick="reg();" value="Зарегистрироваться" id="rsub">
            </form>
        </div>

        <div id="auth">
            <h1 id="nin">Вход</h1>
            <input type="login" id="login" placeholder="Логин">
            <input type="password" id="passw" placeholder="Пароль">
            <input type="submit" id="csub" onclick="check();">
            <p id="res"></p>
        </div>';
}
?>
        <script>
            function check() {
                var login = document.getElementById("login").value;
                var passw = document.getElementById("passw").value;
                var dat = {
                    login: login,
                    passw: passw,
                };
                $.post("cudodb.php",dat,function(data) {
                    console.log(data);
                    if (data == "yes") {
                        document.getElementById("res").textContent = "Неправильный логин или пароль";
                        document.getElementById("res").style.color = "#f00";
                    } 
                    if (data == "no") {
                        document.getElementById("res").textContent = "Добро пожаловать";
                        document.getElementById("res").style.color = "#00ff09";
                        document.getElementById("auth").innerHTML = "<form id='authi' method='POST' action='cookie.php'><input type='hidden' name='login' value='"+login+"'></form>";
                        document.getElementById("authi").submit();
                    }
                });
            }
            
            function reg() {
                var forma = document.getElementById("forma");
                forma.setAttribute("action","registration/?code=" + document.getElementById("code").value);
                forma.submit();
            }
        </script>
        <style>
            /*auth*/
            #auth {
                width: 343px;
                height: 300px;
                background-color: #28169c;
                border-radius: 10px;
            }
            
            #nin {
                color: #816eff;
                margin-left: 133px;
                padding-top: 10px; 
                position: relative;
            }
            
            #csub {
                width: 323px;
                height: 50px;
                background-color: #5646bd;
                border: 1px solid #120275;
                border-radius: 10px;
                margin-left: 10px;
                margin-top: 20px;
                outline: none;
                position: relative;
                color: #fec9ff;
            }
            
            #csub:hover {
                background-color: #18078a;
            }
            
            #login {
                padding: 5px;
                width: 307px;
                height: 50px;
                background-color: #5646bd;
                border: 3px #18078a solid;
                color: #fec9ff;
                border-radius: 10px;
                position: relative;
                outline: none;
                margin-left: 10px;
            }
            
            #login input::placeholder {
                color: #fec9ff;
            }
            
            #passw {
                padding: 5px;
                margin-top: 20px;
                width: 307px;
                height: 50px;
                background-color: #5646bd;
                border: 3px #18078a solid;
                color: #fec9ff;
                border-radius: 10px;
                position: relative;
                outline: none;
                margin-left: 10px;
            }
            
            #res {
                text-align: center;
            }
            
            #login::-webkit-input-placeholder {color:#fec9ff;}
            #login::-moz-placeholder          {color:#fec9ff;}
            #login:-moz-placeholder           {color:#fec9ff;}
            #login:-ms-input-placeholder      {color:#fec9ff;}
            #passw::-webkit-input-placeholder {color:#fec9ff;}
            #passw::-moz-placeholder          {color:#fec9ff;}
            #passw:-moz-placeholder           {color:#fec9ff;}
            #passw:-ms-input-placeholder      {color:#fec9ff;}
            
            /*auth*/
            /*reg*/
            #reg {
                width: 343px;
                height: 200px;
                background-color: #28169c;
                border-radius: 10px;
            }
            
            #level {
                display: block;
                width: 323px;
                height: 50px;
                margin-left: 10px;
                position: relative;
                padding-left: 10px;/* отступы от текста до рамки */
                background: #5646bd; /* убираем фон */
                border: 1px solid #120275; /* рамка */
                border-radius: 10px;/* скругление полей формы */
                -webkit-appearance: none;/* Chrome */
                -moz-appearance: none;/* Firefox */
                appearance: none;/* убираем дефолнтные стрелочки */
                font-family: inherit;/* наследует от родителя */
                font-size: 30px;
                color: #fec9ff;
                outline: none;
            }
            
            #rin {
                color: #816eff;
                margin-left: 69px;
                padding-top: 10px; 
                position: relative;
            }
            
            #rsub {
                width: 323px;
                height: 50px;
                background-color: #5646bd;
                border: 1px solid #120275;
                border-radius: 10px;
                margin-left: 10px;
                margin-top: 20px;
                outline: none;
                position: relative;
                color: #fec9ff;
            }
            
            #rsub:hover {
                background-color: #18078a;
            }
            /*reg*/
        </style>
    </body>
</html>