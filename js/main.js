// MAIN APPLY popup close
function closeMainPop() {
    setCookieToday( "todayCookie", "done" , 1);
    $(".pop-apply").fadeOut();
}


// 쿠키 입력
function set_cookie(name, value, expirehours, domain) {
    var today = new Date();
    today.setTime(today.getTime() + (60*60*1000*expirehours));
    document.cookie = name + "=" + escape( value ) + "; path=/; expires=" + today.toGMTString() + ";";
    if (domain) {
        document.cookie += "domain=" + domain + ";";
    }
}
 
// 쿠키 얻음
function get_cookie(name) {
    var find_sw = false;
    var start, end;
    var i = 0;
    for (i=0; i<= document.cookie.length; i++) {
        start = i;
        end = start + name.length;
         if(document.cookie.substring(start, end) == name) {
            find_sw = true
            break
        }
    }
    if (find_sw == true) {
        start = end + 1;
        end = document.cookie.indexOf(";", start);
        if(end < start) end = document.cookie.length;
        return unescape(document.cookie.substring(start, end));
    }
    return "";
}
 
 
function setLayerPopupOpen( name ) {
   var cc_name    = get_cookie( name ); 
	   if(cc_name != "") { 
      $('.' + name).fadeOut();
      
      $('html, body').removeClass('scroll-disable');

   } else {
       $('.' + name).fadeIn();

       $('html, body').addClass('scroll-disable');    
   }
} 

 
function setLayerPopupClose(name, expirehours) {
    $('.' + name).fadeOut();
    if( expirehours > 0  ) set_cookie(name, 'done', expirehours, "");
}


$(function() {
    document.cookie = 'cross-site-cookie=bar; SameSite=None; Secure';
    //document.cookie = 'same-site-cookie=foo; SameSite=Lax';
    
    //setLayerPopupOpen('pop-apply');
    //setLayerPopupOpen('popup-noti');
    
    $('.btnPopClose').click(function() {        
        if($("input:checkbox[name='chkToday']").is(":checked")) {
            setLayerPopupClose('pop-apply', 24);
        } else {
            $('.pop-apply').fadeOut();
        }        
    });
});






jQuery(document).ready(function($) {    
  let window_w = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;

  responsiveImage(window_w);
  

  // NEWS slide
  let news_slide = $(".news-slide").slick({
    infinite: false,
    vertical: true
  });

  // BANNER counter
  $('.counter').counterUp();

  // ALBUM slide
  // let albume_slide = $(".album-list").slick({
  //   infinite: false,
  //   slidesToShow: 1,
  //   slidesToScroll: 1,
  //   mobileFirst: true,
  //   dots: true,
  //   responsive: [{
  //     breakpoint: 768,
  //     settings: 'unslick'
  //   }]
  // });
  // let albume_slide = $(".album-list").slick({
  //   infinite: false,
  //   slidesToShow: 3,
  //   slidesToScroll: 1,
  //   // mobileFirst: true,
  //   dots: false,
  //   responsive: [{
  //     breakpoint: 769,
  //     settings: {
  //       slidesToShow: 1,
  //       slidesToScroll: 1,
  //       dots: true
  //     }
  //   }]
  // });
 
 

  // POPUP NOTIFICATION 


    $(".btn-noti-close").on("click", function() {        
        if($("input:checkbox[name='chkPopToday']").is(":checked")) {
            setLayerPopupClose('popup-noti', 24);
        } else {
            $(".popup-noti").hide();
        }       
        
        $('html, body').removeClass('scroll-disable');
    });




  // VIDEO
  let main_vid = document.getElementById("mainVid");
  $(".btn-play").on("click", function () {
    $('body').addClass('scroll-disable');
    $(".vid-pop").addClass("show");
  });
  $(".btn-vid-close").on("click", function(){
    $('body').removeClass('scroll-disable');
    $(".vid-pop").removeClass("show");
    main_vid.pause();
    main_vid.currentTime = 0;
  });




  // SNS slide
  let sns_slide = $(".sns-slide").slick({
    dots: false,
    appendArrows: ".sns-arrows",
    slidesPerRow: 1,
    slidesToShow: 4,
    rows: 1,
    responsive: [{
      breakpoint: 769,
      settings: {
        dots: true,
        slidesPerRow: 2,
        slidesToShow: 1,
        rows: 2
      }
    }]
  });





  // SNS FILTER
  $(".btn-all").on("click", function () {
    sns_slide.slick('slickUnfilter');
  });
  $(".btn-insta").on("click", function () {
    sns_slide.slick('slickUnfilter');
    sns_slide.slick('slickFilter', '.insta');
  });
  $(".btn-facebook").on("click", function () {
    sns_slide.slick('slickUnfilter');
    sns_slide.slick('slickFilter', '.facebook');
  });
  $(".btn-blog").on("click", function () {
    sns_slide.slick('slickUnfilter');
    sns_slide.slick('slickFilter', '.blog');
  });


 


  // MEMBERS fade slide
  let members_slide = $(".mem-slide").slick({
    dots: true,
    infinite: false,
    arrows: false,
    speed: 500,
    fade: true,
    cssEase: 'linear',
    slidesToShow: 1,
    slidesToScroll: 1,
    responsive: [{
      breakpoint: 769,
      settings: {
        arrows: true
      }
    }]
  });



  $(window).on("resize", function () {
    window_w = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;

    news_slide.slick('resize');
    members_slide.slick('resize');
    sns_slide.slick('resize');



  });










  var $carousel = $('.album-list');
  function showSliderScreen($widthScreen) {
    if ($widthScreen <= "768") {
      if (!$carousel.hasClass('slick-initialized')) {
        $carousel.slick({
          infinite: false,
          slidesToShow: 1,
          slidesToScroll: 1,
          mobileFirst: true,
          dots: true
        });
      }
    } else {
      if ($carousel.hasClass('slick-initialized')) {
        $carousel.slick('unslick');
      }
    }
  }

  var widthScreen = $(window).width();
  $(window).ready(showSliderScreen(widthScreen)).resize(
    function () {
      var widthScreen = $(window).width();
      showSliderScreen(widthScreen);
    }
  );




  







});













