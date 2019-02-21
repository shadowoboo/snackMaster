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
        echo $_SESSION['snackName'][$snackNo].'|'.$_SESSION['snackPrice'][$snackNo].'|'.$_SESSION['cusType'][$snackNo].'|'.$_SESSION['snackQuan'][$snackNo].'|'.$_SESSION['snackPic'][$snackNo];
    } catch (PDOException $e) {
        $errMsg .= "錯誤 : ".$e -> getMessage()."<br>";
        $errMsg .= "行號 : ".$e -> getLine()."<br>";
        echo $errMsg;
    }

?>
