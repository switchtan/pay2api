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

                       <p>
                        <h2>1.1获取二维码</h2>
                        <code> 
                            参考<a href="../api_test/get_qrcode.html">get_qrcode.html</a>
                        </code>
                        <code>
                            <h5>/qrcode_get.php?appid=ee54a1fcc9a31800a95ed8eb2df49d41&orderid=10210&money=10&type=3&uid=22&token=9ad02b468dda0df105820556dbb12c12</h5>
                            <h4>输入参数</h4>
                            <code>
                                appid  :APPID号码,在G-Pay后台查看<br>
                                appkey : APPKEY号码,在G-Pay后台查看<br>
                                orderid:订单号<br>
                                money  :金额<br>
                                type   :类别(微信:wx,支付宝:alipay)<br>
                                uid    :客户ID<br>
                                token  :生成方法参考<a href="../api_test/get_qrcode.txt">get_qrcode.txt</a>
                            </code>
                        </code>
                       </p>

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
