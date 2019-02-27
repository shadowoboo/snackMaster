<?php
session_start();
//判別檢舉的是評價或是留言
if($_REQUEST['repTo']=='cmt'){

    //檢查session中是否有repEva陣列
    if(isset($_SESSION['repedEvaNo'])){
        //若有 則檢查陣列中是否有相同的編號
            if(in_array($_REQUEST["repNo"],$_SESSION['repedEvaNo'])){
                //找到相同編號 表示檢舉過此評價
                echo "already";
            }else{
                //找不到就新增一筆檢舉
                try{
                    require_once("connectcd105g2.php");
                    $sql="INSERT INTO `evareport` (`evaNo`, `evaRepDate`, `evaCheck`) VALUES ( :repNo, CURRENT_DATE(), '0')";
                    $updateLike = $pdo->prepare( $sql );
                    $updateLike -> bindParam( ":repNo", $_REQUEST["repNo"] );
                    $updateLike -> execute();

                    $index= count( $_SESSION['repedEvaNo']);
                    $_SESSION['repedEvaNo'][$index]=$_REQUEST["repNo"];
                    echo 'still here faluire';
                }catch(PDOException $e){
                    echo $e->getMessage();
                    }

            }
    }else{
        $_SESSION['repedEvaNo']=array();

        try{
            require_once("connectcd105g2.php");
            $sql="INSERT INTO `evareport` (`evaNo`, `evaRepDate`, `evaCheck`) VALUES ( :repNo, CURRENT_DATE(), '0')";
            $updateLike = $pdo->prepare( $sql );
            $updateLike -> bindParam( ":repNo", $_REQUEST["repNo"] );
            $updateLike -> execute();
            $_SESSION['repedEvaNo'][0]=$_REQUEST["repNo"];
        }catch(PDOException $e){
            echo $e->getMessage();
        }

    }
}else{

      //檢查session中是否有repEva陣列
      if(isset($_SESSION['repedMsgNo'])){
        //若有 則檢查陣列中是否有相同的編號
        if(in_array($_REQUEST["repNo"],$_SESSION['repedMsgNo'])){
            //找到相同編號 表示檢舉過此評價
            echo "already2";
        }else{
            //找不到就新增一筆檢舉
            try{
                require_once("connectcd105g2.php");
                $sql="INSERT INTO `msgreport` (`msgReportNo`, `msgTime`, `msgCheck`, `msgNo`) VALUES (NULL, CURRENT_DATE(), '0', :repNo)";
                $updateLike = $pdo->prepare( $sql );
                $updateLike -> bindParam( ":repNo", $_REQUEST["repNo"] );
                $updateLike -> execute();

                $index= count( $_SESSION['repedMsgNo']);
                $_SESSION['repedMsgNo'][$index]=$_REQUEST["repNo"];

            }catch(PDOException $e){
                echo $e->getMessage();
                }

        }
    }else{
        $_SESSION['repedMsgNo']=array();

        try{
            require_once("connectcd105g2.php");
            $sql="INSERT INTO `msgreport` (`msgReportNo`, `msgTime`, `msgCheck`, `msgNo`) VALUES (NULL, CURRENT_DATE(), '0', :repNo)";
            $updateLike = $pdo->prepare( $sql );
            $updateLike -> bindParam( ":repNo", $_REQUEST["repNo"] );
            $updateLike -> execute();
            $_SESSION['repedMsgNo'][0]=$_REQUEST["repNo"];
        }catch(PDOException $e){
            echo $e->getMessage();
        }

    }


}
?>