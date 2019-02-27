// // function doFirst(){
// // 	var canvas = document.getElementById('canvas');
// // 	context = canvas.getContext('2d');

// // 	canvas.addEventListener('mousedown',usePen);
// // 	//要先有一個滑鼠事件，每當滑鼠移動就執行usePen的函式
	
// // }
// // function usePen(e){
// // 	context.fillStyle = 'red';

// // 	context.beginPath(); //每次移動就要從新開始
// // 	context.arc(e.pageX,e.pageY,5,0,2*Math.PI,true);//圓心要偵測page的x.y座標
// // 	context.fill();
// // }
// // window.addEventListener('load',doFirst);

// function $id(id) {
//     return document.getElementById(id);
//   }
//   function $class(className) {
//     return document.getElementsByClassName(className);
//   }
//   function $all(all) {
//     return document.querySelectorAll(all);
//   }
// //   document.getElementById("close-search").addEventListener("click", function() {
// //     searchImg();
// //     //   searchAjax();
// //   });
  
// //   function searchImg() {
// //     var grouponTagName = document.getElementsByName("groupon-TagName");
// //     var N = "images/icon/tag_N.svg";
// //     var Y = "images/icon/tag_Y.svg";
// //     grouponTagName[0].checked = true;
// //     document.querySelectorAll('.groupon-TagName img')[0].src=Y;
// //     for (let i = 0; i < grouponTagName.length; i++) {
// //       grouponTagName[i].addEventListener("input", function() {
// //         var b = $(this)
// //           .parent()
// //           .find($(".groupon-TagName")[i])
// //           .find($("img"));
// //         if ((grouponTagName[i].checked = true)) {
// //           $(".groupon-TagName")
// //             .find($("img"))
// //             .attr("src", N);
// //           b.attr("src", Y);
// //         }
// //       });
// //     }
// //   }
  
// //   var markGroupon = document.getElementById("bookmark-animation-groupon");
// //   var markMeal = document.getElementById("bookmark-animation-meal");
// //   var markGrouponText = $id("bookmark-animation-groupon").innerText;
// //   var markMealText = $id("bookmark-animation-meal").innerText;
// //   // var markSearchValue = markSearch.placeholder;
// //   markGroupon.addEventListener("click", function() {
// //     $id("input-search").placeholder="請輸入" + markGrouponText + "關鍵字";
// //   });
// //   markMeal.addEventListener("click", function() {
// //     $id("input-search").placeholder="請輸入" + markMealText + "關鍵字";
// //   });
// //   $id('start-search').addEventListener('click',function () {
// //     var searchText = [];
// //     inputText = $id('input-search').innerText;
// //     searchText =  inputText.split(" ");
// //     // startSearch(searchText); 
// //   },false);
  
// //   function startSearch(searchGO) {
  
// //     if($id('bookmark-meal').checked==true){
  
// //       var xhr = new XMLHttpRequest();
// //       xhr.onload = function(){
// //         if( xhr.status == 200){
// //           window.alert(xhr.responseText);
// //           location.href = 'searchToMealUpshot.php';
// //         }else{
// //           alert(xhr.status);
// //         }
// //       }
// //       xhr.open("post","searchToMeal.php",true);
// //       var GOsearch = new FormData(document.getElementById("GOsearch"))
// //       xhr.send(GOsearch);
  
// //     }else if($id('bookmark-groupon').checked==true){
// //       var xhr = new XMLHttpRequest();
// //       xhr.onload = function(){
// //         if( xhr.status == 200){
// //           window.alert(xhr.responseText);
// //           location.href = 'searchToGrouponUpshot.php';
// //         }else{
// //           alert(xhr.status);
// //         }
// //       }
// //       xhr.open("post","searchToGroupon.php",true);
// //       var GOsearch = new FormData(document.getElementById("GOsearch"))
// //       xhr.send(GOsearch);
// //     }
  
// //   function searchAjax() {
// //     //傳PHP端
// //     var obj = {};
// //     obj.meal_Genre = "meal_Genre";
// //     obj.grouponTag = "grouponTag";
// //     var jsonStr = JSON.stringify(obj);
  
// //     //=====使用Ajax 回server端,取回關鍵字內容, 放到頁面上
// //     var xhr = new XMLHttpRequest();
// //     xhr.onload = function() {
// //       if (xhr.status == 200) {
// //         if (xhr.responseText.indexOf("not found") != -1) {
// //           //回傳的資料中有not found
// //           // return "";
// //           alert("not found");
// //         } else {
// //           //查有此keyword
// //           alert("OK");
// //         }
// //       } else {
// //         alert(xhr.status);
// //       }
// //     };
// //     xhr.open("post", "searchAjax.php", true);
// //     xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
// //     var data_info = "jsonStr=" + jsonStr;
// //     xhr.send(data_info);
// //   }
  















// --------------------------------------------
(function() {
    "use strict";
  
    var isDrawing, lastPoint;
    var container = document.getElementById("scratch"),
      canvas = document.getElementById("gameCanvas"),
      canvasWidth = canvas.width,
      canvasHeight = canvas.height,
      ctx2 = canvas.getContext("2d"),
      image = new Image(),
      brush = new Image();
  
    image.src = "../images/game/itemB.svg";
    image.onload = function() {
      ctx2.drawImage(image, 0, 0);
    };
    brush.src = "../images/index/indexScratch_brush.png";
  
    canvas.addEventListener("mousedown", handleMouseDown, false);
    canvas.addEventListener("touchstart", handleMouseDown, false);
    canvas.addEventListener("mousemove", handleMouseMove, false);
    canvas.addEventListener("touchmove", handleMouseMove, false);
    canvas.addEventListener("mouseup", handleMouseUp, false);
    canvas.addEventListener("touchend", handleMouseUp, false);
  
    function distanceBetween(point1, point2) {
      return Math.sqrt(
        Math.pow(point2.x - point1.x, 2) + Math.pow(point2.y - point1.y, 2)
      );
    }
  
    function angleBetween(point1, point2) {
      return Math.atan2(point2.x - point1.x, point2.y - point1.y);
    }
  
    function getFilledInPixels(stride) {
      if (!stride || stride < 1) {
        stride = 1;
      }
  
      var pixels = ctx2.getImageData(0, 0, canvasWidth, canvasHeight),
        pdata = pixels.data,
        l = pdata.length,
        total = l / stride,
        count = 0;
  
      for (var i = (count = 0); i < l; i += stride) {
        if (parseInt(pdata[i]) === 0) {
          count++;
        }
      }
  
      return Math.round((count / total) * 100);
    }
  
    function getMouse(e, canvas) {
      var offsetX = 0,
        offsetY = 0,
        mx,
        my;
  
      if (canvas.offsetParent !== undefined) {
        do {
          offsetX += canvas.offsetLeft;
          offsetY += canvas.offsetTop;
        } while ((canvas = canvas.offsetParent));
      }
  
      mx = (e.pageX || e.touches[0].clientX) - offsetX;
      my = (e.pageY || e.touches[0].clientY) - offsetY;
  
      return { x: mx, y: my };
    }
  
    function handlePercentage(filledInPixels) {
      filledInPixels = filledInPixels || 0;
    //   console.log(filledInPixels + "%");
      if (filledInPixels > 80) {
        //範圍
        canvas.parentNode.removeChild(canvas);
      }
    }
  
    function handleMouseDown(e) {
      isDrawing = true;
      lastPoint = getMouse(e, canvas);
    }
  
    function handleMouseMove(e) {
      if (!isDrawing) {
        return;
      }
  
      e.preventDefault();
  
      var currentPoint = getMouse(e, canvas),
        dist = distanceBetween(lastPoint, currentPoint),
        angle = angleBetween(lastPoint, currentPoint),
        x,
        y;
  
      for (var i = 0; i < dist; i++) {
        x = lastPoint.x + Math.sin(angle) * i - 25;
        y = lastPoint.y + Math.cos(angle) * i - 25;
        ctx2.globalCompositeOperation = "destination-out";
        ctx2.drawImage(brush, x, y);
      }
  
      lastPoint = currentPoint;
      handlePercentage(getFilledInPixels(32));
    }
  
    function handleMouseUp(e) {
      isDrawing = false;
    }
  })();
  