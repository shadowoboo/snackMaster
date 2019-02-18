<?php
session_start();
// echo $_REQUEST["snackName"];
// echo $_REQUEST["snackDataName"];

// $_SESSION["snackName"]=array();
// $_REQUEST["snackName"]
try{
require_once("connectcd105g2.php");
$sql = "select * from snack where snackNo=:snackNo";
$snack = $pdo->prepare( $sql );
// $snack -> bindValue( ":snackName", $_REQUEST["snackName"]);
$snack -> bindValue( ":snackNo", $_REQUEST["snackDataName"]);
$snack -> execute();

if( $snack->rowCount()==0){ //查無此
echo "error";
}else{ //
//自資料庫中取回資料
$snackRow = $snack -> fetch(PDO::FETCH_ASSOC);

//將資料寫入session
// $_SESSION["snackName"] = $snackRow["snackName"];
// $_SESSION["snackName"] = $snackRow["snackName"];
// array_push($_SESSION["snackName"],$snackRow["snackName"]);
if(isset($_SESSION["snackNo"])){
    $ln=count($_SESSION["snackNo"]);
    $_SESSION["snackNo"][$ln] = $snackRow["snackNo"];
    
}else{
    $_SESSION["snackNo"][0]=$snackRow["snackNo"];
}



echo $snackRow["snackNo"];

// echo $snackRow["snackNo"];
// for($i=0;$i<$ln; $i++){
//     $c = $_REQUEST["snackNo"];
//     if(array_key_exists($c, $_SESSION["snackNo"])){
//         $_SESSION["snackNo"][$c] = $_SESSION["snackNo"][$c] +1;
//         //$_SESSION["snackNo"][$c]++;
//     }else{
//         $_SESSION["snackNo"][$c] = 1;
//     }
// }




// echo "ok";
}
}catch(PDOException $e){
// echo "error";
echo $e->getMessage();
}
?>