<?php
    $errMsg = "";
    $search= $_REQUEST['search'];
    try {
        require_once("blairConnect.php");
        $sql = "select * from snack where snackName != '客製箱' $search limit 0, 9";
        $snacks = $pdo->query($sql); 
        if( $snacks -> rowCount() == 0){
            echo 'oops';
        }else{
            
        }





    } catch (PDOException $e) {
        $errMsg .= "錯誤 : ".$e -> getMessage()."<br>";
        $errMsg .= "行號 : ".$e -> getLine()."<br>";
    }
?>