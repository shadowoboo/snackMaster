//抓css檔內樣式
//getPropertyValue不支援駝峰寫法=>表示不管大小寫~
//原句:window.getComputedStyle(element, null).getPropertyValue("float");
//不抓偽類 ex: var result = cssGet(".class","width");
//抓偽類 ex: var result = cssGet(".class","width",":after");
//回傳值是一個陣列!!!!
//transform會得到矩陣，不是 translate / rotate 之類的
function cssGet(element, property = "width-height", pseudo = null) {
    let el = document.querySelectorAll(element);
    var arrData = [];
    el.forEach(item => {
        let data = window.getComputedStyle(item, pseudo).getPropertyValue(property);
        arrData.push(data);
    })
    return arrData;
}
//驗證回傳值確實是陣列
console.log(`cssTest: ${cssGet("#box_12", "transform")}`); //每個.boxBase的transform屬性值，我全都要 
console.log(`cssTest type: ${typeof (cssGet("#box_12", "transform")[0])}`);//檢查 陣列內 值的型別為字串
console.log(`cssTest type arr: ${Object.prototype.toString.call(cssGet("#box_12", "transform"))}`);//檢查回傳值確實是陣列型態
        // cssGet(".boxBase","transform");





// console.log(`$id("btns7"): ${$id("btns7")}`);
// console.log(`$class("btn7"):　${$class("btn7")}`);
// console.log(`$q(".btn7"): ${$q(".btn7")}`);
// console.log(`$qall(".btn7"): ${$qall(".btn7")}`);
//終於有一天受不了了，學董董簡寫一些函式
//順便把array-like轉成array型態，方便操作
function $id(id) {//找id，動態
    return document.getElementById(id);
}
function $class(className) {//找className並轉成陣列，動態
    let classNames = document.getElementsByClassName(className);
    return Array.from(classNames);
}
function $qall(qall) {//query all，靜態
    let qalls = document.querySelectorAll(qall);
    return Array.from(qalls);
}
function $q(q) {//query，靜態
    return document.querySelector(q);
}



//測試用，確認點擊到的東西是誰
//windowClick();
//回傳log第一個是e.target訊息
//回傳log第二個是this訊息
function windowClick(e) {
    window.addEventListener("click", function (e) {
        console.log(e.target);
        console.log(this);
        //console.log(`$(this): ${$(this)}`); //jq
    })
}


//把秒數轉00:00 (分:秒)
function formatTime(seconds) {
    minutes = Math.floor(seconds / 60);
    minutes = (minutes >= 10) ? minutes : "0" + minutes;
    seconds = Math.floor(seconds % 60);
    seconds = (seconds >= 10) ? seconds : "0" + seconds;
    return minutes + ":" + seconds;
}