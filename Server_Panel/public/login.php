<?php
require_once '../private/session_manager.php';

if (isset($_POST['inputUsername']) && isset($_POST['inputPassword'])){
    $username = $_POST['inputUsername'];
    $password = $_POST['inputPassword'];
    
    $login_status = login($username, $password);
    //echo $login_status;
    if($login_status == true){
        header('Location: index.php');
    }
} else 
    logout();

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>RAPTOR</title>
    <link href="./css/theme.css" rel="stylesheet">

    <style>
        .tall-row {
            margin-top: 40px;
        }
        .modal {
            position: relative;
            top: auto;
            right: auto;
            left: auto;
            bottom: auto;
            z-index: 1;
            display: block;
        }
    </style>
</head>

<body>

<nav class="navbar navbar-default navbar-static-top">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 col-lg-offset-4">
                <a class="navbar-brand" href="index.php">RAPTOR Login Panel</a>
            </div>
        </div>
    </div>
</nav>


<div class="container">
    <br><br><br>

    <div class="row">
        <div class="col-md-8 col-lg-offset-2">
            <div class="well">
                <br><br>
                <form class="form-horizontal" action="login.php" method="POST" autocomplete="off">
                    <fieldset>
                        <legend>Welcome Attacker</legend>
                        <div class="form-group">
                            <label for="inputUsername" class="col-lg-2 control-label">Username</label>
                            <div class="col-md-5 col-lg-offset-1">
                                <input class="form-control" id="inputUsername" name="inputUsername" placeholder="Username" type="text" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword" class="col-lg-2 control-label">Password</label>
                            <div class="col-md-5 col-lg-offset-1">
                                <input class="form-control" id="inputPassword" name="inputPassword" placeholder="Password" type="password" required>
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <div class="col-md-5 col-lg-offset-5">
                                <button type="submit" class="btn btn-default">Login</button>
                            </div>
                        </div>

                    </fieldset>
                </form>
                <br><br>
            </div>
        </div>
    </div>

    <br><br>

    <div class="row tall-row">
        <div class="col-md-offset-8">
            <p>Created by <a href="#">Mehmet Şirin Sulan</a>. &copy; 2021</p>
        </div>
    </div>

</div>

</body>
</html>
