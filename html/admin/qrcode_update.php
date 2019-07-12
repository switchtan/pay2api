<?php
    include_once('./../dbconfig.php');
    require __DIR__ . "./../vendor/autoload.php";
    $storage = new \Upload\Storage\FileSystem(__DIR__.'/fileupload/');
    $file = new \Upload\File('file', $storage);
    $new_filename = uniqid();
    $file->setName($new_filename);
    // Access data about the file that has been uploaded
    $data = array(
        'name'       => $file->getNameWithExtension(),
        'extension'  => $file->getExtension(),
        'mime'       => $file->getMimetype(),
        'size'       => $file->getSize(),
        'md5'        => $file->getMd5(),
        'dimensions' => $file->getDimensions()
    );

    // Try to upload file
    try {
        // Success!
        $file->upload();
        // echo __DIR__.'/fileupload/'.$data['name'];
        $qrcode = new Zxing\QrReader(__DIR__.'/fileupload/'.$data['name']);
        $text = $qrcode->text(); //return decoded text from QR Code
        // echo $text;
        $w = R::dispense( 'userqrcode' );
        session_start();
        $w->uid = $_SESSION["uid"] ;
        $w->money =$_REQUEST['money_type'];
        $w->qrcode = $text;
        if(stripos($text,'wxp:') == 0){
            $w->type='wx';
        }else{
            $w->type='alipay';
        }
        $id = R::store( $w );
        echo '上传成功';

    } catch (\Exception $e) {
        // Fail!
        $errors = $file->getErrors();
    }