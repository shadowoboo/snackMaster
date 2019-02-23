<?php
    ob_start();
    session_start();

    $errMsg = "";

    try {
        require_once("connectcd105g2.php");
        $snackNo = $_REQUEST['snackNo'];
        $sql = 'select snackName, snackPic from snack where snackNo = :snackNo';
        $snacks = $pdo -> prepare($sql);
        $snacks -> bindValue(':snackNo', $snackNo);
        $snacks -> execute(); 
        $snack = $snacks -> fetch();
        
        $type = $_REQUEST['snackType'];
        //0 一般
        //1 客製
        //2 即期
        //3 預購
        $_SESSION['snackName'][$type][$snackNo] = $snack['snackName'];
        $_SESSION['snackPrice'][$type][$snackNo] = $_REQUEST['snackPrice'];
        $_SESSION['note'][$type][$snackNo] = $_REQUEST['note']; 
        //即期的話是原價跟專案編號   //預購的話會是購買種類數量
        $_SESSION['snackQuan'][$type][$snackNo] = 1; 
        $_SESSION['snackPic'][$type][$snackNo] = $snack['snackPic'];
        // echo $_SESSION['snackName'][$snackNo].'|'.$_SESSION['snackPrice'][$snackNo].'|'.$_SESSION['cusType'][$snackNo].'|'.$_SESSION['snackQuan'][$snackNo].'|'.$_SESSION['snackPic'][$snackNo];


        //客製箱圖片/聲音/卡片
        //有值才寫入sessions
        if(isset($_REQUEST['cusBox']) && $_REQUEST['cusBox']!=""){
            $_SESSION["cusBox"]=$_REQUEST['cusBox']; //預計截圖之後產生檔案
        }
        if(isset($_REQUEST['cusCard']) &&$_REQUEST['cusCard']!=""){
            $_SESSION["cusCard"]=$_REQUEST['cusCard']; //預計截圖之後產生檔案
        }
        if(isset($_REQUEST['cusSound']) &&$_REQUEST['cusSound']!=""){
            $_SESSION["cusSound"]=$_REQUEST['cusSound']; //預計錄音產生檔案
        }

        //如果有送客製箱過來，但沒有選商品，終止交易並回傳 "noProd"
        if(isset($_SESSION["note"][1][50])==true && in_array("cus",$_SESSION["note"][1])==false){
            echo "noProd";
            // return ;
        }

    } catch (PDOException $e) {
        $errMsg .= "錯誤 : ".$e -> getMessage()."<br>";
        $errMsg .= "行號 : ".$e -> getLine()."<br>";
        echo $errMsg;
    }

?>
