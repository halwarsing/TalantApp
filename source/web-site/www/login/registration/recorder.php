<?php
$code = $_POST["code"];
if ($_POST["type"] == "de") {
    $alp = "0987654321zyxwvutsrqponmlkjihgfedcb";
    
    function getnum($a,$alp) {
        $ret = "";
        for ($i = 0; $i < strlen($alp); $i++) {
            if ($alp[$i] == $a) {
                $ret = $i;
            }
        }
        return $ret;
    }
    
    for ($i = 0; $i < 8; $i++) {
        $res = $res.getnum($code[$i], $alp);
        if ($i != 7) {
            $res = $res.",";
        }
    }
    echo $res;
} elseif ($_POST["type"] == "re") {
    $alp = "0987654321zyxwvutsrqponmlkjihgfedcb";
    
    function getnum($a,$alp) {
        $ret = $alp[(int) $a];
        return $ret;
    }
    $n = explode(",", $code);
    $ret = "";
    for ($i = 0; $i < 8; $i++) {
        $ret = $ret.getnum($n[$i], $alp);
    }
    echo $ret;
}
?>