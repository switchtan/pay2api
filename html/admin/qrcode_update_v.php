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
                               <form action="qrcode_update.php" method="post"
                                    enctype="multipart/form-data">
                                    充值金额:(注意别选错)---------    
                                    <select name="money_type">
                                       <option value="10">10   </option>
                                       <option value="50">50   </option>
                                       <option value="100">100</option>
                                       <option value="300">300</option>
                                       <option value="500">500</option>
                                       <option value="1000">1000</option>
                                       <option value="3000">3000</option>
                                       <option value="5000">5000</option>
                                    </select> 
                                    <br>
                                    <input type="file" name="file" id="file" /> 
                                    <br />
                                    <input type="submit" name="submit" value="上传" />
                                </form>
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
