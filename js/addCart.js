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

function addCart(e){
    if(e.target.innerText == '加入購物車'){
        if (document.getElementById("btnloglout").innerHTML == "&nbsp;") {
            alert('請先登入會員唷～');
            return;
        }else{
            var info = e.target.id;
            var infoArr = info.split('|');
            var snackNo = infoArr[0];
            var snackPrice = infoArr[1];
            var snackType = infoArr[2];
            if ( snackType == 2 ){
                var note = infoArr[3] + '|' + infoArr[4];
            } else if ( snackType == 3 ){
                var note = infoArr[3];
            }else{
                var note = '';
            }
        
            var xhr = new XMLHttpRequest();
            xhr.onload = function () {
                if (xhr.status == 200) {
                    alert(xhr.responseText);
                    alert('商品已加入購物車～');
                } else {
                    alert(xhr.status);
                }
            }
        
            var url = 'addCart.php?snackNo=' + snackNo + '&snackPrice=' + snackPrice + '&snackType=' + snackType + '&note=' + note;
            xhr.open('get', url, true);
            xhr.send(null);
        }
    }
}
window.addEventListener('load', function (){
    var carts = document.getElementsByClassName('cart');
    var length = carts.length;
    for(var i =0; i < length; i++){
        carts[i].addEventListener('click', addCart);
    }
})