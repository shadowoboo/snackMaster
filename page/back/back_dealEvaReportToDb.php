<?php
    ob_start();
    session_start();
    if( isset($_SESSION['managerName']) == false ){
        header('location:back_login.html');
    }

    $errMsg = "";
    try {
        require_once("../connectcd105g2.php");
        $evaNo = $_REQUEST['evaNo'];
        if( $_REQUEST['status'] == 'sustain' ){
            $sql = "select * from msg where evaNo = {$evaNo}";
            $msg = $pdo -> query($sql);
            
            while( $msgRow = $msg -> fetch() ){
                //刪除留言檢舉
                $sql = "delete from msgreport where msgNo = {$msgRow['msgNo']}";
                $msgReport = $pdo -> exec($sql);
                //刪除留言
                $sql = "delete from msg where msgNo = {$msgRow['msgNo']}";
                $msgs = $pdo -> exec($sql);
            };
            $sql = "select * from eva where evaNo = {$evaNo}";
            $eva = $pdo -> query($sql);   
             
            
                //更新商品星等跟次數
                //刪除檢舉
                //會員扣評價跟按讚積分，被檢舉次數+1
                //刪除評價    
            
            
            



        }else{
            $sql = "update evareport set evaCheck = 1 where evaRepNo = {$_REQUEST['evaRepNo']}";
            $overule = $pdo -> exec($sql);
            echo 'true';
        }


        // $sql = "insert into masell(maPic, maLnge, maLat, maArea, maAdd)
        //  values(:maPic, :maLnge, :maLat, :maArea, :maAdd)";
        // $vending = $pdo -> prepare($sql); 
        // $vending -> bindValue(':maPic', $_REQUEST['maPic']);
        // $vending -> bindValue(':maLnge', $_REQUEST['maLnge']);
        // $vending -> bindValue(':maLat', $_REQUEST['maLat']);
        // $vending -> bindValue(':maArea', $_REQUEST['maArea']);
        // $vending -> bindValue(':maAdd', $_REQUEST['maAdd']);
        // $vending -> execute();
        // echo "<script>alert('新增販賣機成功！');location.href='back_vending.php';</script>";
    } catch (PDOException $e) {
        $errMsg .= "錯誤 : ".$e -> getMessage()."<br>";
        $errMsg .= "行號 : ".$e -> getLine()."<br>";
        echo $errMsg;
    }
?>