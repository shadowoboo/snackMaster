<?php 
    session_start();
    //  $_REQUEST["memUPdata"]
    //表單接受適用input,所以每個欄位要有input

    try{
        require_once('connectcd105g2.php');
        if($_FILES['upFile']["name"]==""){
            $sql = "update member set  memId=:memId, memPsw=:memPsw, memName=:memName, memPhone=:memPhone, email=:email where memNo=:memNo";
        }else{
            $sql = "update member set  memId=:memId, memPsw=:memPsw, memName=:memName, memPhone=:memPhone, email=:email, memPic=:memPic where memNo=:memNo";
        }
        $memUp = $pdo->prepare($sql);
        $memUp ->bindValue(":memNo",$_POST["memNo"]);
        $memUp ->bindValue(":memId",$_POST["memId"]);

        // $memUp ->bindValue(":memPic",$_FILES["upFile"]);
        $memUp ->bindValue(":memPsw",$_POST["memPsw"]);
        $memUp ->bindValue(":memName",$_POST["memName"]);
        $memUp ->bindValue(":memPhone",$_POST["phone"]);//$_POST["name"]->放input裡name="值"
        $memUp ->bindValue(":email",$_POST["email"]);
        if($_FILES['upFile']["name"]!=""){
            $memUp ->bindValue(":memPic",'../images/member/'.$_FILES['upFile']["name"]);
        }
        $memUp ->execute();

        // $mdRow = $mdMem ->fetch(PDO::FETCH_ASSOC);  
        switch($_FILES["upFile"]["error"]){
            case UPLOAD_ERR_OK:
		//檢查是否有images資料夾
		if( file_exists("images") === false){
			//建立資料夾 make directory
			mkdir("images");
		}

		$from = $_FILES['upFile']['tmp_name'];
		$to = "../images/member/{$_FILES['upFile']['name']}";
		copy($from, $to);        //新增修改後的資料
        
        echo "OK";
        $_SESSION["memPic"]= '../images/member/'.$_FILES['upFile']["name"];
		break;
	    case UPLOAD_ERR_INI_SIZE:
		echo "上傳檔案太大,不得超過: ", ini_get("upload_max_filesize"), "<br>";
		break;  
	    case UPLOAD_ERR_FORM_SIZE:
		echo "上傳檔案太大 <br>";
		break;
	    case UPLOAD_ERR_PARTIAL:
		echo "上傳資料有問題，請重送<br>";
		break;
	    case UPLOAD_ERR_NO_FILE:
	    echo "未選檔案<br>";
		break;
	    default : 
		echo "['error']: " , $_FILES['upFile']['error'] , "<br>";
        }


        echo "OK";

        header("Location:member.php");




    }catch(PDOException $e){
        echo "失敗",$e->getMessage();
        echo "行號",$e->getLine();
        // echo "QQ";

    }




?>


