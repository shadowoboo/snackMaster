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
            // default : 
                // echo "['error']: " , $_FILES['upFile']['error'] , "<br>";
        }
        if( $_FILES['upFile']['tmp_name'] == null ){
            echo "<script>alert('未上傳圖片，新增商品失敗');location.href='back_snack.php';</script>";
        }else{
            $sql = "insert into snack(snackGenre, nation, snackName, snackStatus, snackWord, snackPic, snackPrice, snackIngre, snackVending, boxDate)
             values(:snackGenre, :nation, :snackName, :snackStatus, :snackWord, :snackPic, :snackPrice, :snackIngre, :snackVending, :boxDate)";
            $snack = $pdo -> prepare($sql); 
            $snack -> bindValue(':snackGenre', $_REQUEST['genre']);
            $snack -> bindValue(':nation', $_REQUEST['nation']);
            $snack -> bindValue(':snackName', $_REQUEST['snackName']);
            $snack -> bindValue(':snackStatus', $_REQUEST['snackStatus']);
            $snack -> bindValue(':snackWord', $_REQUEST['snackWord']);
            $snack -> bindValue(':snackPic', $to);
            $snack -> bindValue(':snackPrice', $_REQUEST['snackPrice']);
            $snack -> bindValue(':snackIngre', $_REQUEST['snackIngre']);
            $snack -> bindValue(':snackVending', $_REQUEST['snackVending']);
            $boxDate = $_REQUEST['boxDate'] == ''? null:$_REQUEST['boxDate']."-01";
            $snack -> bindValue(':boxDate', $boxDate);
            $snack -> execute();
            echo "<script>alert('新增商品成功！');location.href='back_snack.php';</script>";
        }
    } catch (PDOException $e) {
        $errMsg .= "錯誤 : ".$e -> getMessage()."<br>";
        $errMsg .= "行號 : ".$e -> getLine()."<br>";
        echo $errMsg;
    }
?>