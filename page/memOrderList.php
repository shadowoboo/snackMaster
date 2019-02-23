<?php 
    session_start();
    
    try{
        require_once("connectcd105g2.php");
        $sql = "SELECT * from snackorder JOIN orderitem on snackorder.orderNo = orderitem.orderNo where memNo=:memNo";
        $order = $pdo->prepare($sql);
        $order->bindValue(":memNo",$_REQUEST("memNo"));
        $order->execute();

        
        if ($order->rowCount() ==0 ) {
            echo "您目前尚無訂單！";
        }else{
            //先抓取訂單基本資料
            $html="";
            while($orderRow = $order->fetch(PDO::FETCH_ASSOC) ){
                //送出html結構字串
                $html =
                    "<table>

                        <tr>
                            <th>訂單編號:</th>
                            <td>{$orderRow['orderNo']}</td>
                        </tr>
                        <tr>
                            <th>下單日期：</th>
                            <td>{$orderRow['orderTime']}</td>
                        </tr>
                        <tr>
                            <th>付款方式：</th>
                            <td>{$orderRow['payWay']}</td>
                        </tr>
                        <tr>
                            <th>出貨狀態：</th>
                            <td>{$orderRow['orderStatus']}</td>
                        </tr>


                    </table>
                    <table>
                        <tr>
                            <th>收件人地址:</th>
                            <td>{$orderRow['address']}</td>
                        </tr>
                        <tr>
                            <th>收件人電話：</th>
                            <td>{$orderRow['phone']}</td>
                        </tr>
                        
                </table>";
                echo $html;
            }

            //在抓取訂單明細裡的資訊

        
        }
    


    }catch(PDOException $e){
        echo "失敗",$e->getMessage();
        echo "行號",$e->getLine();
        // echo "QQ";

    }


?>