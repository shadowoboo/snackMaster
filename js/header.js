// -----------------header雲的動畫--------------------------------------
var canvas = document.getElementById('canvas');
var ctx = canvas.getContext('2d');
canvas.width = canvas.parentNode.offsetWidth;
canvas.height = canvas.parentNode.offsetHeight;


function cloudResize() {
    //如果浏览器支持requestAnimFrame则使用requestAnimFrame否则使用setTimeout  
    window.requestAnimFrame = (function () {
        return window.requestAnimationFrame ||
            window.webkitRequestAnimationFrame ||
            window.mozRequestAnimationFrame ||
            function (callback) {
                //-----------波浪秒數設定-----------
                window.setTimeout(callback, 50000 / 60);
            };
    })();

    window.onresize = function () {
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
        "rgba(235,237,238, 0.5)"

    ];
    if (window.screen.width > 768) {
        function loop() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            step++;
            //画3个不同颜色的矩形  
            for (var j = lines.length - 1; j >= 0; j--) {
                ctx.fillStyle = lines[j];
                //每个矩形的角度都不同，每个之间相差45度  
                var angle = (step + j * 90) * Math.PI / 180;
                // console.log(angle);
                //-------------波浪幅度設定(原設定50->35)-------------------
                var deltaHeight = Math.sin(angle) * 30;
                var deltaHeightRight = Math.cos(angle) * 30;
                ctx.beginPath();
                ctx.moveTo(0, canvas.height / 2.6 + deltaHeight);
                ctx.bezierCurveTo(canvas.width / 2.6, canvas.height / 2.6 + deltaHeight - 30, canvas.width / 2.6, canvas.height / 2.6 + deltaHeightRight - 30, canvas.width, canvas.height / 2.6 + deltaHeightRight);
                ctx.lineTo(canvas.width, canvas.height);
                ctx.lineTo(0, canvas.height);
                ctx.lineTo(0, canvas.height / 2.6 + deltaHeight);
                ctx.closePath();
                ctx.fill();
            }
            requestAnimFrame(loop);
        }
        loop();
    } else {
        function loop() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            step++;
            //画3个不同颜色的矩形  
            for (var j = lines.length - 1; j >= 0; j--) {
                ctx.fillStyle = lines[j];
                //每个矩形的角度都不同，每个之间相差45度  
                var angle = (step + j * 110) * Math.PI / 180;
                // console.log(angle);
                //-------------波浪幅度設定(原設定50->35)-------------------
                var deltaHeight = Math.sin(angle) * 7;
                var deltaHeightRight = Math.cos(angle) * 7;
                ctx.beginPath();
                ctx.moveTo(0, canvas.height / 3.5 + deltaHeight);
                ctx.bezierCurveTo(canvas.width / 3.5, canvas.height / 3.5 + deltaHeight - 22, canvas.width / 3.5, canvas.height / 3.5 + deltaHeightRight - 22, canvas.width, canvas.height / 3.5 + deltaHeightRight);
                ctx.lineTo(canvas.width, canvas.height);
                ctx.lineTo(0, canvas.height);
                ctx.lineTo(0, canvas.height / 3.5 + deltaHeight);
                ctx.closePath();
                ctx.fill();
            }
            requestAnimFrame(loop);
        }
        loop();
    }
}

function init4() {
    cloudResize();
    window.addEventListener('resize', cloudResize);
}

window.addEventListener("load", init4);
//----------------手機的漢堡開關--------------------------
var list_appear = document.getElementById("list_appear");
var ham = document.getElementById("ham");
var cros = document.getElementById("cros");
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
    // console.log(`remove`);
    list_appear.classList.remove("show");
}
//hover的設定,不確定需不需要
//還沒移除show,如果點擊子選單會收不起來
// function appear(e){
//     console.log('hi');
//     Submenu.classList.add("show");
// }

window.addEventListener("load", init);

var search_appear = document.getElementById("search_appear");
var search = document.getElementById("searchBtn");
var closex = document.getElementById("close");
function init2(e) {
    search.addEventListener("click", showSearch);
    closex.addEventListener("click", closeSearch);

}
function showSearch(e) {
    search_appear.classList.add("down");

}
function closeSearch(e) {
    // console.log(`remove`);
    search_appear.classList.remove("down");
}

function closeSearch(e) {
    console.log(`remove`);
    search_appear.classList.remove("down");
}

window.addEventListener("load", init2);
//----------------------會員登入燈箱-----------------------//

function $id(id) {
    return document.getElementById(id);
}
//-------------控制燈箱的js----------------------
function showLightBox(e) {
    //點擊登入按鈕，顯示燈箱

    if ($id('memLogin').style.color == 'rgb(7, 107, 175)') {
        location.href = "../page/member.php";
        // alert(123);
    } else {
        $id('lightBox-wrap').classList.toggle('show');
    }


    // if($id('memLogin').style.color =='rgb(0, 69, 123)'){
    //     // console.log('hhh');
    //     $id('lightBox-wrap').classList.toggle('show');
    // }else{
    //     //清除登入者資訊
    //     var xhr = new XMLHttpRequest();
    //     xhr.onload = function(){
    //     if( xhr.status == 200){
    //         $id('btnloglout').innerHTML = '&nbsp';
    //         $id('memLogin').style.color = "#737374";
    //     }else{
    //         alert( xhr.status );
    //     }
    //     }
    //     xhr.open("get", "ajaxLogout.php",true);
    //     xhr.send(null);
    //     }



}
//頁籤切換 登入＋註冊＋忘記密碼
function changeway(e, tabchange) {
    var i, loginTab, tabContent;
    tabContent = document.getElementsByClassName('tabContent');
    for (i = 0; i < tabContent.length; i++) {
        tabContent[i].style.display = "none";
    }
    loginTab = document.getElementsByClassName('loginTab');
    //   console.log('bbb');

    for (i = 0; i < loginTab.length; i++) {
        loginTab[i].classList.remove("active");
        loginTab.className = loginTab[i].className.replace('active', "");
    }
    document.getElementById(tabchange).style.display = "block";
    e.target.classList.add("active");
    //   e.currentTarget.className += " active";

}
$id('open').click();
//-----------關閉燈箱---------------------------------------
function cancelLogin() {
    $id('lightBox-wrap').classList.remove('show');
    $id('memLogin').style.color = '#737374';
    //清除欄位資料
    $id('loginMemId').value = "";
    $id('loginMemPsw').value = "";
}
//============登入＋登出＋註冊＋忘記密碼程式========================//

//===========================================//
//             這是登入程式                    //
//===========================================//

function sendForm() {
    var xhr = new XMLHttpRequest();
    xhr.onload = function () {

        if (xhr.responseText == 0) {
            alert("帳密錯誤!!!");
        }
        else {//登入成功顯示“登出”
            $id('btnloglout').innerHTML = "登出"
            $id('memLogin').style.color = "#076baf";
            $id('loginMemId').value = "";
            $id('loginMemPsw').value = "";
            $id('lightBox-wrap').classList.remove('show');
        }
    }
    xhr.open("Post", "ajaxLogin.php", true);
    xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
    //------------------JOSON--------------------------------
    //產生一個物件
    var loginInfo = {
        memId: $id("loginMemId").value,
        memPsw: $id("loginMemPsw").value
    }

    //JSON字串
    xhr.send("loginInfo=" + JSON.stringify(loginInfo));

}

//===========================================//
//             這是登出程式                    //
//===========================================//
function logout() {
    // ?loglout=true
    
    // alert(location.href);
    // location.href;
    var xhr = new XMLHttpRequest();
    xhr.onload = function () {
        $id('btnloglout').innerHTML = "&nbsp"
        $id('memLogin').style.color = "#737374";
        $id('loginMemId').value = "";
        $id('loginMemPsw').value = "";
       
    } 
    location.href = location.href+"?loglout=true";

    xhr.open("get", "ajaxLogout.php", true);
    xhr.send(null);
}

//===========================================//
//             這是註冊程式                    //
//===========================================//

function SUForm() {

    var account = $id("signUpMemId");
    var email = $id("signUpMemEmail");
    //檢查帳號


    // //帳號不得空白  
    if (account.value == "") {
        alert("請填寫帳號");
        account.focus();
        return;
    }
    //帳號不能少於2碼

    if (account.value.length < 2) {
        alert("帳號不得少於2碼");
        account.focus();
        return;
    }
    //密碼不得空白
    if ($id('signUpMemPsw').value == "") {
        alert("請填寫密碼");
        $id('signUpMemPsw').focus();
        return;
    }



    if (email.value == "") {
        alert("請填寫Email");
        email.focus();
        return;
    }
    if (!validateEmail(email.value)) {
        alert("請填寫正確的Email格式!");
        email.focus();
        return;

    }
    //確認正確寫進資料庫
    add_member();
}
function checkPsw() {
    var pLen = $id("signUpMemPsw");
    for (var index = 0; index < pLen.length; index++) {
        if (pLen.charAt(index) == ' ' || pLen.charAt(index) == '\"') {
            alert("密碼不可以含有空白或雙引號！");
            return false;
        }
        if (pLen.value.length < 2) {
            alert("密碼長度不得少於2碼");
            return false;
        }
        return true;
    }

}
function validateEmail(str_email) {
    var emailRule = /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z]+$/;
    return emailRule.test(String(str_email).toLowerCase());
}

function add_member() {
    var xhr = new XMLHttpRequest();
    xhr.onload = function () {
        // alert(xhr.responseText);

        if (xhr.status == 200) {
            //檢查帳號是否已註冊過   
            if (xhr.responseText == 1) {
                alert("帳號已有人使用");
            }
            else {
                //註冊成功
                alert('會員註冊成功!!');
                //關閉燈箱，並將註冊表單上的資料清空
                $id('lightBox-wrap').classList.remove('show');
                $id('signUpMemId').value = "";
                $id('signUpMemPsw').value = "";
                $id('signUpMemEmail').value = "";
                $id('btnloglout').innerHTML = "登出"
                $id('memLogin').style.color = "#076baf";


            }

        } else {
            alert(xhr.status);

        }

    }
    //php$_REQUEST代入以下變數
    var account = $id("signUpMemId").value;
    var password = $id("signUpMemPsw").value;
    var email = $id("signUpMemEmail").value;

    var url = "addMember.php?account=" + account + "&password=" + password + "&email=" + email;
    xhr.open("Get", url, true);
    xhr.send(null);
    //     regInfo = {
    //     memId :$id("signUpMemId").value,
    //     memPsw:$id("signUpMemPsw").value,
    //     email:$id('signUpMemEmail').value
    // }

    //  xhr.send( "regInfo="+ JSON.stringify(regInfo) );

}
//===========================================//
//             這是忘記密碼                   //
//===========================================//

// function FPForm(){
//     var xhr = new XMLHttpRequest();
//     xhr.onload = function(){
//         if( xhr.status == 200 ){
//             if (xhr.responseText == 0){
//                 alert("帳號不存在");
//             }else{
//                 alert("已寄出信件");
//                 $id('lightBox-wrap').classList.remove('show');

//             }
//         }else{
//             alert( xhr.status );
//         }


//     }
//     var forgetPsw = {
//         memId :$id("forgetMemId").value,
//         memEmail:$id("forgetpMemEmail").value
//     }
//     console.log("forgetPsw="+ JSON.stringify(forgetPsw));

//     // console.log(forgetPsw);
//     xhr.open("Post", "forgetPsw.php",true);
//     // xhr.send("forgetPsw="+ JSON.stringify(forgetPsw));
//     xhr.send(JSON.stringify(forgetPsw));


// }



$(function () {

    $("#forgetSend").click(FPform);

    function FPform() {
        // var forgetPsw = {
        //     memId :$id("forgetMemId").value,
        //     memEmail:$id("forgetpMemEmail").value
        // }
        // var sJson = JSON.stringify(forgetPsw);
        var data = "memId=" + $id("forgetMemId").value + "&memEmail=" + $id("forgetpMemEmail").value;
        console.log(data);

        $.ajax({
            type: "post",
            // dataType:"json",
            url: "forgetPsw.php",
            // contentType:"application/json; charset=UTF-8",
            data: data,
            success: function (response) {
                if (response == 0) {
                    alert("帳號不存在");
                } else {
                    alert("已寄出信件");
                    $id('lightBox-wrap').classList.remove('show');

                }
            }
        })
    }

})


//註冊所有事件聆聽！！！！！
function init3() {

    //點擊事件
    $id('memLogin').addEventListener('click', showLightBox);//出現燈箱
    $id('lightBoxLeave').addEventListener('click', cancelLogin);//關閉燈箱
    $id('btnLogin').addEventListener('click', sendForm);//送出登入按鈕
    $id('btnloglout').addEventListener('click', logout);//登出按鈕
    $id('btnSignUp').addEventListener('click', SUForm);//送出註冊按鈕
    // $id('forgetSend').addEventListener('click',FPForm);//寄送密碼按鈕


    // 檢查是否已登入
    var xhr = new XMLHttpRequest();

    xhr.onload = function () {
        console.log(`xhr.onlod now`);

        // console.log(xhr.responseText);
        // var loginInfo = JSON.parse(xhr.responseText);
        // console.log(xhr.responseText);
        // console.log(loginInfo)
        if (xhr.responseText == "notyetLogin") {
            $id("memLogin").style.color = "#737374f";
            $id("btnloglout").innerHTML = "&nbsp";
            console.log(xhr.responseText);
        } else {
            $id("memLogin").style.color = "#076baf"
            $id("btnloglout").innerHTML = "登出";
        }
    }
    xhr.open("get", "alreadyLogin.php", true);
    xhr.send(null);
    console.log(`init3`);



}
window.addEventListener("load", init3);



$(document).ready(function(){
    $('#store').click(function () {
        // $('#store .subMenu').show();
        $('#store .subMenu').stop(true).slideToggle();
    });
});