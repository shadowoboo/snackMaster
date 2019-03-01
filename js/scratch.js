
// --------------------------------------------



function doFirst() {
  setInterval(showGame, 10000);
}
function showGame() {
  var random = (Math.floor(Math.random() * 10) + 1) * 1000;
  randomTimer = setInterval(randomGame, random);
}
function randomGame() {
  var game = document.getElementById('game');
  game.classList.remove('fadeOut');
  game.classList.add('fadeIn');
  clearInterval(randomTimer);
  catchTimer = setInterval(gameCountdown, 5000);
}
function gameCountdown() {
  game.classList.add('fadeOut');
  game.classList.remove('fadeIn');
  clearInterval(catchTimer);
}



function pickCp() {
  var cpImg = Math.floor(Math.random() * 3) + 1;
  switch (cpImg) {
    case 1:
      var d = 'd50';
      price = '50';
      break;
    case 2:
      var d = 'd100';
      price = '100';
      break;
    case 3:
      var d = 'd200';
      price = '200';
      break;
  }
  $('#scratchWrapCoupon').html(`<img class='shake-slow' src="../images/coupon/${d}.png">`);
  $('#scratchWrapCount').html(`<h3>${price}元優惠券</h3>`);
  $('#scratchWrapCoupon').attr({ 'd': d, 'price': price });
}

function scratchSetting() {
  // "use strict";
  pickCp()
  var isDrawing, lastPoint;
  var container = document.getElementById("scratch"),
    canvas = document.getElementById("gameCanvas"),
    canvasWidth = canvas.width,
    canvasHeight = canvas.height,
    ctx2 = canvas.getContext("2d"),
    image = new Image(),
    brush = new Image();

  image.src = "../images/game/itemB.svg";
  image.onload = function () {
    ctx2.drawImage(image, 0, 0);
  };
  brush.src = "../images/game/scratchBrush.png";

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

    // if (canvas.offsetParent !== undefined) {
    //   do {
    //     offsetX += canvas.offsetLeft;
    //     offsetY += canvas.offsetTop;
    //   } while ((canvas = canvas.offsetParent));
    // }

    // offsetX += canvas.offsetLeft;
    // offsetY += canvas.offsetTop;
    mx = offsetX = e.offsetX || (e.touches[0].pageX - canvas.offsetLeft);
    my = offsetY = e.offsetY || (e.touches[0].pageY - canvas.offsetTop);
    console.log(`mx: ${mx} ----- my: ${my}`);


    // mx = (e.pageX || e.touches[0].clientX) - offsetX;
    // my = (e.pageY || e.touches[0].clientY) - offsetY;
    // console.log( "currentPoint :", { x: mx, y: my })
    return { x: mx, y: my };
  }

  function handlePercentage(filledInPixels) {
    filledInPixels = filledInPixels || 0;
    // console.log(filledInPixels + "%");
    if (filledInPixels > 75) {
      //範圍
      canvas.parentNode.removeChild(canvas);
      $('.scratchWrapIp img').addClass('rotate')
      //1.刮完之後 ip會動
      //2.開始偵測是否登入
      // if($('#btnloglout').text()=='登出'){}
      if ($('#btnloglout').text() == '登出') {
        sendCp();
        // $('#cJump p').html(`恭喜你獲得了${price}元優惠券！<br>(已自動存入優惠券夾)`);
        $('#endGame').click(byebye);

      } else {
        $('#scratchWrapCount').html(`<h4>恭喜你獲得了${price}元優惠券！<br>(請登入會員才能領取優惠券)</h4>`);
        $('#endGame').text('去登入').click(function () {
          showLightBox();
          $('#endGame').off('click');
          checkLogin();
        });

      }
      //2-1.登入了 把優惠券寫進資料庫
      //2-2.沒登入 打開登入燈箱 開始監聽登入動作 直到登入後 跳回2-1;
      //3-1.沒拿過 成功寫入 
      //3-2.拿過 告訴她只能拿一張
    }
    function checkLogin(price) {
      if ($('#btnloglout').text() == '登出') {
        $('#endGame').text('確定');
        sendCp();
      } else {
        setTimeout(checkLogin, 1000);
      }
    }
    function sendCp() {
      var price = $('#scratchWrapCoupon').attr('price');
      switch (price) {
        case '50':
          coupNo = 1;
          break;
        case '100':
          coupNo = 2;
          break;
        case '200':
          coupNo = 3;
          break;
      }
      var xhr = new XMLHttpRequest();
      xhr.open("Post", "sendCp.php", true);
      xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      var data_info = `coupNo=${coupNo}`;
      xhr.send(data_info);
      xhr.onload = function () {
        if (xhr.responseText == 1) {
          //成功
          $('#scratchWrapCount').html(`<h4>恭喜你獲得了${price}元優惠券！<br>(已自動存入優惠券夾)</h4>`);
          $('#endGame').click(byebye);
        } else {
          //已經拿過
          $('#scratchWrapCount').html(`<h4>恭喜你完成遊戲，但是你已經領過同樣的優惠券囉！</h4>`);
          $('#endGame').click(byebye);
        }
      }

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
    // console.log( "y :",e.offsetY);
    // console.log( "x : ",e.offsetX);
    // console.log( e.clientY);
    // console.log( e.clientX);

    var currentPoint = getMouse(e, canvas),
      dist = distanceBetween(lastPoint, currentPoint),
      angle = angleBetween(lastPoint, currentPoint),
      x,
      y;

    // console.log( "currentPoint :", currentPoint)

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

  function byebye() {
    $('.fullPage').remove();
  }

}


$(document).ready(function () {

  var chocoR = `<div id="game" class="gameScratch"><img src="../images/index/gameImgR.png" alt="遊戲圖"><p>限時刮刮樂<br>刮出優惠券！</p></div>`;
  var scratch = `
      <link rel="stylesheet" href="../css/scratch.css">
          <section class="fullPage">
              <div class="scratch" id="scratch">
                  <img id="bgGlow" src="../images/rankBoard/cpGlow.svg">
                  <div class="scratchWrap">
                      <div id="scratchWrapCoupon">
                      </div>
                      <div id="scratchWrapCount">
                      </div>
                      <div class="scratchWrapIp">
                          <img src="../images/game/scratchIp.png" alt="零食怪">
                          <img src="../images/game/scratchIp1.png" alt="零食怪">
                          <img src="../images/game/scratchIp2.png" alt="零食怪">
                          <img src="../images/game/scratchIp3.png" alt="零食怪">
                          <img src="../images/game/scratchIp4.png" alt="零食怪">
                      </div>
                      <button class='step' id="endGame"> 確定 </button>
                  </div>
                  <canvas class="gameGanvas " id="gameCanvas" width="370" height="600"></canvas>
              </div>
          </section>`;
  $('body').append(chocoR);
  doFirst();
  $('.gameScratch').click(function () {
    // alert('true');
    // e.preventDefault();
    $('body').append(scratch);
    scratchSetting();
  });

})

window.addEventListener('load', doFirst);