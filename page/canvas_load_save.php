<?php
$upload_dir = "..//images//member//cus//box//";
if( ! file_exists($upload_dir ))
  mkdir($upload_dir);
if(isset($_POST['myImage'])  && $_POST['myImage']!=""){
  $img = $_POST['myImage'];
  $img = str_replace('data:image/png;base64,', '', $img);
  // $img = str_replace(' ', '+', $img);
  $data = base64_decode($img);
  $fileName = date("Ymd");
  $file = $upload_dir . $fileName . ".png";
  $success = file_put_contents($file, $data);
  echo $success ? $file : 'Unable to save the file.';
}

?>

<?php
$upload_dir = "..//images//member//cus//card//";
if( ! file_exists($upload_dir ))
  mkdir($upload_dir);
if(isset($_POST['myCard']) && $_POST['myCard']!=""){
  $img = $_POST['myCard'];
  $img = str_replace('data:image/png;base64,', '', $img);
  // $img = str_replace(' ', '+', $img);
  $data = base64_decode($img);
  $fileName = date("Ymd");
  $file = $upload_dir . $fileName . ".png";
  $success = file_put_contents($file, $data);
  // echo $success ? $file : 'Unable to save the file.';
  echo $success ? $file : 'wtf';
}

?>