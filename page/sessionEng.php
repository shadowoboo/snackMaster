<?php
    session_start();
    ob_start();
    $br="<br>";
    echo "<h1>SESSION CHECK</h1>" . $br;
    if (isset($_SESSION)==false) {
        echo "<h2 class='none'>-- NO SESSION ITEM --</h2>".$br;
        return;
    } else {
        echo "<h2 class='yap'>-- SESSION 有值 有亮 有多聞 ! --</h2>".$br;
    }
?>
<!-- <button class="autoReload">Auto Reload</button> -->
<button class="clearSession" id="clearSession">clear PHP session</button>
<?php
    // echo print_r($_SESSION).$br;
    // while (list($key, $val) = each($_SESSION)) {
    //     echo $key.$br;
    // }
    $i=1; //大
    $j=1; //中
    $k=1; //小
    echo "<div class='wrap'>";
    foreach ((array)$_SESSION as $key1 => $value1) {
        echo "<div class='aa'>";
        echo "<h3>--$key1--</h3>".$br;
        foreach ((array)$value1 as $key2 => $value2) {
            switch ($key2) {
                case 0:
                    $str2="一般";
                    break;
                case 1:
                    $str2="客製";
                    break;
                case 2:
                    $str2="即期";
                    break;
                case 3:
                    $str2="預購";
                    break;
                default:
                    $str2="TYPE";
                    break;
            }
            echo "------$str2----".$key2.$br;
            foreach ((array)$value2 as $key3=>$value3) {
                echo "----------KEY3------#".$key3;
                echo "--".$value3.$br;
                $k++;
            }
            $j++;
        }
        echo $br.$br;
        $i++;
        echo "</div>";
    }

    echo "key1 count: ".$i.$br;
    echo "key2 count: ".$j.$br;
    echo "key3 count: ".$k.$br;
    echo "</div>";
?>

<?php


?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="../js/jquery-ui.min.js"></script>
<script>
    $(".aa").draggable();
    // $(".autoReload").on("click",function(e){
    //     // window.location.reload();
    //     if($(e.target).text()=="Auto Reload"){
    //         $(e.target).text("Reloading~");
    //         var re=self.setInterval(function(){
    //             window.location.reload();
    //         },1000);
    //     }else{
    //         $(e.target).text("Auto Reload");
    //         re=window.clearInterval(re);
    //     }
        
    // })
</script>
<script language="JavaScript">
    function myrefresh(){
        window.location.reload();
    }
    setTimeout('myrefresh()',1000); //指定1秒刷新一次
</script>
<script>
$("#clearSession").click(function () {
        $.ajax({
            url: "clearSession_ENG.php",
            success: function (response) {
                console.log(response);
            }
        });
        $(".engBtnList").removeClass("show");
    })
</script>
<style>
    .wrap{
        display:flex;
        flex-wrap:wrap;
        margin: 10px;
    }
    .aa{
        margin: 10px;
    }
    .yap{
        background-color:#afa;
    }
    .none{
        background-color:#faa;
    }
</style>
