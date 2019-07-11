<?php
    include_once('./../dbconfig.php');
    $one= R::findOne('userqrcode','id =?',[$_REQUEST['id']]);
    R::trash($one);
    header("Location: ./qrcode_list_v.php"); 