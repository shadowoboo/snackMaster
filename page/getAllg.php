<?php

try{
  require_once("connectcd105g2.php");
  $sql = "select * from masell ";
  $AllgRows = $pdo->query($sql);
    
  class GData{//這是正常的請忽略這個錯誤
      public $lat;
      public $lng;
      public $map;
      public $title;
  };

  $gDataRows=[];
  while($gRow=$AllgRows->fetch()){
    $gData =new GData();
    // $gData->position='{lat:'.$gRow['maLnge'].',lng:'.$gRow['maLat'].'}';
    $gData->lat=$gRow['maLnge'];
    $gData->lng=$gRow['maLat'];
    $gData->map='map';
    $gData->title=$gRow['maAdd'];
    $gDataRows[]=$gData;
  };


  echo json_encode($gDataRows);

}catch(PDOException $e){
  echo $e->getMessage();
}
?>