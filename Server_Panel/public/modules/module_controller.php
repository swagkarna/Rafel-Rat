<?php
if (function_exists('isLogin')){
    if(!isLogin()){
        header('Location: login.php');
    }
} else {
    header('Location: login.php');
}
