//根據點擊的是加或減來修改number input 的 value
function updateNum(e, num, type) {
    //為了方便絕對定位，HTML結構中按鈕是在input的前與後
    //所以要根據按鈕的類型來決定如何取得input物件
    if (type == 'minus') {
        var input = e.target.nextSibling;
    } else {
        var input = e.target.previousSibling;
    }
    //將input的value控制在1~99以內，根據按鈕類型做+1或-1
    if (parseInt(input.value) == 1 && num == -1) {
        input.value = 1;
    } else if (parseInt(input.value) == 99 && num == 1) {
        input.value = 99;
    } else {
        input.value = parseInt(input.value) + parseInt(num);
    }
}

function doFirst() {
    //取得愛心按鈕們的物件關聯並設定點擊事件處理器toggleColor
    var hearts = document.getElementsByClassName('heart');
    for (var i = 0; i < hearts.length; i++) {
        hearts[i].addEventListener('click', function (e) {
            //愛心按鈕被點擊時會改變顏色，再次點擊會換回原本的顏色
            if (e.target.style.color == 'rgb(234, 90, 90)') {
                e.target.style.color = '';
            } else {
                e.target.style.color = 'rgb(234, 90, 90)';
            }
        });
    }

    //取得number input左右的加減按鈕們的物件關聯
    var numMinus = document.getElementsByClassName('numMinus');
    var numPlus = document.getElementsByClassName('numPlus');
    //兩種按鈕共用一個事件處理器updateNum，但回傳的值不同
    for (var j = 0; j < numMinus.length; j++) {
        numMinus[j].addEventListener('click', function (e) {
            updateNum(e, -1, 'minus');
        });
        numPlus[j].addEventListener('click', function (e) {
            updateNum(e, 1, 'plus');
        });
    }

    //取得箱子前後左右上按鈕們的物件關聯
    var dimensions = document.getElementsByClassName('dimension');
    for (var k = 0; k < dimensions.length; k++) {
        dimensions[k].addEventListener('click', function (e) {
            //因為被點擊到的要換色，其他要恢復原狀
            //所以有按鈕被點擊時先一律全部恢復原狀，再讓被點擊的那個換色
            for (k = 0; k < dimensions.length; k++) {
                dimensions[k].style.color = '';
                dimensions[k].style.backgroundColor = '';
            }
            e.target.style.color = '#737374';
            e.target.style.backgroundColor = '#fbc84a';
        });
    }

    //取得口味種類按鈕們的物件關聯
    var categories = document.getElementsByClassName('category');
    for (var m = 0; m < categories.length; m++) {
        categories[m].addEventListener('click', function (e) {
            //因為被點擊到的要換色，其他要恢復原狀
            //所以有按鈕被點擊時先一律全部恢復原狀，再讓被點擊的那個換色
            for (m = 0; m < categories.length; m++) {
                categories[m].style.color = '';
                categories[m].style.backgroundColor = '';
            }
            e.target.style.color = '#fff';
            e.target.style.backgroundColor = '#076baf';
        });
    }

}
window.addEventListener('load', doFirst);