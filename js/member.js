
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

$(document).ready(function () {
  // console.log(123);
  //展開訂單明細
  $('.orderList_btn').on('click', function () {
    // console.log(321);
    if($(this).text() == "訂單明細v") {
      // console.log('oop');
      $('.orderLis_content').removeClass('show');
      let tar = $(this).next().next(); //吃結構
      tar.addClass('show');
      $(this).text("訂單明細^");
    } else {
      $('.orderLis_content').removeClass('show');
      $(this).text("訂單明細v");
    }
  });

});
//-----------會員資料編輯--------------------
function modInfon1(){
  document.getElementById("memId").readOnly = false;
  }
function modInfon2(){
  document.getElementById("memPsw").readOnly = false;
  }
function modInfon3(){
    document.getElementById("memName").readOnly = false;
   } 
  function modInfon4(){
    document.getElementById("memPhone").readOnly = false;
    } 
  function modInfon5(){
      document.getElementById("email").readOnly = false;
     }   
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
        lightEvaBox.classList.toggle('appear');

     });
    
  }

}

window.addEventListener("load",closeBox,false);
//========================評價燈箱結束=========================== 


  function doFirst() {
    // console.log("aa");
    $id('upFile').onchange = headChange;
    // $id('infoChange').addEventListener('click', changeInfo);
    

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