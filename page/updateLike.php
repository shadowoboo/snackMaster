<?php
session_start();
if(isset($_SESSION['likedEvaNo'])){
    
    if(in_array($_REQUEST["evaNo"],($_SESSION['likedEvaNo']))){

        echo "liked";
    }else{
        try{
            require_once("connectcd105g2.php");
            $sql="UPDATE `eva` SET `like` = :liketime WHERE `eva`.`evaNo` = :evaNo";
            $updateLike = $pdo->prepare( $sql );
            $updateLike -> bindParam( ":liketime",$_REQUEST["liketime"] );
            $updateLike -> bindParam( ":evaNo", $_REQUEST["evaNo"] );
            $updateLike -> execute();

            $index= count( $_SESSION['likedEvaNo']);
            $_SESSION['likedEvaNo'][$index]=$_REQUEST["evaNo"];

        }catch(PDOException $e){

            echo $e->getMessage();
            }

    }
}else{
    $_SESSION['likedEvaNo']=array();

    try{
    require_once("connectcd105g2.php");
    $sql="UPDATE `eva` SET `like` = :liketime WHERE `eva`.`evaNo` = :evaNo";
    $updateLike = $pdo->prepare( $sql );
    $updateLike -> bindParam( ":liketime",$_REQUEST["liketime"] );
    $updateLike -> bindParam( ":evaNo", $_REQUEST["evaNo"] );
    $updateLike -> execute();
    $_SESSION['likedEvaNo'][0]=$_REQUEST["evaNo"];
    }catch(PDOException $e){
    echo $e->getMessage();
    }

}

?>