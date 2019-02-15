<?php
// $psn = $_REQUEST["psn"];
    $errMsg = "";
    try{
        require_once("connectcd105g2.php");
        $sql = "select * from msg where msgNo = ?";
        $products = $pdo->prepare($sql);
        $products->bindValue(1, 1);
        $products->execute();
    }catch(PDOException $e){
        $errMsg .= "錯誤原因 : ".$e -> getMessage(). "<br>";
        $errMsg .= "錯誤行號 : ".$e -> getLine(). "<br>";
    }

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <?php 
        if( $errMsg != ""){ //例外
        echo $errMsg;
        }elseif($products->rowCount()==0){
            echo "<div><center>查無留言</center></div>";
        }else{
            $prodRow = $products->fetchObject();
        }
    ?>
    <?php echo $prodRow->msgText;?>
    <?php phpinfo()?>
</body>
</html>