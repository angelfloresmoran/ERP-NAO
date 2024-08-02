<?php

    $server = "localhost";
    $user = "root";
    $password = "";
    $db ="admin-nao";

    $conex =  mysqli_connect($server, $user, $password, $db) or die(mysqli_error());
    mysqli_set_charset($conex, "utf8");
?>