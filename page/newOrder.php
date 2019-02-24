<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/newOrder.css">
    <title>Document</title>
</head>

<body>

    <div class="tabPanel " id="tab-2">
        <div class="order">
            <!-- -------------------------訂單---------------------------------------- -->
            <div class="orderList">
                <table>

                    <tr>
                        <th>訂單編號:</th>
                        <td>1</td>
                    </tr>
                    <tr>
                        <th>下單日期：</th>
                        <td>2019-02-01</td>
                    </tr>
                    <tr>
                        <th>付款方式：</th>
                        <td>貨到付款</td>
                    </tr>
                    <tr>
                        <th>出貨狀態：</th>
                        <td>已送達</td>
                    </tr>


                </table>
                <table>
                    <tr>
                        <th>收件人地址:</th>
                        <td>桃園中壢資策會</td>
                    </tr>
                    <tr>
                        <th>收件人電話：</th>
                        <td>0</td>
                    </tr>


                </table>

            </div>
            <div class="total">
                <p>總額：0</p>
            </div>
            <!-- ----------------------------訂單明細------------------------------- -->
            <div class="orderitem">
                <p class="orderList_btn">訂單明細v</p>
                <div class=line></div>
                <!-- ----------------------------訂單明細內容------------------------------- -->
                <div class="orderLis_content">
                    <table class="orderList_items">
                        <tr>
                            <th>商品</th>
                            <th>品名</th>
                            <th>數量</th>
                            <th>單價</th>
                            <th>小計</th>
                            <th>備註</th>
                            <th>評價狀態</th>

                        </tr>
                        <tr class="orderList_moreItems item01">
                            <td>
                                <img src="../images/index/co2.png" alt="商品圖">
                            </td>
                            <td>uuu巧克力</td>
                            <td>1</td>
                            <td>70</td>
                            <td>70</td>
                            <td>一般</td>
                            <td>
                                <button class="orderList_eva cart">未評價</button>
                            </td>
                        </tr>
                        <tr class="orderList_moreItems item02">
                            <td>
                                <img src="../images/index/co2.png" alt="商品圖">
                            </td>
                            <td>雷神巧克力</td>
                            <td>2</td>
                            <td>45</td>
                            <td>90</td>
                            <td>客製</td>
                            <td>
                                <button class="orderList_eva cart">未評價</button>
                            </td>
                        </tr>

                    </table>
                    <form action="" class="eva_lightBox">
                        <span class="eva_lightBox_leave">x</span>
                        <table class="eva_lightBox_Box01">
                            <tr>
                                <td>
                                    <div class="evaContent proPic">
                                        <img src="../images/index/co2.png" alt="商品圖">
                                    </div>
                                    <p>uuu巧克力</p>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <ul class="eva_lightBox_stars">
                                        <li>
                                            <p>
                                                甜度：
                                                <ul class="eva_lightBox_swStars">
                                                    <li>
                                                        1星 <input type="radio" name="swStar">
                                                    </li>
                                                    <li>
                                                        2星 <input type="radio" name="swStar">
                                                    </li>
                                                    <li>
                                                        3星 <input type="radio" name="swStar">
                                                    </li>
                                                    <li>
                                                        4星 <input type="radio" name="swStar">
                                                    </li>
                                                    <li>
                                                        5星 <input type="radio" name="swStar">
                                                    </li>
                                                </ul>
                                            </p>
                                        </li>
                                        <li>
                                            <p>
                                                酸度：
                                                <ul class="eva_lightBox_suStars">
                                                    <li>
                                                        1星 <input type="radio" name="suStar">
                                                    </li>
                                                    <li>
                                                        2星 <input type="radio" name="suStar">
                                                    </li>
                                                    <li>
                                                        3星 <input type="radio" name="suStar">
                                                    </li>
                                                    <li>
                                                        4星 <input type="radio" name="suStar">
                                                    </li>
                                                    <li>
                                                        5星 <input type="radio" name="suStar">
                                                    </li>
                                                </ul>
                                            </p>
                                        </li>
                                        <li>
                                            <p>
                                                辣度：
                                                <ul class="eva_lightBox_spStars">
                                                    <li>
                                                        1星 <input type="radio" name="spStar">
                                                    </li>
                                                    <li>
                                                        2星 <input type="radio" name="spStar">
                                                    </li>
                                                    <li>
                                                        3星 <input type="radio" name="spStar">
                                                    </li>
                                                    <li>
                                                        4星 <input type="radio" name="spStar">
                                                    </li>
                                                    <li>
                                                        5星 <input type="radio" name="spStar">
                                                    </li>
                                                </ul>
                                            </p>
                                        </li>
                                        <li>
                                            <p>
                                                好評度：
                                                <ul class="eva_lightBox_gdStars">
                                                    <li>
                                                        1星 <input type="radio" name="gdStar">
                                                    </li>
                                                    <li>
                                                        2星 <input type="radio" name="gdStar">
                                                    </li>
                                                    <li>
                                                        3星 <input type="radio" name="gdStar">
                                                    </li>
                                                    <li>
                                                        4星 <input type="radio" name="gdStar">
                                                    </li>
                                                    <li>
                                                        5星 <input type="radio" name="gdStar">
                                                    </li>
                                                </ul>
                                            </p>
                                        </li>
                                    </ul>

                                </td>

                            </tr>
                            <tr>
                                <td>
                                    <p>留言分享</p>
                                    <textarea name="textDiscuss" cols="30" rows="10"
                                        class="eva_lightBox_textDics"></textarea>
                                </td>

                            </tr>
                            <tr>
                                <td>
                                    <div class="proPicBox">
                                        <img id="proPic" src="../images/index/co2.png">
                                    </div>



                                    <label class="evaproPic" for="upFile">

                                        <p class="cart">上傳圖檔
                                        </p>
                                        <input type="file" name="upFile" id="upFile">


                                    </label>
                                    <div class="evaContent evaSend">
                                        <button class="step">確認送出</button>
                                    </div>
                                </td>
                            </tr>

                        </table>
                    </form>

                </div>

            </div>

        </div>







    </div>

    </div>


    </div>


    <!------------------- older ------------- -->
     <!-- <div class="tabPanel " id="tab-2">
     <?php 
                //先抓出訂單資料
                // $order_sql= "select * from snackOrder where memNo=:memNo";
                // $order = $pdo->prepare($order_sql);
                // $order->bindValue(":memNo", $memNo);
                // $order->execute();
                // if ($order->rowCount() ==0 ) {
                //         echo "您目前尚無訂單！";
                //  }else{
                //     while($orderRow = $order->fetch(PDO::FETCH_ASSOC)){
                //         $orderNo = $orderRow['orderNo'];
                 
             ?>

                <div id="orderList">

                    <div class="orderList">
                        <table>

                            <tr>
                                <th>訂單編號:</th>
                                <td><?php echo $orderRow['orderNo'] ?></td>
                            </tr>
                            <tr>
                                <th>下單日期：</th>
                                <td><?php echo $orderRow['orderTime'] ?></td>
                            </tr>
                            <tr>
                                <th>付款方式：</th>
                                <td><?php echo $orderRow['payWay'] ?></td>
                            </tr>
                            <tr>
                                <th>出貨狀態：</th>
                                <td><?php echo $orderRow['orderStatus'] ?></td>
                            </tr>


                        </table>
                        <table>
                            <tr>
                                <th>收件人地址:</th>
                                <td><?php echo $orderRow['address'] ?></td>
                            </tr>
                            <tr>
                                <th>收件人電話：</th>
                                <td><?php echo $orderRow['phone'] ?></td>
                            </tr>


                        </table>

                    </div>
                    <div class="total">
                        <p>總額：<span><?php echo $orderRow['orderTotal'] ?></span></p>
                    </div>

                    <div id="listMore">
                        <p id="listMorebtn" class="listplay_1" >訂單明細v</p>

                        <div class=line></div>

                        <div id="proEva" class="orderItem">
                            <table class="orderItemList">
                                <tr>
                                    <th>商品</th>
                                    <th>品名</th>
                                    <th>數量</th>
                                    <th>單價</th>
                                    <th>小計</th>
                                    <th>備註</th>
                                    <th>評價狀態</th>
                                </tr>
                        <?php 
                        //     $br="<br>";
                        //   $OL_sql= "select a.snackNo, a.snackName, a.snackPic, a.snackPrice, b.orderNo, b.snackQuan, b.customBoxItem, b.snackNo from snack a join orderItem b on a.snackNo = b.snackNo where orderNo=:orderNo";
                        //   $order_list =$pdo->prepare($OL_sql);
                        //   $order_list->bindValue(":orderNo",$orderNo);
                        //   $order_list->execute();

                        //   $order_listArr = $order_list->fetchAll(PDO::FETCH_ASSOC);
                        //   $OLrowcount = $order_list->rowCount(); 
                        //   print_r($order_listRow);
                        //   print_r($order_listArr);
                        //   echo $OLrowcount."<br>" ;
                        //   echo count($order_listArr).$br;

                        // for($i=0;$i<$OLrowcount;$i++){
                        //     echo $order_listArr[$i]["snackName"].$br;
                        // }
                        

                        //   for($i=0;$i<$OLrowcount;$i++){
                            
                        
                    ?>
                                <tr class="listeva">
                                    <td>
                                        <img src="<" alt="商品圖">
                                    </td>
                                    <td>
                                        <?php echo $order_listArr[$i]['snackName'] ?>
                                    </td>
                                    <td><</td>
                                    <td></td>
                                    <td>>
                                    </td>
                                    <td>客製化</td>
                                    <td>
                                        <button id="evaShow" class="cart evaShowbtn">未評價</button>
                                    </td>
                                </tr>  
                            </div>  
                                    <?php 
                                
                                    }
                            
                                    ?>
                       
                            </table>
                           
                           
                            <div id="evaBox" class="evaLightBox">
                                <span class="evaLightBoxLeave">X</span>
                                <div class="evaLightBox_content">
                                    <div class="evaContent proPic">
                                        <img src="<?php echo $order_listArr[$i]['snackPic']?>" alt="商品圖">
                                        <p><?php echo $order_listArr[$i]['snackName']?></p>
                                    </div>
                                    <div class="evaContent evaStars">
                                        <ul>
                                            <li>
                                                <p>
                                                    甜度：
                                                    <ul class="swStars">
                                                        <li>
                                                            1星<input type="checkbox" name="swStar" id="swStar1">
                                                        </li>
                                                        <li>
                                                            2星<input type="checkbox" name="swStar" id="swStar2">

                                                        </li>
                                                        <li>
                                                            3星<input type="checkbox" name="swStar" id="swStar3">

                                                        </li>
                                                        <li>
                                                            4星<input type="checkbox" name="swStar" id="swStar4">

                                                        </li>
                                                        <li>
                                                            5星<input type="checkbox" name="swStar" id="swStar5">

                                                        </li>
                                                    </ul>
                                                     <span><img src="../images/rankBoard/starMask3.png" alt="星等"></span> -->
                                                <!-- </p>
                                            </li>
                                            <li>
                                                <p>
                                                    酸度：
                                                    <ul class="suStars">
                                                        <li>
                                                            1星<input type="checkbox" name="suStar" id="suStar1">
                                                        </li>
                                                        <li>
                                                            2星<input type="checkbox" name="suStar" id="suStar2">

                                                        </li>
                                                        <li>
                                                            3星<input type="checkbox" name="suStar" id="suStar3">

                                                        </li>
                                                        <li>
                                                            4星<input type="checkbox" name="suStar" id="suStar4">

                                                        </li>
                                                        <li>
                                                            5星<input type="checkbox" name="" id="suStar5">

                                                        </li>
                                                    </ul> -->
                                                    <!-- <span><img src="../images/rankBoard/starMask3.png" alt="星等"></span>
                                                </p>
                                            </li>
                                            <li>
                                                <p>
                                                    辣度：
                                                    <ul class="spStars">
                                                        <li>
                                                            1星<input type="checkbox" name="spStar" id="spStar1">
                                                        </li>
                                                        <li>
                                                            2星<input type="checkbox" name="spStar" id="spStar2">

                                                        </li>
                                                        <li>
                                                            3星<input type="checkbox" name="spStar" id="spStar3">

                                                        </li>
                                                        <li>
                                                            4星<input type="checkbox" name="spStar" id="spStar4">

                                                        </li>
                                                        <li>
                                                            5星<input type="checkbox" name="spStar" id="spStar5">

                                                        </li>
                                                    </ul>
                                                 <span><img src="../images/rankBoard/starMask3.png" alt="星等"></span> 
                                                </p>
                                            </li>
                                            <li>
                                                <p>
                                                    好評度：
                                                    <ul class="gdStars">
                                                        <li>
                                                            1星<input type="checkbox" name="gdStar" id="gdStar1">
                                                        </li>
                                                        <li>
                                                            2星<input type="checkbox" name="gdStar" id="gdStar2">

                                                        </li>
                                                        <li>
                                                            3星<input type="checkbox" name="gdStar" id="gdStar3">

                                                        </li>
                                                        <li>
                                                            4星<input type="checkbox" name="gdStar" id="gdStar4">

                                                        </li>
                                                        <li>
                                                            5星<input type="checkbox" name="gdStar" id="gdStar5">

                                                        </li>
                                                    </ul>
                                                    <span><img src="../images/rankBoard/starMask3.png" alt="星等"></span> 
                                                </p>
                                            </li>

                                        </ul>

                                    </div>
                                    <div class="evaContent discuss">
                                        <p>留言分享</p>
                                        <textarea name="textDiscuss" id="textDiscuss" cols="30" rows="10" class="textDics"></textarea>
                                    </div>
                                    <div class="evaContent evaPro">

                                        <div class="proPicBox">
                                            <img id="proPic" src="../images/index/co2.png">
                                        </div>



                                        <label class="evaproPic" for="upFile">

                                            <p class="cart">上傳圖檔
                                            </p>
                                            <input type="file" name="upFile" id="upFile">


                                        </label>
                                        <div class="evaContent evaSend">
                                            <button class="step">確認送出</button>
                                        </div>
                                    </div>
                                </div>
                            
                        </div>


                           
                    </div>
                   
                </div> 
                <?php 

                   }  
                }
                ?>

            </div> 

             <div class="tabPanel " id="tab-2">
        <div class="order">

</body>

</html>