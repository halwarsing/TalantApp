<?php
$type = $_POST["type"];
$mysqli = mysqli_connect("localhost","u1065577_halol","bikfut31","u1065577_hal");
mysqli_set_charset($mysqli, "utf8");
$info = mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT * FROM users WHERE login='".$_COOKIE["login"]."'"));
if ($type != "profile") {
    $sqlles = mysqli_query($mysqli, "SELECT * FROM lessons WHERE type='".$type."'");
    
    $arr = array();
    while ($arrles = mysqli_fetch_array($sqlles)) {
        if ($arrles["level"] == $info["lev"]) {
            if ($_POST["tag"] != "All") {
                if ($arrles["subtag"] == $_POST["tag"]) {
                    $img = $arrles["img"];
                    if (!@GetImageSize($img)) {
                        $img = "img/none.jpg";
                    }
                    $arr[] = "<h1 id='name'>".$arrles["name"]."</h1><img src='".$img."' id='photo'><input class='gobtn' type='submit' value='Перейти' id='".$arrles["idname"]."' onclick='go(this);'><input type='submit' class='showdesc' name='show' id='".$arrles["uid"]."' onclick='showdesc(this)' value='Показать описание'><p id='".$arrles["uid"]."-description' style='visibility: hidden;'>".$arrles["description"]."</p>";
                }
            } else {
                $img = $arrles["img"];
                if (!@GetImageSize($img)) {
                    $img = "img/none.jpg";
                }
                $arr[] = "<h1 id='name'>".$arrles["name"]."</h1><img src='".$img."' id='photo'><input class='gobtn' type='submit' value='Перейти' id='".$arrles["idname"]."' onclick='go(this);'><input type='submit' class='showdesc' name='show' id='".$arrles["uid"]."' onclick='showdesc(this)' value='Показать описание'><p id='".$arrles["uid"]."-description' style='visibility: hidden;'>".$arrles["description"]."</p>";
            }
        }
    } 
    $i = count($arr);
    while ($i > -1) {
        echo $arr[$i];
        $i--;
    }
    
} else {
    $sqlprf = mysqli_query($mysqli, "SELECT * FROM users");
    while ($arrles = mysqli_fetch_array($sqlprf)) {
        $img = $arrles["icon"];
        if (!@GetImageSize($img)) {
            $img = "img/none.jpg";
        }
        echo "<h1 id='name'>{$arrles['name']} {$arrles['sname']} {$arrles['mname']}</h1><img src='$img' id='photo'><input type='submit' class='prfbtn' id='{$arrles['id']}' value='Перейти' onclick='goprf(this);'>";
    }
}
?>