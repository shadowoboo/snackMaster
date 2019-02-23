<?php
    ob_start();
    session_start();
    if( isset($_SESSION['managerName']) == false ){
        header('location:back_login.html');
    }

    $errMsg = "";
    try {
        require_once("../connectcd105g2.php");

        $sql = "select imgSRC from coupon where coupNo = :coupNo";
        $coupons = $pdo -> prepare($sql); 
        $coupons -> bindValue(":coupNo", $_REQUEST['coupNo']);
        $coupons -> execute();
        $coupon = $coupons -> fetch();
        $oldPic = $coupon['imgSRC'];

        switch( $_FILES['upFile']["error"] ){
            case UPLOAD_ERR_OK:
                $from = $_FILES['upFile']['tmp_name'];
                $to = "../../images/back/{$_FILES['upFile']['name']}";
                copy($from, $to);
                $length = strlen($to) - 1;
                $to = substr( $to, 3, $length );
                break;
            case UPLOAD_ERR_INI_SIZE:
                echo "上傳檔案太大,不得超過: ", ini_get("upload_max_filesize"), "<br>";
                break;
            case UPLOAD_ERR_FORM_SIZE:
                echo "上傳檔案太大 <br>";
                break;
            case UPLOAD_ERR_PARTIAL:
                echo "未上傳檔案 <br>";
                break;
            default : 
                echo "['error']: " , $_FILES['upFile']['error'] , "<br>";
        }
        if( $_FILES['upFile']['tmp_name'] == null ){
            $to = $oldPic;
        }

        $sql = "update coupon set imgSRC = :imgSRC where coupNo = :coupNo";
        $coupon = $pdo -> prepare($sql);
        $coupon -> bindValue(':imgSRC', $to);
        $coupon -> bindValue(':coupNo', $_REQUEST['coupNo']);
        $coupon -> execute();
        echo "<script>alert('修改優惠券成功！');location.href='back_coupon.php';</script>";
    } catch (PDOException $e) {
        $errMsg .= "錯誤 : ".$e -> getMessage()."<br>";
        $errMsg .= "行號 : ".$e -> getLine()."<br>";
        echo $errMsg;
    }
?>