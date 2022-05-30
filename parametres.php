<?php
function trimall ($string) {
    return preg_replace("/(^\s*)|(\s*$)/","",
        preg_replace("/\s+/"," ",trim($string)));
}
function magic($path) {
    ini_set('magic_quotes_runtime', '0');
    ini_set('magic_quotes_sybase', '0');
    return (@get_magic_quotes_gpc()=='1'?stripslashes($path):$path);
}
if (isset($parametres) && !empty($parametres)) {
    foreach ($parametres as $num=>$var) {
        if (isset($_POST[$var])) $$var = trimall(htmlspecialchars(magic($_POST[$var])));
        else if (isset($_GET[$var])) $$var = trimall(htmlspecialchars(magic($_GET[$var])));
        else if (isset($_SESSION[$var])) {
            $$var = trimall(htmlspecialchars(magic($_SESSION[$var])));
            unset ($_SESSION[$var]);
        }
        else $$var = '';
    }
}
?>