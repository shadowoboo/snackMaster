<?php
try{
  require_once("connectBooksRick.php");
  if($_REQUEST["category"] === '綜合'){
    $sql = "select * from snack order by goodStars desc limit 3";
    $prodRow = $pdo->prepare( $sql );
    // $prodRow->bindValue(":category", $_REQUEST["category"]);
    $prodRow->execute();

    if( $prodRow->rowCount() == 0 ){ //找不到
        //傳回空的JSON字串
        echo "<center>此商品暫無評價</center>";
      }else{ //找得到
           
        //送出html結構字串
        $html = '';
        $row = $prodRow->fetchAll();
        $html .= "<div class='LeaderboardNo2'>
                        <a href='showItem.html'>
                            <div class='Leaderboarditem No2'>
                                <div class='LeaderboarCountry'>
                                    <img src='{$row[1]["nation"]}' alt='排行國家'>
                                </div>
                                <div class='commodity'>
                                    <img src='{$row[1]["snackPic"]}' alt='產品圖'>
                                    <h4 class='commodityTitle'>[{$row[1]["nation"]}]{$row[1]["snackName"]}</h4>
                                    <div class='flexMid'>
                                        <p class='score'>4.8<span class='total'>/5</span></p>
                                    </div>
                                    <div class='commodityStar'><img src='../images/rankBoard/starMask.png' alt='星等'>
                                    </div>
                                </div>
                            </div>
                        </a>
                  </div>"; 
        $html .= "<div class='LeaderboardNo1'>
                    <a href='showItem.html'>
                        <div class='Leaderboarditem No1'>
                            <div class='LeaderboarCountry'>
                                <img src='{$row[0]["nation"]}' alt='排行國家'>
                            </div>
                            <div class='commodity'>
                                <img src='{$row[0]["snackPic"]}' alt='產品圖'>
                                <h4 class='commodityTitle'>[{$row[0]["nation"]}]{$row[0]["snackName"]}</h4>
                                <div class='flexMid'>
                                    <p class='score'>4.8<span class='total'>/5</span></p>
                                </div>
                                <div class='commodityStar'><img src='../images/rankBoard/starMask.png' alt='星等'>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>";
        $html .= "<div class='LeaderboardNo3'>
                    <a href='showItem.html'>
                        <div class='Leaderboarditem No3'>
                            <div class='LeaderboarCountry'>
                                <img src='{$row[2]["nation"]}' alt='排行國家'>
                            </div>
                            <div class='commodity'>
                                <img src='{$row[2]["snackPic"]}' alt='產品圖'>
                                <h4 class='commodityTitle'>[{$row[2]["nation"]}]{$row[2]["snackName"]}</h4>
                                <div class='flexMid'>
                                    <p class='score'>4.8<span class='total'>/5</span></p>
                                </div>
                                <div class='commodityStar'><img src='../images/rankBoard/starMask.png' alt='星等'>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>";
        echo $html;   
      }	

  }else{

      $sql = "select * from snack where snackGenre = :category order by goodStars desc limit 3";
      $prodRow = $pdo->prepare( $sql );
      $prodRow->bindValue(":category", $_REQUEST["category"]);
      $prodRow->execute();
      
      if( $prodRow->rowCount() == 0 ){ //找不到
        //傳回空的JSON字串
        echo "<center>此商品暫無評價</center>";
      }else{ //找得到
           
        //送出html結構字串
        $html = '';
        $row = $prodRow->fetchAll();
        $html .= "<div class='LeaderboardNo2'>
                        <a href='showItem.html'>
                            <div class='Leaderboarditem No2'>
                                <div class='LeaderboarCountry'>
                                    <img src='{$row[1]["nation"]}' alt='排行國家'>
                                </div>
                                <div class='commodity'>
                                    <img src='{$row[1]["snackPic"]}' alt='產品圖'>
                                    <h4 class='commodityTitle'>[{$row[1]["nation"]}]{$row[1]["snackName"]}</h4>
                                    <div class='flexMid'>
                                        <p class='score'>4.8<span class='total'>/5</span></p>
                                    </div>
                                    <div class='commodityStar'><img src='../images/rankBoard/starMask.png' alt='星等'>
                                    </div>
                                </div>
                            </div>
                        </a>
                  </div>"; 
        $html .= "<div class='LeaderboardNo1'>
                    <a href='showItem.html'>
                        <div class='Leaderboarditem No1'>
                            <div class='LeaderboarCountry'>
                                <img src='{$row[0]["nation"]}' alt='排行國家'>
                            </div>
                            <div class='commodity'>
                                <img src='{$row[0]["snackPic"]}' alt='產品圖'>
                                <h4 class='commodityTitle'>[{$row[0]["nation"]}]{$row[0]["snackName"]}</h4>
                                <div class='flexMid'>
                                    <p class='score'>4.8<span class='total'>/5</span></p>
                                </div>
                                <div class='commodityStar'><img src='../images/rankBoard/starMask.png' alt='星等'>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>";
        $html .= "<div class='LeaderboardNo3'>
                    <a href='showItem.html'>
                        <div class='Leaderboarditem No3'>
                            <div class='LeaderboarCountry'>
                                <img src='{$row[2]["nation"]}' alt='排行國家'>
                            </div>
                            <div class='commodity'>
                                <img src='{$row[2]["snackPic"]}' alt='產品圖'>
                                <h4 class='commodityTitle'>[{$row[2]["nation"]}]{$row[2]["snackName"]}</h4>
                                <div class='flexMid'>
                                    <p class='score'>4.8<span class='total'>/5</span></p>
                                </div>
                                <div class='commodityStar'><img src='../images/rankBoard/starMask.png' alt='星等'>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>";
        echo $html;   
      }	
  }
}catch(PDOException $e){
  echo $e->getMessage();
}
?>