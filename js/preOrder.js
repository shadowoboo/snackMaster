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

    document.getElementById('angle_left').addEventListener('click', showPrev);
    document.getElementById('angle_right').addEventListener('click', showNext);
}
window.addEventListener('load', init);

