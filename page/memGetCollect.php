
<?php
     session_start();
     try{
        require_once("connectcd105g2.php");
        $sql = "SELECT * FROM favorite f JOIN snack s on s.snackNo = f.snackNo where memNo = :memNo";
        $favorite = $pdo->prepare( $sql );
        $favorite->bindValue(":memNo", $_SESSION["memNo"]);
        // $favorite->bindValue(":memNo", 2);
        $favorite->execute();

        if( $favorite->rowCount() ==0 ){
            echo "您目前沒有任何收藏品唷!";
        }else{
            $html='';
            while($favoriteRow = $favorite->fetch(PDO::FETCH_ASSOC)){

            //送出html結構字串
            $html = 
                "<div class='item citem1'>
                    <img class='country' src='../images/blair/{$favoriteRow['nation']}.png' alt='national'>
                    <img class='itemImg' src='{$favoriteRow['snackPic']}' alt='image'>
                    <h4 class='itemName'>[{$favoriteRow['nation']}]{$favoriteRow['snackName']}</h4>
                    <div class='sellPrice'>
                        <p>價格<span>{$favoriteRow['snackPrice']}</span></p>

                    </div>
                    <div class='citemBtns'>
                        <button class='cart' id='{$favoriteRow['snackNo']}|{$favoriteRow['snackPrice']}|0' >加入購物車</button>
                        <button class='trash' id='{$favoriteRow['snackNo']}'><i class='far fa-trash-alt'></i></button>
                    </div>
                </div>";
                echo $html;
            }
        
    }

    }catch(PDOException $e){
            echo $e->getMessage();
    }
?>