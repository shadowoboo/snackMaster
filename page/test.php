<?php
// $psn = $_REQUEST["psn"];
    // $errMsg = "";
    // try{
    //     require_once("connectcd105g2.php");
    //     $sql = "select * from msg where msgNo = ?";
    //     $products = $pdo->prepare($sql);
    //     $products->bindValue(1, 1);
    //     $products->execute();
    // }catch(PDOException $e){
    //     $errMsg .= "錯誤原因 : ".$e -> getMessage(). "<br>";
    //     $errMsg .= "錯誤行號 : ".$e -> getLine(). "<br>";
    // }

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/"
        crossorigin="anonymous">
    <link rel="stylesheet" href="../css/loginBox.css">
    <link rel="stylesheet" href="../css/header.css">
    <script src="../js/jquery-3.3.1.min.js"></script>

</head>
<body>
    <?php
        require_once"loginBox_test_shadow.php";
    ?>
    <script src="../js/header.js" ></script>



    <script>
        $(document).ready(function () {
            $("#btnLogin").click(function(){
                console.log($("#loginMemId").val());
                console.log($("#loginMemPsw").val());
                
                let data={
                    loginMemId:$("#loginMemId").val(),
                    loginMemPsw:$("#loginMemPsw").val()
                };
                $.get("login_cy.php",data,loginResponse);
            })
        });

        function loginResponse(data,status){
            if(data=="ok"){
                alert("OKKK!!");
            }
        }

        
    </script>
</body>
</html>