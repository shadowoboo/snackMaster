$('document').ready(function(){

  
    var box1 = $("#box1"),
      box2 = $("#box2"),
      box3 = $("#box3"),
      kick = $("#kick_jump"),
      startButton = $("#start_game"),
      messageBar = $("#msg_bd"),
      kickDropDownAnimationDelay = 1500,
      shuffleSpeed = 500,
      nuberOfShuffels = 5,
      z = 0;
  
    var ans = Math.floor(Math.random() * 3) + 1;
  
    startButton.on("click", function(event) {
      event.preventDefault();
      var kickInitialPosition = 0;
      //Show the character fist
      kick.show();
      // Show the message "Starting the game"
      setMessage("準備開始囉！", "color_0");
      // Update the initial position based on the answer
      var ansBox = $('.boxes')[ans-1];
      var ajst =$(ansBox).width()*0.116;
      var ajst2 = $(ansBox).width()*0.231;
      var ajst3 = $(ansBox).width()*0.042;
      kickInitialPosition = $(ansBox).position().left+ajst;
      console.log(kickInitialPosition);
      // Move kick Under the relative box based on answer
      kick.css({
        left: kickInitialPosition + "px"
      });
  
      // Droping kick from the top into the box.

      var dropPoint = $(ansBox).position().top;
      kick.animate({
        top: dropPoint+"px"
      }, {
        duration: kickDropDownAnimationDelay,
        specialEasing: {
          top: 'easeOutBounce'
        },
        complete: function() {
          kick.html("<img src='https://websiddu.github.com/3cups/img/kick_smile.png' alt='' />");
          kick.animate({
            top: dropPoint+ajst2+"px"
          }, {
            duration: 500,
            specialEasing: {
              top: 'easeInQuint'
            },
            complete: function() {
              setMessage("　箱子要關起來囉！")
  
              // Close all the three boxes in a regular interval.
              box1.delay(500).queue(function(n) {
                $(this).html("<img src='https://websiddu.github.com/3cups/img/box_c.png' alt='' />");
                if(ans == 1) kick.hide();
                n();
              });
              box2.delay(1000).queue(function(n) {
                $(this).html("<img src='https://websiddu.github.com/3cups/img/box_c.png' alt='' />");
                if(ans == 2) kick.hide();
                n();
              });
              box3.delay(1500).queue(function(n) {
                $(this).html("<img src='https://websiddu.github.com/3cups/img/box_c.png' alt='' />");
                if(ans == 3) kick.hide();
  
  
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
  
                shuffle = function(o) { //v1.0
                  for(var j, x, i = o.length; i; j = parseInt(Math.random() * i), x = o[--i], o[i] = o[j], o[j] = x);
                  return o;
                };
  
                var interval = setInterval(function() {
  
                  setMessage("看仔細囉...");
  
  
  
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
  
  
                setTimeout(function() {
                  clearInterval(interval);
                  var flag = 0;
                  $('div[id^="box"]').css("cursor", "pointer");
                  setMessage("好麻吉在哪個箱子呢 ? ")
  
                  box1.click(function() {
                    if(flag == 0) {
                      $(this).html('<img src="https://websiddu.github.com/3cups/img/box_o_t.png" id="box_o_t" alt="">');
                      $(this).append(' <img src="https://websiddu.github.com/3cups/img/box_o_b.png" id="box_o_b" alt="">');
                      if(ans == 1) {
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
  
                  box2.click(function() {
                    if(flag == 0) {
                      $(this).html('<img src="https://websiddu.github.com/3cups/img/box_o_t.png" id="box_o_t" alt="">');
                      $(this).append(' <img src="https://websiddu.github.com/3cups/img/box_o_b.png" id="box_o_b" alt="">');
                      if(ans == 2) {
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
  
                  $("#box3").click(function() {
                    if(flag == 0) {
                      $(this).html('<img src="https://websiddu.github.com/3cups/img/box_o_t.png" id="box_o_t" alt="">');
                      $(this).append(' <img src="https://websiddu.github.com/3cups/img/box_o_b.png" id="box_o_b" alt="">');
                      if(ans == 3) {
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
                    setMessage("恭喜你　找到了！ <a  href=\"javascript:location.reload();\" >收下禮物優惠券</a>", "color_2");
                    kick.show();
                    kick.animate({
                      top: dropPoint-ajst3+"px"
                    }, {
                      duration: 500,
                      specialEasing: {
                        top: 'easeInQuint'
                      }
                    });
  
                  }
  
                  function print_error() {
                    setMessage("答錯了　麻吉不在這個箱子！ <a href=\"javascript:location.reload();\" >重新再來</a>", "color_1");
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
  
  
  
  });