<?php
include_once('./../dbconfig.php');
// $w = R::dispense( 'userqrcode' );
session_start();
$all = R::find('payrecord', 'uid= ?',[$_SESSION["uid"] ]);
// print_r($all);
?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title> - 论坛</title>
    <meta name="keywords" content="">
    <meta name="description" content="">

    <link rel="shortcut icon" href="favicon.ico"> <link href="css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="css/font-awesome.css?v=4.4.0" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css?v=4.1.0" rel="stylesheet">

</head>

<body class="gray-bg">
    <div class="row">
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-sm-12">
                    <div class="wrapper wrapper-content animated fadeInRight">

                        <div class="ibox-content m-b-sm border-bottom">
                            <div class="p-xs">
                                <table border="1" style="text-align:center" >
                                     <tr>
                                        <th>金额</th>
                                        <th>链接</th>
                                        <th>操作</th>
                                      </tr>

                               <?php
                                
                                foreach ($all as $value) {

                                    # code...
                                    echo ' <tr>';
                                    echo "<td style='word-wrap:break-word;word-break:break-all;' width='100px';>".$value['money']."</td>";
                                    echo "<td style='word-wrap:break-word;word-break:break-all;' width='800px';>".$value['qrcode']."</td>";
                                    echo "<td style='word-wrap:break-word;word-break:break-all;' width='100px';>".
                                    '<a href=./qrcode_del.php?id='.$value['id'].">删除</a></td>";
                                    echo ' </tr>';
                                }
                                
                               ?>
                               </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 全局js -->
    <script src="js/jquery.min.js?v=2.1.4"></script>
    <script src="js/bootstrap.min.js?v=3.3.6"></script>



    <!-- Peity -->
    <script src="js/plugins/peity/jquery.peity.min.js"></script>

    <!-- 自定义js -->
    <script src="js/content.js?v=1.0.0"></script>


    
    

</body>

</html>
