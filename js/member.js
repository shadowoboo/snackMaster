
function $id(id){
  return document.getElementById(id);
}

function headChange(){
  var file = $id('upFile').files[0];
  var readFile = new FileReader();
  readFile .readAsDataURL(file);
  readFile.addEventListener('load',function(){
    var bigHead = $id('headPic');
    bigHead.src = readFile.result;
    bigHead.style.maxWidth = '200px';
    bigHead.style.maxHeight = '300px';
  });
}
//展開訂單明細
// var listplay = document.getElementsByClassName('listplay');
// function  listshow(e){
  
//   if(listplay.innerText=="訂單明細v"){
//     listplay.innerHTML  = "訂單明細^";
//     document.getElementsByClassName('orderItem').classList.add('expand');
//   }else{
//     listplay.innerHTML = "訂單明細v";
//     document.getElementsByClassName('orderItem').classList.remove('expand');

//   }
  
// }

$(document).ready(function(){
  // console.log(123);
  
  $('.listplay').on('click',function(){
    // console.log(321);
    
    if($(this).text()=="訂單明細v"){
      // console.log('oop');
      
      $(this).text()=="訂單明細^";
    }else{
      $(this).text()=="訂單明細v";
    }
    
    $('.orderItem').toggleClass('expand');
    $('.textDics').value ="";
      
  });
  $('.evaShowbtn').on('click',function(){
    var $tar=$(this).closest(".orderItemList").next();
    $('.evaLightBox').removeClass('show');
    $tar.addClass('show');
  });
  $('.evaLightBoxLeave').on('click',function(){
    $('.evaLightBox').removeClass('show');
    

  });


  
});
//跳出商品評價燈箱
// function showEvaBox(e){
//   $id('evaBox').classList.add('show');
// }
// function leaveEva(e){
//   $id('evaBox').classList.remove('show');
//   $id('textDiscuss').value ="";


// }




function doFirst(){
  $id('upFile').onchange = headChange;

  //展開訂單明細
  // var act_orderList = document.getElementsByClassName('listplay');
  // for (var i = 0; i < act_orderList.length ; i++) {
  //     act_orderList[i].addEventListener("click",function(e){
  //       // alert(act_orderList[0].innerText);
  //       if(act_orderList[i].innerText=="訂單明細v"){
  //         alert(333);
  //         var target = e.target;
  //         target.innerHTML = "訂單明細^";
  //       }else{
  //         var target = e.target;
  //         target.innerHTML = "訂單明細v";
  //       }
        
  //       $id('proEva').classList.toggle('expand');
  //     },false);
  // }
  // var act_evaBox = document.getElementsByName('evaShowbtn');
  // for (var j = 0; j < act_evaBox.length; j++) {
  //   act_evaBox[j].addEventListener('click',showEvaBox);
  // }
  // var act_leaveEva = document.getElementsByClassName('evaShowbtn');
  // for (var x = 0; x < act_leaveEva.length; x++) {
  //    act_leaveEva.addEventListener("click",leaveEva);
    
  // }
  // $id('evaLightBoxLeave').addEventListener('click',leaveEva);
  // $id('evaShow').addEventListener('click',showEvaBox);
  // $id('listMorebtn').addEventListener('click',moreList);
  
}
window.addEventListener('load',doFirst);

//-----------------------頁籤切換------------------------//
function changeTabs(evt, tabList) {
    var i,tablinks,tabPanel;
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
//-----------------------頁籤切換結束------------------------//





