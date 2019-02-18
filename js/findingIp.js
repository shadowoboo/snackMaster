 function byebye() {
   $('#findingIp').remove();

 }

 function byebye2() {
  //  $('#findingIp').html('').append(forReplay);
  $('#findingIp').remove();
  $('body').append(findingIp);
  setting();

 }
 function setting() {
 var forReplay = $('#content').clone(true);
 var box1 = $("#box1"),
   box2 = $("#box2"),
   box3 = $("#box3"),
   kick = $("#kick_jump"),
   startButton = $("#start_game"),
   messageBar = $("#msg_bd"),
   kickDropDownAnimationDelay = 1500,
   shuffleSpeed = 500,
   nuberOfShuffels = 1,
   z = 0;

 var ans = Math.floor(Math.random() * 3) + 1;



 $('#cancel').click(byebye);
 startButton.on("click", function (event) {
   event.preventDefault();
   var kickInitialPosition = 0;
   //Show the character fist
   kick.show();
   // Show the message "Starting the game"
   setMessage("<span class='sure' id='start_game' >準備開始囉！</span >", "color_0");
   // Update the initial position based on the answer
   var ansBox = $('.boxes')[ans - 1];
   var ajst = $(ansBox).width() * 0.116;
   var ajst2 = $(ansBox).width() * 0.231;
   var ajst3 = $(ansBox).width() * 0.042;
   kickInitialPosition = $(ansBox).position().left + ajst;
   console.log(kickInitialPosition);
   // Move kick Under the relative box based on answer
   kick.css({
     left: kickInitialPosition + "px"
   });

   // Droping kick from the top into the box.

   var dropPoint = $(ansBox).position().top;
   kick.animate({
     top: dropPoint + "px"
   }, {
     duration: kickDropDownAnimationDelay,
     specialEasing: {
       top: 'easeOutBounce'
     },
     complete: function () {
       // kick.html("<img src='https://websiddu.github.com/3cups/img/kick_smile.png' alt='' />");
       kick.html("<img src='../images/game/findingIp-02-01.png' alt='' />");
       kick.animate({
         top: dropPoint + ajst2 + "px"
       }, {
         duration: 500,
         specialEasing: {
           top: 'easeInQuint'
         },
         complete: function () {
           setMessage("<span class='sure' id='start_game' >箱子要關起來囉!</span >")

           // Close all the three boxes in a regular interval.
           box1.delay(500).queue(function (n) {
             $(this).html("<img src='https://websiddu.github.com/3cups/img/box_c.png' alt='' />");
             if (ans == 1) kick.hide();
             n();
           });
           box2.delay(1000).queue(function (n) {
             $(this).html("<img src='https://websiddu.github.com/3cups/img/box_c.png' alt='' />");
             if (ans == 2) kick.hide();
             n();
           });
           box3.delay(1500).queue(function (n) {
             $(this).html("<img src='https://websiddu.github.com/3cups/img/box_c.png' alt='' />");
             if (ans == 3) kick.hide();


             var box1_left = box1.position().left,
               box2_left = box2.position().left,
               box3_left = box3.position().left,
               box_top = box3.position().top;

             box1.css({
               position: "absolute",
               top: box_top + "px",
               left: box1_left + "px"
             });

             box2.css({
               position: "absolute",
               top: box_top + "px",
               left: box2_left + "px"
             });

             box3.css({
               position: "absolute",
               top: box_top + "px",
               left: box3_left + "px"
             });

             shuffle = function (o) { //v1.0
               for (var j, x, i = o.length; i; j = parseInt(Math.random() * i), x = o[--i], o[i] = o[j], o[j] = x);
               return o;
             };

             var interval = setInterval(function () {

               setMessage("<span class='sure' id='start_game' >看仔細囉...</span >");



               var array = shuffle([1, 2, 3]);

               $("#box" + array[0]).animate({
                 left: $("#box" + array[1]).position().left + "px"
               }, {
                 duration: shuffleSpeed / 2,
                 specialEasing: {
                   left: 'easeInQuint'
                 }
               });

               $("#box" + array[1]).animate({
                 left: $("#box" + array[0]).position().left + "px"
               }, {
                 duration: shuffleSpeed / 2,
                 specialEasing: {
                   left: 'easeInQuint'
                 }
               });


             }, shuffleSpeed);


             setTimeout(function () {
               clearInterval(interval);
               var flag = 0;
               $('div[id^="box"]').css("cursor", "pointer");
               setMessage("<span class='sure' id='start_game' >好麻吉在哪個箱子呢?</span >")

               box1.click(function () {
                 if (flag == 0) {
                   $(this).html('<img src="https://websiddu.github.com/3cups/img/box_o_t.png" id="box_o_t" alt="">');
                   $(this).append(' <img src="https://websiddu.github.com/3cups/img/box_o_b.png" id="box_o_b" alt="">');
                   if (ans == 1) {
                     kick.css({
                       left: $(this).position().left + ajst + "px"
                     });
                     flag = 1;
                     slide_out();
                   } else {
                     print_error();
                     flag = 1;
                   }
                 }
               });

               box2.click(function () {
                 if (flag == 0) {
                   $(this).html('<img src="https://websiddu.github.com/3cups/img/box_o_t.png" id="box_o_t" alt="">');
                   $(this).append(' <img src="https://websiddu.github.com/3cups/img/box_o_b.png" id="box_o_b" alt="">');
                   if (ans == 2) {
                     kick.css({
                       left: $(this).position().left + ajst + "px"
                     });
                     flag = 1;
                     slide_out();
                   } else {
                     flag = 1;
                     print_error();
                   }
                 }
               });

               $("#box3").click(function () {
                 if (flag == 0) {
                   $(this).html('<img src="https://websiddu.github.com/3cups/img/box_o_t.png" id="box_o_t" alt="">');
                   $(this).append(' <img src="https://websiddu.github.com/3cups/img/box_o_b.png" id="box_o_b" alt="">');
                   if (ans == 3) {
                     kick.css({
                       left: $(this).position().left + ajst + "px"
                     });
                     flag = 1;
                     slide_out();
                   } else {
                     flag = 1;
                     print_error();
                   }
                 }
               });


               function slide_out() {
                 setMessage("<span class='sure' id='start_game' >恭喜你  找到了!</span >", "color_2");
                 kick.show();
                 kick.animate({
                   top: dropPoint - ajst3 + "px"
                 }, {
                   duration: 500,
                   specialEasing: {
                     top: 'easeInQuint'
                   }
                 });
                 setTimeout(() => {
                   $('#cJump').css({
                     'display': 'block',
                     'opacity': '1',
                     'top': '25%'
                   })
                 }, 800);

                 var cpImg = Math.floor(Math.random() * 3) + 1;
                 switch (cpImg) {
                   case 1:
                     var cp = 'cp50';
                     var price = '50';
                     break;
                   case 2:
                     var cp = 'cp100';
                     var price = '100';
                     break;
                   case 3:
                     var cp = 'cp200';
                     var price = '200';
                     break;
                 }
                 $('#cImg').html(`<img src="../images/coupon/${cp}.png">`);
                 $('#cJump p').html(`恭喜你獲得了${price}元優惠券！<br>
                                (已自動存入優惠券夾)`);

               }
               $('#endGame').click(byebye);

               function print_error() {

                 setMessage("<span class='sure' id='start_game' > 答錯了 麻吉不在這個箱子！ <a id='again'> 再試一次 </a> </span >", "color_1");
                  $('.sure').width('60%');
                 $('#again').click(function () {
                   $('#findingIp').html('').append(forReplay);
                   setting();
                 });
               }

             }, nuberOfShuffels * shuffleSpeed);
             n();
           });
         }
       });
     }
   });



 });


 function setMessage(message, color) {
   messageBar.html(message).addClass(color);
 }
}

$('document').ready(function(){

  var findingIp = `
  <section id="findingIp" >
        <div id="content" >
            <div id="cancel">
              X 
            </div> 
            <div id="fbg" >
              <img src = "../images/rankBoard/findingIp.svg" >
            </div>

          <div id="kick_jump" >
            <img src = "../images/game/findingIp-01.png"alt = "" >
          </div> 

          <div id="cJump" >
            <div class="flexWrap">
              <div id="cImg" > </div>
              <p> </p> 
              <a class='sure' id="endGame"> 確定 </a> 
            </div> 
          </div> 

          <h2 id="heading" > 找找零食好麻吉在哪! </h2> 
          <div id="msg_bd" >
            <a class='sure' id="start_game" > 開始遊戲 </a> 
          </div>

          <div id ="board" >
            <div class="boxes" id="box1" >
                <img src="https://websiddu.github.com/3cups/img/box_o_t.png" id="box_o_t">
                <img src="https://websiddu.github.com/3cups/img/box_o_b.png" id="box_o_b" >
            </div> 
            <div class="boxes" id="box2" >
                <img src="https://websiddu.github.com/3cups/img/box_o_t.png" id="box_o_t" >
                <img src="https://websiddu.github.com/3cups/img/box_o_b.png" id="box_o_b" >
            </div> 
            <div class="boxes" id="box3" >
                <img src="https://websiddu.github.com/3cups/img/box_o_t.png" id="box_o_t" >
                <img src="https://websiddu.github.com/3cups/img/box_o_b.png" id="box_o_b" >
            </div>    
          </div>

        </div>

       </section>`



  var gamebox = `<link rel="stylesheet" href="../css/findingIp.css"><div class="gameBox"> <img src="../images/index/gameImgL.png" alt="遊戲圖">
    <p> 玩小遊戲可獲得 <br> 折價優惠券哦！ </p> </div>`
  $('body').append(gamebox);
  $('.gameBox').click(function () {
    $('body').append(findingIp);
    setting();
  })
  });