<?php
    ob_start();
    session_start();
    if( isset($_SESSION['managerName']) == false ){
        header('location:back_login.html');
    }

    $errMsg = "";
    try {
        require_once("../connectcd105g2.php");
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
        }
        if( $_FILES['upFile']['tmp_name'] == null ){
            echo "<script>alert('未上傳圖片，新增販賣機失敗');location.href='back_vending.php';</script>";
        }else{
            $sql = "insert into masell(maPic, maLnge, maLat, maArea, maAdd)
            values(:maPic, :maLnge, :maLat, :maArea, :maAdd)";
            $vending = $pdo -> prepare($sql); 
            $vending -> bindValue(':maPic', $to);
            $vending -> bindValue(':maLnge', $_REQUEST['maLnge']);
            $vending -> bindValue(':maLat', $_REQUEST['maLat']);
            $vending -> bindValue(':maArea', $_REQUEST['maArea']);
            $vending -> bindValue(':maAdd', $_REQUEST['maAdd']);
            $vending -> execute();
            echo "<script>alert('新增販賣機成功！');location.href='back_vending.php';</script>";
        }
    } catch (PDOException $e) {
        $errMsg .= "錯誤 : ".$e -> getMessage()."<br>";
        $errMsg .= "行號 : ".$e -> getLine()."<br>";
        echo $errMsg;
    }
?>