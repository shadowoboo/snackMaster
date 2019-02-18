

$(function () {
    //表單付款方式提示
    //目前利用html的checked預設為信用卡
    //點擊label切換
    $(".payTypeItem").on("click", function (e) {
        $(".payTypeItem").removeClass("checked");
        $(this).addClass("checked");
    })

})




$(document).ready(function () {

    //ENG 寫入商品測試用
    // CartProdAdd_ENG();

    //進入cartShow網頁，立刻檢查php session，若沒有商品則顯示 無商品頁面 / footer
    $.ajax({
        type: "get",
        url: "CartProdCheck.php",
        success: function (response) {
            //畫面淨空
            $(".cartContent").removeClass("cartPageActive");
            if(response!="prodExist"){ //如果商品還沒加入購物車
                console.log(`response!="prodExist"`);
                //顯示 "未購物提示" 
                $(".cartContent_none").addClass("cartPageActive");
                //顯示 footer
                $("footer").show();
                //預設不顯示其他區塊，所以不再動作
            } else {
                //隱藏 "未購物提示" 
                $(".cartContent_none").hide();
                //隱藏 footer
                $("footer").hide();
                //顯示購物清單
                $(".cartContent_prod").addClass("cartPageActive");
                //顯示流程面板與小計
                $(".cartPanel").addClass("cartPageActive");
            }
        },
        fail: function(){
            alert("ajax fail event");
        }
    });

    //流程控制
    var stepCount=1;//預設為沒有商品
    //下一步的觸發流程
    $(".panelBtn .btnNext").click(function () {
        switch (stepCount) {
            case 1:
                //登入檢查，未登入則不給下一步
                // console.log(CartStepLoginCheck(function (response){}));
                CartStepLoginCheck(function (response) {
                    console.log(`response: ${response}`);
                    if(response=="error"){
                        return;
                    }else{
                        step2();
                    }
                })
                
                break;
            case 2:
                //點擊下一步，則送出表單資訊給php產生 訂單 + 訂單明細
                //表單全部存起來
                var getterData=$("#cartForm").serialize();
                $.ajax({
                    type: "post",
                    url: "creatOrder.php",
                    data: getterData,
                    success: function (response) {
                        if(response=="error"){
                            alert(" 下單失敗 Q口Q ");
                        }else{
                            alert(response)
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
    $(".engBtn").click(function (e) {
        let tar = e.target.innerText;
        // alert(tar);
        $("." + tar).toggle();
    })
    //////ENG BTN ENDDD


    //loginCheck
    function CartStepLoginCheck(result){
        $.ajax({
            url: "CartStepLoginCheck.php",
            success: function(response){
                if(response=="error"){
                    alert("NO ONE login");
                    // return false;
                    result(response);
                }else{
                    alert(response + " already login");
                    // return true;
                    result(response);                    
                }
            }
        })
        // return loginResult;
    }


    //step2
    function step2(){
        //如果有 客製箱 或 預購箱，需要跳出警告提醒消費者，將與單品寄給同一位收件人
        if ($(".prodCard_CusBox") || $(".prodCard_planItem")) {
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




