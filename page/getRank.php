<?php
try{
  require_once("connectcd105g2.php");
//   if($_REQUEST["category"] === '綜合'){
//     // $sql = "select * from snack order by goodStars desc limit 3";
//     $sql="SELECT  s.`snackNo` snackNo,s.`nation` nation,s.`snackName` snackName,s.`snackPic` snackPic,r.`ranking` ranking, AVG(`goodstar`) avg from `snack` s,`rank` r, `eva` e WHERE s.snackNo=r.snackNo AND r.`rankGenre`='綜合' AND s.`snackNo`=e.`snackNo` GROUP BY e.snackNo";
//     $prodRow = $pdo->prepare( $sql );
//     // $prodRow->bindValue(":category", $_REQUEST["category"]);
//     $prodRow->execute();
//     $evaRow = $pdo->query($sql);
//     if( $prodRow->rowCount() == 0 ){ //找不到
//         //傳回空的JSON字串
//         echo "<center>此商品暫無評價</center>";
//       }else{ //找得到
           
//         //送出html結構字串
//         $html = '';
//         $row = $prodRow->fetchAll();
//         // ?snackNo={$row[1]["snackNo"]}
//         $html .= "<div class='LeaderboardNo2'>
//                         <a href='showItem.html'>
//                             <div class='Leaderboarditem No2'>
//                                 <div class='LeaderboarCountry'>
//                                     <img src='../images/blair/{$row[1]["nation"]}.png' alt='排行國家'>
//                                 </div>
//                                 <div class='commodity'>
//                                     <img src='{$row[1]["snackPic"]}' alt='產品圖'>
//                                     <h4 class='commodityTitle'>[{$row[1]["nation"]}]{$row[1]["snackName"]}</h4>
//                                     <div class='flexMid'>
//                                         <p class='score'>{$row[1]["avg"]}<span class='total'>/5</span></p>
//                                     </div>
//                                     <div class='commodityStar'><img src='../images/rankBoard/starMask.png' alt='星等'>
//                                     </div>
//                                 </div>
//                             </div>
//                         </a>
//                   </div>"; 
//         $html .= "<div class='LeaderboardNo1'>
//                     <a href='showItem.html'>
//                         <div class='Leaderboarditem No1'>
//                             <div class='LeaderboarCountry'>
//                                 <img src='../images/blair/{$row[0]["nation"]}.png' alt='排行國家'>
//                             </div>
//                             <div class='commodity'>
//                                 <img src='{$row[0]["snackPic"]}' alt='產品圖'>
//                                 <h4 class='commodityTitle'>[{$row[0]["nation"]}]{$row[0]["snackName"]}</h4>
//                                 <div class='flexMid'>
//                                     <p class='score'>{$row[0]["avg"]}<span class='total'>/5</span></p>
//                                 </div>
//                                 <div class='commodityStar'><img src='../images/rankBoard/starMask.png' alt='星等'>
//                                 </div>
//                             </div>
//                         </div>
//                     </a>
//                 </div>";
//         $html .= "<div class='LeaderboardNo3'>
//                     <a href='showItem.html'>
//                         <div class='Leaderboarditem No3'>
//                             <div class='LeaderboarCountry'>
//                                 <img src='../images/blair/{$row[2]["nation"]}.png' alt='排行國家'>
//                             </div>
//                             <div class='commodity'>
//                                 <img src='{$row[2]["snackPic"]}' alt='產品圖'>
//                                 <h4 class='commodityTitle'>[{$row[2]["nation"]}]{$row[2]["snackName"]}</h4>
//                                 <div class='flexMid'>
//                                     <p class='score'>{$row[2]["avg"]}<span class='total'>/5</span></p>
//                                 </div>
//                                 <div class='commodityStar'><img src='../images/rankBoard/starMask.png' alt='星等'>
//                                 </div>
//                             </div>
//                         </div>
//                     </a>
//                 </div>";
//         echo $html;   
//       }	

//   }else{

    //   $sql = "select * from snack where snackGenre = :category order by goodStars desc limit 3";
      $sql = "SELECT * FROM `rank`,`snack` WHERE `rankGenre` LIKE :category AND `rank`.`snackNo`=`snack`.`snackNo` ORDER BY ranking limit 0,3";
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
        $sql0="SELECT * FROM `snack` WHERE `snackNo`='{$row[0]['snackNo']}' ";
        $sql1="SELECT * FROM `snack` WHERE `snackNo`='{$row[1]['snackNo']}' ";
        $sql2="SELECT * FROM `snack` WHERE `snackNo`='{$row[2]['snackNo']}' ";
        $prodRow = $pdo->query($sql0);
        $row0=$prodRow->fetch();
        $prodRow = $pdo->query($sql1);
        $row1=$prodRow->fetch();
        $prodRow = $pdo->query($sql2);
        $row2=$prodRow->fetch();

        $rank0 = round($row0['goodStars']/$row0['goodTimes'],1);
        $rank1 = round($row1['goodStars']/$row1['goodTimes'],1);
        $rank2 = round($row2['goodStars']/$row2['goodTimes'],1);
        
        $html .= "<div class='LeaderboardNo2'>
                        <a href='showItem.php?snackNo={$row1["snackNo"]}'>
                            <div class='Leaderboarditem No2'>
                                <div class='LeaderboarCountry'>
                                    <img src='../images/blair/{$row1["nation"]}.png' alt='排行國家'>
                                </div>
                                <div class='commodity'>
                                    <img src='{$row1["snackPic"]}' alt='產品圖'>
                                    <h4 class='commodityTitle'>[{$row1["nation"]}]{$row1["snackName"]}</h4>
                                    <div class='flexMid'>
                                        <p class='score'>{$rank1}<span class='total'>/5</span></p>
                                    </div>
                                    <div class='star' grad={$rank1}>
                                        <img src='../images/rankBoard/starMask.png' alt='星等'>
                                    </div>
                                </div>
                            </div>
                        </a>
                  </div>"; 
        $html .= "<div class='LeaderboardNo1'>
                        <a href='showItem.php?snackNo={$row0["snackNo"]}'>
                        <div class='Leaderboarditem No1'>
                            <div class='LeaderboarCountry'>
                                <img src='../images/blair/{$row0["nation"]}.png' alt='排行國家'>
                            </div>
                            <div class='commodity'>
                                <img src='{$row0["snackPic"]}' alt='產品圖'>
                                <h4 class='commodityTitle'>[{$row0["nation"]}]{$row0["snackName"]}</h4>
                                <div class='flexMid'>
                                    <p class='score'>{$rank0}<span class='total'>/5</span></p>
                                </div>
                                <div class='star' grad={$rank0}>
                                    <img src='../images/rankBoard/starMask.png' alt='星等'>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>";
        $html .= "<div class='LeaderboardNo3'>
                    <a href='showItem.php?snackNo={$row2["snackNo"]}'>
                        <div class='Leaderboarditem No3'>
                            <div class='LeaderboarCountry'>
                                <img src='../images/blair/{$row2["nation"]}.png' alt='排行國家'>
                            </div>
                            <div class='commodity'>
                                <img src='{$row2["snackPic"]}' alt='產品圖'>
                                <h4 class='commodityTitle'>[{$row2["nation"]}]{$row2["snackName"]}</h4>
                                <div class='flexMid'>
                                    <p class='score'>{$rank2}<span class='total'>/5</span></p>
                                </div>
                                <div class='star' grad={$rank2}>
                                    <img src='../images/rankBoard/starMask.png' alt='星等'>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>";
        echo $html;   
      }	
//   }
}catch(PDOException $e){
  echo $e->getMessage();
}
?>



