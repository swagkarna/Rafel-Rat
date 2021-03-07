<?php
session_start();
$panel_username = 'Hande';
$panel_password = 'Ercel';

function logout(){
    $_SESSION = [];
    unset($_SESSION['username']);
    unset($_SESSION['password']);
    session_unset();
}


function login($username, $password){
    global $panel_username;
    global $panel_password;
    
    if (($username == $panel_username) && ($password == $panel_password)) {
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        return true;            
    }
    
    return false;
    
}

function isLogin(){
    global $panel_username;
    global $panel_password;
    
    if(isset($_SESSION['username']) && isset($_SESSION['password'])){
        if (($_SESSION['username'] == $panel_username) && ($_SESSION['password'] == $panel_password)) {
            return true;            
        } else {
            logout();
            return false;
        }
    }
    return false;
}

