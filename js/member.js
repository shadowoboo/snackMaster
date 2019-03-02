$(document).ready(function () {
  // console.log(123);
  //展開訂單明細
  $('.orderList_btn').on('click', function () {
    // console.log(321);
    if($(this).text() == "訂單明細 v") {
      // console.log('oop');
      $('.orderLis_content').removeClass('show');
      let tar = $(this).next().next(); //吃結構
      tar.addClass('show');
      $(this).text("訂單明細 ^");
    } else {
      $('.orderLis_content').removeClass('show');
      $(this).text("訂單明細 v");
    }
  });

});


 //========================評價燈箱=========================== 
function showBox(){
  var evaBox = document.querySelectorAll('button.orderList_eva');
    // console.log(evaBox.length);
    for (var i = 0; i < evaBox.length; i++) {
      evaBox[i].addEventListener("click",function(e){
        let lightBox = e.target.parentNode.parentNode.nextElementSibling;
        // console.log(e.target);
        // console.log(e.target.parentNode);
        // console.log(lightBox);
        lightBox.classList.add("appear");
        
      });
    }
} 
window.addEventListener('load',showBox,false);

//========================評價燈箱離開=========================== 
function closeBox(){
  var leavEva = document.getElementsByClassName('eva_lightBox_leave');
  // console.log(leavEva.length);
  for (var i= 0; i < leavEva.length; i++) {
     leavEva[i].addEventListener('click',function(e){
        let lightEvaBox = e.target.parentNode.parentNode;
        // console.log(e.target);
        lightEvaBox.classList.remove('appear');

     });
    
  }

}


//========================評價燈箱結束=========================== 


function $id(id) {
  return document.getElementById(id);
}

function headChange() {
  var file = $id('upFile').files[0];
  var readFile = new FileReader();
  readFile.readAsDataURL(file);
  readFile.addEventListener('load', function () {
    var bigHead = $id('headPic');
    bigHead.src = readFile.result;
    bigHead.style.maxWidth = '200px';
    bigHead.style.maxHeight = '300px';
  });
}

//-----------會員資料編輯--------------------

function modInfon1(){
  document.getElementById("memId").readOnly = false;
  document.getElementById("memId").style.border = "2px solid #076baf";
}
function modInfon2(){
  document.getElementById("password").readOnly = false;
  document.getElementById("password").style.border = "2px solid #076baf";
}
function modInfon3(){
  document.getElementById("memName").readOnly = false;
  document.getElementById("memName").style.border = "2px solid #076baf";
} 
function modInfon4(){
  document.getElementById("memPhone").readOnly = false;
  document.getElementById("memPhone").style.border = "2px solid #076baf";
} 
function modInfon5(){
  document.getElementById("email").readOnly = false;
  document.getElementById("email").style.border = "2px solid #076baf";
} 
  
function sendModi() {
  var xhr = new XMLHttpRequest();
  xhr.onload = function () {
    if (xhr.status == 200) {
      alertBox("修改成功");
      document.getElementById("memId").style.border = "1px solid #737374";
      document.getElementById("password").style.border = "1px solid #737374";
      document.getElementById("memName").style.border = "1px solid #737374";
      document.getElementById("memPhone").style.border = "1px solid #737374";
      document.getElementById("email").style.border = "1px solid #737374";
    } else {
      alertBox(xhr.status);
    }
  }
  xhr.open("Post", "memUpdate.php", true);
  var myForm = new FormData(document.getElementById('memInfo'));
  xhr.send(myForm);
}  

function doFirst() {
  $id('upFile').onchange = headChange;
  $id('btnmodify').addEventListener('click', sendModi);
}
window.addEventListener('load', doFirst);

  // -----------------------頁籤切換------------------------//
function changeTabs(evt, tabList) {
  var i, tablinks, tabPanel;
  tabPanel = document.getElementsByClassName("tabPanel");
  for (i = 0; i < tabPanel.length; i++) {
    tabPanel[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");

  }
  document.getElementById(tabList).style.display = "block";

  evt.currentTarget.className += " active";
}

  // Get the element with id="defaultOpen" and click on it
  document.getElementById("defaultOpen").click();
// -----------------------頁籤切換結束------------------------