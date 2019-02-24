<?php
    session_start();
    $errMsg="";
    try {
        if(isset($_SESSION["snackName"])){ //檢查有沒有 snackNo 存在於 session 之中
            //如果只有"客製關聯商品"但是沒有"客製箱本身"=>不是真的客製箱=>刪除"客製關聯商品"避免衝突
            if(isset($_SESSION["note"][1])){
                if(in_array("box",$_SESSION["note"][1])==false && in_array("cus",$_SESSION["note"][1])==true){
                    unset($_SESSION["snackName"][1]);
                    unset($_SESSION["snackPrice"][1]);
                    unset($_SESSION["note"][1]);
                    unset($_SESSION["snackQuan"][1]);
                    unset($_SESSION["snackPic"][1]);
                    unset($_SESSION["cusBox"]);
                    unset($_SESSION["cusCard"]);
                    unset($_SESSION["cusSound"]);
                    //如果session都沒有商品
                    if (count($_SESSION["snackQuan"])<1) {
                        unset($_SESSION["snackName"]);
                        unset($_SESSION["snackPrice"]);
                        unset($_SESSION["note"]);
                        unset($_SESSION["cusType"]);
                        unset($_SESSION["snackQuan"]);
                        unset($_SESSION["snackPic"]);
                    }
                    //清空商品後再確認一次還有沒有商品
                    if(isset($_SESSION["snackName"])){
                        echo "prodExist";
                    }else{
                        echo "error";
                    }
                }else{
                    echo "prodExist";
                }
            }else{
                //知之為知之
                echo "prodExist";
            }
        }else{
            //一言不合就error
            echo "error";
        }
    } catch (PDOException $e) {
        //throw $th;
        $errMsg .= "錯誤 : ".$e -> getMessage()."<br>";
        $errMsg .= "行號 : ".$e -> getLine()."<br>";
        echo $errMsg;
    }