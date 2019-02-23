//0 一般
//1 客製
//2 即期
//3 預購

// 一般商品的購物車按鈕
// id="<?php echo "{$snackRow['snackNo']}|{$snackRow['snackPrice']}|0" ?>"
// 商品編號|零食價格|0

// 客製零食箱的購物車按鈕
// id="<?php echo "{$snackRow['snackNo']}|{$snackRow['snackPrice']}|1" ?>"
// 商品編號|零食價格|1

// 即期品的購物車按鈕
// id="<?php echo "{$saleRow['snackNo']}|{$salesRow['salePrice']}|2|{$saleRow['snackPrice']}|{$saleRow['clearanceNo']}" ?>"
// 商品編號|促銷價格|2|零食價格|即期品專案編號

// 預購箱的購物車按鈕
// id="<?php echo "{$snackRow['snackNo']}|{$snackRow['snackPrice']}|3|'巧克力1洋芋片2糖果1餅乾2'" ?>"
// 商品編號|箱子價格|3|箱子備註

function cusAddCart(e){
    //存 HTML中 data-* 欄位儲存的資訊
    var cusBox=e.target.dataset.cusbox; //存箱子截圖路徑
    var cusCard=e.target.dataset.cuscard; //存卡片截圖路徑
    var cusSound=e.target.dataset.cussound; //存聲音檔路徑


    // console.log(`addCart fumc now`);
    if(e.target.innerText == '放入零食車'){ //配合客製頁面，篩選對應按鈕 "放入零食車"
        //沒登入就親切的提醒使用者，要登入喔鳩咪
        if (document.getElementById("btnloglout").innerHTML == "&nbsp;") {
            alert('請先登入會員唷～');
            return;
        }else{
            //如果有登入就把選重的商品加入購物車
            
            //Blair優雅拆資料大法
            //首先在 HTML 的 id 中放入一堆規定格式的字串，規則最上方所述
            var info = e.target.id; //取得 id
            var infoArr = info.split('|'); //用 "|" 來拆解 id 字串，並轉換成陣列
            var snackNo = infoArr[0]; //陣列[0] 代表 snackNo
            var snackPrice = infoArr[1]; //陣列[1] 代表 snackPrice
            var snackType = infoArr[2]; //陣列[2] 代表 snackType，我們約定使用 snackType 來區分 客製 / 一般 / 即期 / 預購

            console.log(`snackNo: ${snackNo},  snackPrice: ${snackPrice}, snackType: ${snackType}`);
            
            //不同 snackType 夾帶 不同的 note 資訊 
            if ( snackType == 2 ){  //2 即期
                var note = infoArr[3] + '|' + infoArr[4];
            } else if ( snackType == 3 ){ //3 預購
                var note = infoArr[3];
            }else if ( snackType == 1 ){ //1 客製
                var note = "cus";
            }else{
                var note = '';
            }
            var xhr = new XMLHttpRequest();
            xhr.onload = function () {
                if (xhr.status == 200) {
                    alert('商品已放入零食箱～');
                } else {
                    alert(xhr.status);
                    console.log(this.responseText); //如果發生問題，把異常資訊印在主控台
                    
                }
            }
            
            //送出資訊
            var url = 'cusAddCart.php?snackNo=' + snackNo + '&snackPrice=' + snackPrice + '&snackType=' + snackType + '&note=' + note;
            xhr.open('get', url, true);
            xhr.send(null);
        }
    }else{
        if (document.getElementById("btnloglout").innerHTML == "&nbsp;") {
            alert('請先登入會員唷～');
            return;
        }else{
            //如果是按到 客製箱頁面 的 "加入購物車"，會把額外送 箱子 / 卡片 / 聲音的訊息到 php session
            //cartShow.php 購物車頁面會判斷有沒有 客製箱資訊，來串連整組資料
            var info = e.target.id;
            var infoArr = info.split('|');
            var snackNo = infoArr[0];
            var snackPrice = infoArr[1];
            var snackType = infoArr[2];

            var xhr = new XMLHttpRequest();
            xhr.onload = function () {
                if (xhr.status == 200 && xhr.responseText=="noProd") {
                    alert("請加入零食!!!");
                    console.log(`responseText: ${xhr.responseText}`);
                    
                }else if(xhr.status == 200 && xhr.responseText!="noProd"){
                    alert('商品已全數加入購物車～');
                    console.log(`responseText: ${xhr.responseText}`);

                    //跳轉到購物車頁面(或是你想跳的其他頁面)
                    document.location.replace("cartShow.php");
                } 
                else {
                    alert(xhr.status);
                }
            }
            var url = 'cusAddCart.php?cusBox=' + cusBox + '&cusCard=' + cusCard + '&cusSound=' + cusSound
             + '&snackPrice=' + snackPrice  + '&snackNo=' + snackNo + '&snackType=' + snackType + '&note=box';
            xhr.open('get', url, true);
            xhr.send(null);

            console.log(`url: ${url}`);
            

        }
    }
}
window.addEventListener('load', function (){
    //監聽所有 class 帶有 "cart" 的單位
    var carts = document.getElementsByClassName('cart');
    var length = carts.length;
    // console.log(length);
    for(var i =0; i < length; i++){
        carts[i].addEventListener('click', cusAddCart);
        // console.log(`Done cart listen`);
    }
})