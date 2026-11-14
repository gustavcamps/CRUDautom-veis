<?php
    $codigo = $_GET['cod'];
    require('connect.php');
    $con = mysqli_connect('localhost','root','','bd_carros');
    mysqli_query($con, "Delete from `tb_carros` where `codigo` = '$codigo'");