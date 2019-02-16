// -----------------header雲的動畫--------------------------------------
var canvas = document.getElementById('canvas');
       var ctx = canvas.getContext('2d');
        canvas.width = canvas.parentNode.offsetWidth;
        canvas.height = canvas.parentNode.offsetHeight;

//如果浏览器支持requestAnimFrame则使用requestAnimFrame否则使用setTimeout  
        window.requestAnimFrame = (function() {
            return window.requestAnimationFrame ||
            window.webkitRequestAnimationFrame ||
            window.mozRequestAnimationFrame ||
        function(callback) {
            //-----------波浪秒數設定-----------
            window.setTimeout(callback, 50000 / 60);
         };
        })();

        window.onresize = function(){
            canvas.width = canvas.parentNode.offsetWidth;
            canvas.height = canvas.parentNode.offsetHeight;
} 

    //初始角度为0  
    var step = 0;
    //定义三条不同波浪的颜色  
    // var lines = ["rgba(0,222,255, 0.3)",
    //             "rgba(157,192,249, 0.3)",
    //             "rgba(0,168,255, 0.3)"
    //             ];
    var lines = ["#fff",
                 "fdfbfb",
                 "rgba(235,237,238, 0.3)"
                
                ];

    function loop() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        step++;
  //画3个不同颜色的矩形  
    for (var j = lines.length - 1; j >= 0; j--) {
            ctx.fillStyle = lines[j];
    //每个矩形的角度都不同，每个之间相差45度  
    var angle = (step + j * 45) * Math.PI / 180;
    //-------------波浪幅度設定(原設定50->35)-------------------
    var deltaHeight = Math.sin(angle) * 30;
    var deltaHeightRight = Math.cos(angle) * 30;
    ctx.beginPath();
    ctx.moveTo(0, canvas.height / 2 + deltaHeight);
    ctx.bezierCurveTo(canvas.width / 2, canvas.height / 2 + deltaHeight - 30, canvas.width / 2, canvas.height / 2 + deltaHeightRight - 30, canvas.width, canvas.height / 2 + deltaHeightRight);
    ctx.lineTo(canvas.width, canvas.height);
    ctx.lineTo(0, canvas.height);
    ctx.lineTo(0, canvas.height / 2 + deltaHeight);
    ctx.closePath();
    ctx.fill();
  }
  requestAnimFrame(loop);
}
loop();

//----------------手機的漢堡開關--------------------------
const list_appear = document.getElementById("list_appear");
        const ham = document.getElementById("ham");
        const cros = document.getElementById("cros");
        // const store = document.getElementById("store");
        // const subMenu = document.getElementById("Submenu");
        function init(e) {
            ham.addEventListener("click", show);
            cros.addEventListener("click", close);
            // store.addEventListener("click",appear);

        }
        function show(e) {
            list_appear.classList.add("show");
        
        }
        function close(e) {
            console.log(`remove`);
            list_appear.classList.remove("show");
        }
        //hover的設定,不確定需不需要
        //還沒移除show,如果點擊子選單會收不起來
        // function appear(e){
        //     console.log('hi');
        //     Submenu.classList.add("show");
        // }
        
        window.addEventListener("load",init);

        const search_appear = document.getElementById("search_appear");
        const search = document.getElementById("searchBtn");
        const closex = document.getElementById("close");
        function init2(e) {
            search.addEventListener("click", showSearch);
            closex.addEventListener("click", closeSearch);

        }
        function showSearch(e) {
            search_appear.classList.add("down");
        
        }
        function closeSearch(e) {
            console.log(`remove`);
            search_appear.classList.remove("down");
        }

        window.addEventListener("load",init2);
//----------------------會員登入燈箱-----------------------
function $id(id){
    return document.getElementById(id);
}
        //燈箱出現
function showLightBox(e){
    //icon 換色
     e.target.style.color = "#00457b";
    //  console.log('aaa');
     
    // $id('lightBox-wrap').classList.toggle('show');
    
    // console.log(e.target.style.color);
    // console.log(e.target.style.color=="rgb(0, 69, 123)");
    
    
    if($id('memLogin').style.color =='rgb(0, 69, 123)'){
        console.log('hhh');
        $id('lightBox-wrap').classList.toggle('show');
    }else{
        //清除登入者資訊
        // var xhr = new XMLHttpRequest();
        // xhr.onload = function(){
        // if( xhr.status == 200){
        //     $id('btnloglout').innerHTML = '&nbsp';
        //     $id('memLogin').style.color = "#737374";
        // }else{
        //     alert( xhr.status );
        // }
        // }
        // xhr.open("get", "ajaxLogout.php",true);
        // xhr.send(null);
        }
    
}
//頁籤切換 登入＋註冊＋忘記密碼
function changeway(e,tabchange){
    var i,loginTab,tabContent;
    tabContent = document.getElementsByClassName('tabContent');
    for(i=0; i<tabContent.length; i++){
      tabContent[i].style.display="none";
    }
    loginTab = document.getElementsByClassName('loginTab');
  //   console.log('bbb');
    
    for(i=0; i<loginTab.length; i++){
        loginTab[i].classList.remove("active");
      loginTab.className = loginTab[i].className.replace('active',"");
    }
    document.getElementById(tabchange).style.display = "block";
    e.target.classList.add("active");
  //   e.currentTarget.className += " active";
    
}
// document.getElementById('open').click();
// //===========================================//
// //             這是登入程式                    //
// //===========================================//

function sendForm(){
    var xhr = new XHLHttpRequest();
    xhr.onload = function(){
        if (xhr.responseText == "error") {
            alert("帳密錯誤!!!")
            
        }else{
            $id('btnloglout').innerHTML = "登出"
            $id('memLogin').style.color ="#00457b";
            $id('loginMemId').value = "";
            $id('loginMemPsw').value = "";
        }
    }
}










//-----------關閉燈箱---------------------------------------
function cancelLogin(){
   $id('lightBox-wrap').classList.remove('show');
   $id('memLogin').style.color = '#737374';
   //清除欄位資料
   $id('loginMemId').value = "";
   $id('loginMemPsw').value = "";

    
}


//註冊所有事件聆聽！！！！！
function init(){

    //點擊事件
    $id('memLogin').addEventListener('click',showLightBox) ;//出現燈箱
    // $id('lightBoxLeave').addEventListener('click',cancelLogin) ;//關閉燈箱
    // $id('btnLogin').addEventListener('click',sendForm);//登入按鈕
    // $id('btnSignUp').addEventListener('click',SUForm);//註冊按鈕
    // $id('btnforget').addEventListener('click',FPForm);//寄送密碼按鈕


}
window.addEventListener("load",init);
