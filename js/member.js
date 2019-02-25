
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
var clmem = false;
  function changeInfo(e) {
    // console.log($id('memInfon').readOnly);
    // console.log("123");
    // $("#memInfon").attr("readonly");
    // console.log($("#memInfon").attr("readonly"));

    // var valt = $("#memInfon").text();
    // var val = $("#memInfon").val();
    // if(!clmem){
    //   // console.log("開");
    //   clmem = true;
    //   document.getElementById("memIfon-p").innerHTML= "帳號：<input type='text' name='memId' value='"+val+"' maxlength='15' id='memIfon'>  <img src='../images/tina/pen.png' alt='編輯' id='infoChange'>";
    //   $id('infoChange').addEventListener('click', changeInfo);
    // }else if(clmem){
    //   clmem = false;
    //   // console.log("關");
    //   document.getElementById("memIfon-p").innerHTML = "帳號：<input type='text' name='memId' value='"+val+"' maxlength='15' id='memIfon' readonly>  <img src='../images/tina/pen.png' alt='編輯' id='infoChange'>";
    //   $id('infoChange').addEventListener('click', changeInfo);
    // }
    


  }




  function doFirst() {
    // console.log("aa");
    $id('upFile').onchange = headChange;
    $id('infoChange').addEventListener('click', changeInfo);


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