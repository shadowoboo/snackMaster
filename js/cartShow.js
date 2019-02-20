$(function () {
    //不用快取，確保抓到最新的資料
    $.ajaxSetup({ cache: false });
    //表單付款方式提示
    //目前利用html的checked預設為信用卡
    //點擊label切換
    $(".payTypeItem").on("click", function (e) {
        $(".payTypeItem").removeClass("checked");
        $(this).addClass("checked");
    })

    //小計初始化
    //預設所有商品初始數量皆為1，php讀進來就順便代入原始價錢

    //客製箱的總計初始化
    priceTotalCus();

    //優惠卷初始化
    //同步處理，避免 priceTotal 計算總額錯誤
    getCoupon();

    //總計初始化
    priceTotal();

    //刪除按鈕們控制
    //刪除客製箱
    $(".cusBtnDel").bind("click",function(e){
        //刪除客製箱節點
        $(".prodCard.prodCard_Group").remove();
        //刪除php session的客製箱訊息
        clearCusSession();
        //更新總計
        priceTotal();
        //如果刪光光，顯示 "無商品提醒"
        if ($("#prodCards").children().length==0){
            //隱藏商品卡
            $(".cartContent_prod").removeClass("cartPageActive");
            //隱藏 cartPanel 小計跟優惠卷
            $(".cartPanel").removeClass("cartPageActive");
            //顯示 footer
            $("footer").show();
            //顯示 "無商品提醒"
            $(".cartContent_none").addClass("cartPageActive");
        }
    })
    //刪除一般卡片
    $(".trash").bind("click",function(e){
        $(this).closest(".prodCard.prodCard_normal").remove();
        //刪除php session的normal訊息
        clearNormalSession(e);
        //更新總計
        priceTotal();
        //如果刪光光，顯示 "無商品提醒"
        if ($("#prodCards").children().length == 0) {
            //隱藏商品卡
            $(".cartContent_prod").removeClass("cartPageActive");
            //隱藏 cartPanel 小計跟優惠卷
            $(".cartPanel").removeClass("cartPageActive");
            //顯示 footer
            $("footer").show();
            //顯示 "無商品提醒"
            $(".cartContent_none").addClass("cartPageActive");
        }
    })

    //變更數量
    //嘗試直接監控 input變化，但是oninput, onchange等皆無法監控js改變的值
    //故改監控按鈕並計算補正值
    //減少
    $(".numMinus").bind("click",function(e){
        var snackNo = e.target.dataset.snackno;
        var val=$(this).next().val();
        // console.log(val);
        //因為直接取值會慢實際看到的value一次，故手動補正
        if (snackQuan==1){
            snackQuan=1;
            console.log(snackQuan);
        }else{
            snackQuan=parseInt(val)-1;
            console.log(snackQuan);
        }
        $.ajax({
            type: "get",
            url: "cartUpdate.php",
            data: "updateType=numMinus&snackNo=" + snackNo + "&snackQuan=" + snackQuan,
            success: function (response) {
                console.log(`response:　${response}`);
            }
        });
        //變更小計
        priceSum(e, snackQuan)
        //變更總計
        priceTotal();
        //變更客製箱的總計
        priceTotalCus();
    })
    //增加
    $(".numPlus").bind("click", function (e) {
        var snackNo = e.target.dataset.snackno;
        // var snackPrice = e.target.dataset.snackprice;
        // console.log($(this));
        //因為直接取值會慢實際看到的value一次，故手動補正
        //小心!! 這個input取出的值是字串!!! 相加務必檢查!!
        var val = $(this).prev().val();
        // console.log(val);
        // qty = val+parseInt(1);
        snackQuan = parseInt(val)+ 1;
        console.log(snackQuan);
        //改變session數量
        $.ajax({
            type: "get",
            url: "cartUpdate.php",
            data: "updateType=numPlus&snackNo="+snackNo+"&snackQuan="+snackQuan,
            success: function (response) {
                console.log(`response:　${response}`);
            }
        });
        //變更小計
        priceSum(e, snackQuan);
        //變更總計
        priceTotal();
        //變更客製箱的總計
        priceTotalCus();
    })
    //優惠卷變更時，重新計算總價
    $("#couponItem").bind("change",priceTotal);


    ////function區
    //清除客製箱相關session
    function clearCusSession(e) { 
        $.ajax({
            type: "get",
            url: "cartUpdate.php",
            data:"updateType=cusDel",
            success: function (response) {
                // console.log("done Clear cus session");
                console.log(`response:　${response}`);
            }
        });
    }
    //清除一般卡片session
    function clearNormalSession(e){
        //用 data-* 神秘西方力量取值 (我不想占用id之類的)
        var snackNo = e.target.dataset.snackno;
        console.log(snackNo);
        
        $.ajax({
            type: "get",
            url: "cartUpdate.php",
            data: "updateType=normalDel&snackNo="+snackNo,
            success: function (response) {
                console.log(`response:　${response}`);
            }
        });
    }
    //計算總價並變更總計
    function priceTotal(){
        //變更總計
        var total = 0;
        $(".priceSum").each(function () {
            total += Number(parseInt($(this).text()));
        })
        //扣除優惠卷
        // var couponItem = document.getElementById("couponItem");
        // console.log(`couponItem: ${couponItem.value()}`);
        
        console.log($("#couponItem").val());
        
        if ($("#couponItem").val()){
            total = total - $("#couponItem").val();
        }
        $("#priceTotalContent").text(total);
    }
    //計算客製箱的總價並變更之
    function priceTotalCus() {
        //變更總計
        var total = 0;
        $(".prodCard_Group .priceSum").each(function () {
            total += Number(parseInt($(this).text()));
        })
        $("#cusTotalContent").text(total);
    }
    //變更小計
    function priceSum(e, snackQuan){
        var snackPrice = e.target.dataset.snackprice;
        var priceSum = snackPrice * snackQuan;
        $(e.target).closest(".cardCtrl").children(".prodPriceSum").children("p").children(".priceSum").text(priceSum);
    }
    //優惠卷初始化
    function getCoupon(){
        console.log("coupon gogo");
        
        $.ajax({
            type: "post",
            url: "getCoupon.php",
            async: false, //強迫他 "不是異步" = 同步 = 後面的程式要等這個程式做完
            success: function (response) {
                if(response=="error"){
                    $("#couponItem").html("\<option value=\"未登入\"\>未登入\<\/option\>");
                    console.log(`response="error"`);
                    
                }else if(response=="none"){
                    $("#couponItem").html("<option value=\"\"> </option>");
                    console.log(`response="none"`);

                }else{
                    $("#couponItem").html(response);
                    // console.log(`response="ok"`);
                    console.log(response);
                    

                }
            }
        });
    }
})




$(document).ready(function () {
    $.ajaxSetup({ cache: false });
    //ENG 寫入商品測試用
    // CartProdAdd_ENG();

    //進入cartShow網頁，立刻檢查php session，若沒有商品則顯示 無商品頁面 / footer
    $.ajax({
        type: "get",
        url: "CartProdCheck.php",
        success: function (response) {
            //畫面淨空
            $(".cartContent").removeClass("cartPageActive");
            if (response != "prodExist") { //如果商品還沒加入購物車
                console.log(`response!="prodExist"`);
                //顯示 "未購物提示" 
                $(".cartContent_none").addClass("cartPageActive");
                //顯示 footer
                $("footer").show();
                //預設不顯示其他區塊，所以不再動作
            } else {
                //隱藏 "未購物提示" 
                $(".cartContent_none").removeClass("cartPageActive");
                //隱藏 footer
                $("footer").hide();
                //顯示購物清單
                $(".cartContent_prod").addClass("cartPageActive");
                //顯示流程面板與小計
                $(".cartPanel").addClass("cartPageActive");
            }
        },
        fail: function () {
            alert("ajax fail event");
        }
    });

    //流程控制
    var stepCount = 1;//預設為沒有商品
    //下一步的觸發流程
    $(".panelBtn .btnNext").click(function () {
        switch (stepCount) {
            case 1:
                //登入檢查，未登入則不給下一步
                // console.log(CartStepLoginCheck(function (response){}));
                CartStepLoginCheck(function (response) {
                    console.log(`response: ${response}`);
                    if (response == "error") {
                        return;
                    } else {
                        step2();
                    }
                })
                break;
            case 2:
                //點擊下一步，則送出表單資訊給php產生 訂單 + 訂單明細
                //表單全部存起來
                var getterData = $("#cartForm").serialize();
                console.log(`getterData before: ${getterData}`);
                console.log(`$("#boxPic").size() > 0: ${$("#boxPic").length > 0}`);
                //取得總價(不想再php算)
                var orderTotal = $("#priceTotalContent").text(); console.log(`orderTotal: ${orderTotal}`);
                getterData += "&orderTotal=" + orderTotal;
                //如果有優惠卷
                if ($("option").length > 0) { //jq抓物件一定會回傳陣列，所以永遠都是true，要改用檢查陣列大小的方式
                    var coupNo = $("#couponItem").data("coupNo");
                    getterData += "&coupNo=" + coupNo;
                }
                //如果有箱子
                if ($("#boxPic").length > 0){ //jq抓物件一定會回傳陣列，所以永遠都是true，要改用檢查陣列大小的方式
                    var boxPic = $("#boxPic").attr("src");
                    getterData += "&boxPic=" + boxPic;
                }
                //如果有卡片圖
                if ($("#cardPic").length > 0) {
                    var cardPic = $("#cardPic").attr("src");
                    getterData += "&cardPic=" + cardPic;
                } 
                //如果有卡片聲音
                if ($("#au_player").length > 0) {
                    var audioFile = $("#au_player").attr("src");
                    getterData += "&audioFile=" + audioFile;
                }
                // var cardPic = $("#cardPic").attr("src");
                console.log(`boxPic before: ${boxPic}`);
                console.log(`cardPic before: ${cardPic}`);
                // var audioFile = $("#au_player").attr("src");
                console.log(`audioFile before: ${audioFile}`);
                console.log(`getterData AFTER: ${getterData}`);

                $.ajax({
                    type: "post",
                    url: "creatOrder.php",
                    data: getterData,
                    success: function (response) {
                        if (response == "error") {
                            alert(" 下單失敗 Q口Q ");
                        } else {
                            // alert(response);
                            console.log(response)
                        }
                    }
                });
                //隱藏表單
                $(".cartFormZone").removeClass("cartPageActive");
                //隱藏流程面板與小計
                $(".cartPanel").removeClass("cartPageActive");
                //顯示 footer
                $("footer").show();
                //顯示訂單完成提示
                $(".cartFinishOrder").addClass("cartPageActive");

                break;

            default:
                break;
        }

    })

    //上一步的觸發流程
    $(".panelBtn .btnBack").click(function () {
        switch (stepCount) {
            case 1:
                //目前沒有第一步
                break;
            case 2:
                //關掉表單
                $(".cartFormZone").removeClass("cartPageActive");
                //顯示購物清單
                $(".cartContent_prod").addClass("cartPageActive");
                //隱藏上一步按鈕
                $(this).addClass("btnBack_none");
                stepCount -= 1;
                console.log(`stepCount: ${stepCount}`);
                break;
            case 3:
                //送出訂單也沒有返回可用
                break;
            default:
                break;
        }
    })


    //燈箱關閉，燈箱外任意處點擊後關閉
    $(".lightBoxes").click(function (e) {
        var elem = e.target;
        while (elem) { //循環判斷到節點，防止點到子元素   
            if (elem.classList && elem.classList.contains("lightBox")) { //如果該元素有class且有某某class的話就不動作
                return; //我就跳出
            }
            elem = elem.parentNode; //往上找找到最大的"不作用"的層
        }
        $('.lightBoxes').removeClass("cartPageActive"); //沒被跳出就會走到這裡，可以隱藏跳窗
    })
    //燈箱關閉，燈箱內 .stepBack 按鈕點擊後關閉
    $(".lightBoxBtns .stepBack").click(function (e) {
        $('.lightBoxes').removeClass("cartPageActive");
    })
    // console.log($(".lightBoxes"));
    // console.log($(".lightBox"));    
    // $(window).click(function(e){
    //     console.log(e.target);

    // })


    //call ENG BTN
    $(".title h2").click(function () {
        $(".engBtnList").toggleClass("show");
    })
    $(".engBtn:not(#clearSession)").click(function (e) {
        let tar = e.target.innerText;
        // alert(tar);
        $("." + tar).toggle();
        $(".engBtnList").removeClass("show");

    })
    $("#clearSession").click(function(){
        $.ajax({
            url: "clearSession_ENG.php",
            success: function (response) {
                console.log(response);
            }
        });
        $(".engBtnList").removeClass("show");
    })
    //////ENG BTN ENDDD


    //loginCheck
    function CartStepLoginCheck(result) {
        $.ajax({
            url: "CartStepLoginCheck.php",
            success: function (response) {
                if (response == "error") {
                    alert("NO ONE login");
                    // return false;
                    result(response);
                } else {
                    alert(response + " already login");
                    // return true;
                    result(response);
                }
            }
        })
        // return loginResult;
    }


    //step2
    function step2() {
        //如果有 客製箱 或 預購箱，需要跳出警告提醒消費者，將與單品寄給同一位收件人
        if ($(".prodCard_CusBox").length>0 || $(".prodCard_planItem").length>0) {
            $('.lightBoxes').addClass("cartPageActive");
            //燈箱 "繼續結帳" 被點擊，則顯示下一頁面
            //使用unbind避免重複綁定點擊事件，造成stepCount錯誤
            $(".step.stepNext").unbind("click").bind("click", function () {
                // alert("0.0")
                //關閉燈箱
                $('.lightBoxes').removeClass("cartPageActive");
                //內容切換到表格
                $(".cartContent_prod").removeClass("cartPageActive");
                $(".cartFormZone").addClass("cartPageActive");
                //顯示 "上一步" 按鈕
                $(".btnBack").removeClass("btnBack_none");
                //頁數+1
                stepCount += 1;
                console.log(`stepCount: ${stepCount}`);
            })
        } else {
            // alert("下一步~");
            //內容切換到表格
            $(".cartContent_prod").removeClass("cartPageActive");
            $(".cartFormZone").addClass("cartPageActive");
            //顯示 "上一步" 按鈕
            $(".btnBack").removeClass(".btnBack_none");
            stepCount += 1;
            console.log(`stepCount: ${stepCount}`);
        }
    }


    //ENG function
    function CartProdAdd_ENG() {
        //寫入假商品資料到session
        $.ajax({
            type: "get",
            url: "CartProdAdd_ENG.php",
            success: function (response) {
                console.log(`response: ${response}`);
            }
        });
    }
});




//小播放器
// $(function () {
//     var au_player = $("#au_player")[0];
//     //撥放
//     $("#au_btn_play").bind("click",function(e){
//         if (!au_player.paused && au_player.ended){
//             au_player.pause();
//             //切換icon成撥放符號
//             au_player.innerHTML = "<i class='fas fa-play'></i>";
//         }else{
//             au_player.play();
//             //切換icon成暫停符號
//             au_player.innerHTML = "<i class='fas fa-pause'></i>";
//         }
//         // $("#au_player")[0].play();
//     });
//     //停止
//     $("#au_btn_stop").click(function(e){
//         au_player.pause();
//         au_player.currentTime=0;
//     });
// });


//撥放器-------------------------------開始
function init() {
    console.log($(window).width());
    var au_player = document.getElementById("au_player");
    if(au_player){
        // 撥放/暫停
        $id("au_btn_play").addEventListener("click", auPlayAndPause);
        // 停止
        $id("au_btn_stop").addEventListener("click", auStop);
        // 靜音
        $id("au_btn_vol").addEventListener("click", auMute);
    }


    if ($(window).width() > 767) {
        // 進度條點擊跳轉
        $id("defBar").addEventListener("click", auJumpTo);
        // 音量點擊跳轉
        $id("volBar").addEventListener("click", auVol);
        // 撥放結束相關事宜
        $id("au_player").addEventListener("ended", auStop);
        // 緩衝完成可以撥放時相關事宜, ex:提供總長度等數據
        $id("au_player").addEventListener("canplaythrough", auUpdateTimeAll);
        // 更新當前秒數
        $id("au_player").addEventListener("timeupdate", auUpdateTimeNow);
        //拖曳進度條拉桿
        $id("barNote").addEventListener("mousedown", dragStartBarNote);
        //拖曳音量拉桿
        $id("vol_barNote").addEventListener("mousedown", dragStartVolBarNote);
    }

}
window.addEventListener("load", init);



function auPlayAndPause(e) {
    if (!$id("au_player").paused && !$id("au_player").ended) {
        //撥放中被觸發
        //暫停撥放
        $id("au_player").pause();
        //刪個狀態，改變color
        $id("au_btn_play").classList.remove("select");
        //切換icon成撥放符號
        $id("au_btn_play").innerHTML = "<i class='fas fa-play'></i>";
    } else {
        //停止或暫停時被觸發
        $id("au_player").play();
        //加個狀態，改變color
        $id("au_btn_play").classList.add("select");
        //切換icon成暫停符號
        $id("au_btn_play").innerHTML = "<i class='fas fa-pause'></i>";
        //持續作用直到撥放結束
        if ($(window).width()>768){ //桌機板可能有進度條之類的
            setInterval(() => {
                if (!$id("au_player").ended) {
                    //撥放中
                    //換算進度條應該要佔多少
                    barSize = parseInt(window.getComputedStyle($id("defBar")).width);
                    var size = barSize / $id("au_player").duration * $id("au_player").currentTime;
                    //設定bar跟拉桿的位置
                    $id("proBar").style.width = size + 'px';
                    $id("barNote").style.left = size + "px";
                } else {
                    //播到結束的瞬間
                    //bar、拉桿及撥放時序歸零
                    $id("proBar").style.width = '0px';
                    $id("barNote").style.left = "0px";
                    $id("au_player").currentTime = 0;
                    $id("au_btn_play").classList.remove("select");
                    //換回撥放鈕
                    $id("au_btn_play").innerHTML = "<i class='fas fa-play'></i>";
                }
            }, 100);
        }else{ //手機板沒有那些bar要算，直接等到結束復歸
            if ($id("au_player").ended){
                $id("au_player").currentTime = 0;
                $id("au_btn_play").innerHTML = "<i class='fas fa-play'></i>";
            }
        }
    }
}

//停止撥放
function auStop(e) {
    //暫停
    $id("au_player").pause();
    // $id("au_btn_play").innerText = "播";
    $id("au_btn_play").classList.remove("select");
    if ($(window).width() > 768){
        ////bar、拉桿及撥放時序歸零
        $id("proBar").style.width = '0px';
        $id("barNote").style.left = "0%";
    }
    $id("au_player").currentTime = 0;
    //換回撥放鈕
    $id("au_btn_play").innerHTML = "<i class='fas fa-play'></i>";
}

//靜音鈕
function auMute(e) {
    //如果是靜音
    if ($id("au_player").muted == true) {
        // 那我就不靜音
        $id("au_player").muted = false;
        $id("au_btn_vol").innerHTML = "<i class='fas fa-volume-up'></i>";
    } else {
        //如果不是靜音
        //那我就靜音
        $id("au_player").muted = true;
        $id("au_btn_vol").innerHTML = "<i class='fas fa-volume-mute'></i>";
    }
}

//音量點擊控制
function auVol(e) {
    var mouseX = e.clientX - $id("volBar").offsetLeft;
    $id("vol_proBar").style.width = mouseX + "px";
    $id("vol_barNote").style.left = mouseX + "px";

    barSize = parseInt(window.getComputedStyle($id("volBar")).width);
    var newVol = mouseX / barSize;
    console.log(`newVol: ${newVol}`);
    $id("au_player").volume = newVol;
}

//進度條點擊控制
function auJumpTo(e) {
    var mouseX = e.clientX - $id("defBar").offsetLeft;
    $id("proBar").style.width = mouseX + "px";
    $id("barNote").style.left = mouseX + "px";

    barSize = parseInt(window.getComputedStyle($id("defBar")).width);
    var newTime = mouseX / (barSize / $id("au_player").duration);
    $id("au_player").currentTime = newTime;
}

//讀完檔案把總長度塞進標籤裡
function auUpdateTimeAll(e) {
    // console.log($id("au_player").duration);
    $id("au_timeAll").innerText = formatTime($id("au_player").duration);
}

//把正在撥放的時間更新到標籤裡
function auUpdateTimeNow(e) {
    console.log($id("au_player").currentTime);
    $id("au_timeNow").innerText = formatTime($id("au_player").currentTime);
}

//撥放器-------------------------------結束