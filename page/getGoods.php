<?php
try{
  require_once("connectcd105g2.php");
  $sql = "SELECT snackPic FROM `snack` WHERE boxDate = :boxDate";
  $goodsRow = $pdo->prepare( $sql );
  $goodsRow->bindValue(":boxDate", $_REQUEST["month"]);
  $goodsRow->execute();

    //送出html結構字串
    $html = '';
    $goods = $goodsRow->fetchAll();
    $html .= "<div class='snacksRunImg'>
                <img src='{$goods[0]["snackPic"]}' alt='零食'>
            </div>
            <div class='snacksRunImg'>
                <img src='{$goods[1]["snackPic"]}' alt='零食'>
            </div>
            <div class='snacksRunImg'>
                <img src='{$goods[2]["snackPic"]}' alt='零食'>
            </div>
            <div class='snacksRunImg'>
                <img src='{$goods[3]["snackPic"]}' alt='零食'>
            </div>
            <div class='snacksRunImg'>
                <img src='{$goods[4]["snackPic"]}' alt='零食'>
            </div>
            <div class='snacksRunImg'>
                <img src='{$goods[5]["snackPic"]}' alt='零食'>
            </div>";
    echo $html;   

}catch(PDOException $e){
  echo $e->getMessage();
}
?>