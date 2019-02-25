function showKind(e, kind, num) {
    var chocolate = parseInt(document.getElementById('chocolate').value);
    var cookie = parseInt(document.getElementById('cookie').value);
    var candy = parseInt(document.getElementById('candy').value);
    var chips = parseInt(document.getElementById('chips').value);
    var total = chocolate + cookie + candy + chips;
    var box = document.getElementsByClassName('card3_box')[0];
    var childIndex = box.childNodes.length;
    var kindItem = document.getElementById(kind);

    if (num == 1) {
        if (total == 6) {
            alert('零食箱裡已經有6個零食了喔～');
        } else {
            kindItem.value = parseInt(kindItem.value) + parseInt(num);
            var arr = [];
            var nums = [1, 2, 3, 4, 5, 6];
            for (var i = 0; i < childIndex; i++) {
                arr.push(parseInt(box.childNodes[i].className.replace('boxChild', '')));
            }
            for (var j = 0; j < nums.length; j++) {
                if (arr.indexOf(nums[j]) == -1) {
                    var missing = nums[j];
                    break;
                }
            }
            var newSnack = document.createElement('div');
            var newImg = document.createElement('img');
            newImg.src = '../images/blair/' + kind + '.png';
            newSnack.appendChild(newImg);
            newSnack.classList.add('boxChild' + missing);
            box.appendChild(newSnack);
        }
    } else if (num == -1) {
        if (total == 0) {
            alert('零食箱裡已經沒有零食了喔~');
        } else if (parseInt(kindItem.value) == 0) {
            parseInt(kindItem.value) == 0;
        } else {
            kindItem.value = parseInt(kindItem.value) + parseInt(num);
            for (var k = 0; k < childIndex; k++) {
                var str = box.childNodes[k].childNodes[0].src;
                if (str.includes(kind)) {
                    var dead = k;
                    break;
                }
            }
            box.removeChild(box.childNodes[dead]);
        }
    }
}
function showCard2(){
    document.getElementById('orderCard2').classList.remove('slideUp3');
    document.getElementById('orderCard2').classList.add('slideUp');
    var boxImgs = document.getElementsByClassName('boxImg');
    for (var j = 0; j < boxImgs.length; j++) {
        boxImgs[j].classList.add('fall');
    }
    var boxImg1s = document.getElementsByClassName('boxImg1');
    var boxImg2s = document.getElementsByClassName('boxImg2');
    var boxImg3s = document.getElementsByClassName('boxImg3');
    for (var k = 0; k < boxImg1s.length; k++) {
        boxImg1s[k].style.animationDelay = '0.1s';
    }
    for (var m = 0; m < boxImg2s.length; m++) {
        boxImg2s[m].style.animationDelay = '0.25s';
    }
    for (var n = 0; n < boxImg3s.length; n++) {
        boxImg3s[n].style.animationDelay = '0.35s';
    }
    document.getElementById('buy2').addEventListener('click', function (){
        document.getElementById('orderCard3').style.zIndex = '1';
        document.getElementById('orderCard3').classList.remove('slideUp4');
        document.getElementById('orderCard3').classList.add('slideUp2');
        document.getElementById('card3_back').addEventListener('click', function (){
            document.getElementById('orderCard3').classList.add('slideUp4');
            document.getElementById('orderCard3').classList.remove('slideUp2');
            
        })

    });
    document.getElementById('card2_back').addEventListener('click', function (){
        document.getElementById('orderCard2').classList.add('slideUp3');
        document.getElementById('orderCard2').classList.remove('slideUp');
    })
}
currentDeg = 0;
function showNext() {
    currentDeg = currentDeg - 60;
    document.getElementsByClassName('carousels')[0].style.transform = 'translate(-50%,-50%) rotateY(' + currentDeg + 'deg)';
}

function showPrev() {
    currentDeg = currentDeg + 60;
    document.getElementsByClassName('carousels')[0].style.transform = 'translate(-50%,-50%) rotateY(' + currentDeg + 'deg)';
}
function getBoxSnack(month){
    var xhr = new XMLHttpRequest();
    xhr.onload = function () {
        if (xhr.status == 200) {
            document.getElementsByClassName("carousels")[0].innerHTML = xhr.responseText;
            showStar();
        } else {
            alert(xhr.status);
        }
    }

    var url = 'getBoxSnack.php?month=' + month;
    xhr.open('get', url, true);
    xhr.send(null);
}
function forCart(e){
    var chips = parseInt(document.getElementById('chips').value);
    var candy = parseInt(document.getElementById('candy').value);
    var cookie = parseInt(document.getElementById('cookie').value);
    var chocolate = parseInt(document.getElementById('chocolate').value);
    if( chips + candy + cookie + chocolate != 6 ){
        alert('零食箱裡沒有6個零食耶～');
    }else{
        var cart = document.getElementById('realCart');
        if (document.getElementById('month_3').hasAttribute('checked') == true ){
            var snackNo = 51;
            var price = 900;
        }
        if (document.getElementById('month_6').hasAttribute('checked') == true ){
            var snackNo = 52;
            var price = 1800;
        }
        if (document.getElementById('month_12').hasAttribute('checked') == true ){
            var snackNo = 53;
            var price = 3600;
        }
        var note = '洋芋片' + chips + ' 糖果' + candy + ' 餅乾' + cookie + ' 巧克力' + chocolate;
        var cartId = snackNo + '|' + price + '|3|' + note;
        cart.id = cartId; 
    }

}
function init() {
    //取得加減符號的物件關聯並設定事件處理器
    var minusBtns = document.getElementsByClassName('numMinus');
    var plusBtns = document.getElementsByClassName('numPlus');
    for (var i = 0; i < minusBtns.length; i++) {
        minusBtns[i].addEventListener('click', function (e) {
            var id = e.target.parentNode.childNodes[2].id;
            showKind(e, id, -1);
        });
        plusBtns[i].addEventListener('click', function (e) {
            var id = e.target.parentNode.childNodes[2].id;
            showKind(e, id, 1);
        });
    }
    //將第一個立即預購按鈕設定事件處理器
    document.getElementById('buy1').addEventListener('click', showCard2);

    var months = document.getElementsByClassName('month');
    months[0].addEventListener('click', function (){
        getBoxSnack(1);
    });
    months[1].addEventListener('click', function (){
        getBoxSnack(2);
    });
    months[2].addEventListener('click', function (){
        getBoxSnack(3);
    });

    var monthsRadio = document.getElementsByName('months');
    for(var k = 0 ; k < 3; k++){
        monthsRadio[k].addEventListener('click', function (e){
            for( k = 0; k < 3; k++){
                monthsRadio[k].removeAttribute('checked');
            }
            e.target.setAttribute('checked', true);
        })
    }

    for (var j = 0; j < 3; j++) {
        months[j].addEventListener('click', function (e) {
            //因為被點擊到的要換色，其他要恢復原狀
            //所以有按鈕被點擊時先一律全部恢復原狀，再讓被點擊的那個換色
            for (j = 0; j < 3; j++) {
                months[j].style.color = '';
                months[j].style.backgroundColor = '';
            }
            e.target.style.color = '#737374';
            e.target.style.backgroundColor = '#fbc84a';
        });
    }

    document.getElementById('angle_left').addEventListener('click', showPrev);
    document.getElementById('angle_right').addEventListener('click', showNext);
    document.getElementById('realCart').addEventListener('click', forCart);
}
window.addEventListener('load', init);

