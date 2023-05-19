//Responsive Image
function responsiveImage(window_w) {
  var device = "media-pc";
  var img = $(".responsive-image");
  var obj;

  if (window_w <= 768) {
      device = "media-mobile";
  } else if (window_w > 768) {
      device = "media-pc";
  } 

  for (var i = 0; i < img.length; i++) {
      obj = img.eq(i);
      if (obj.data(device)) {
          obj.attr('src', obj.data(device));
      }
  }
}


jQuery(document).ready(function($) {
  let window_w = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
  responsiveImage(window_w);
  
  $(window).on("resize",function(){
    window_w = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
    responsiveImage(window_w);

  });

  // HEADER MENU PC-VER
  $(".nav").hover(function() {
    $("header").addClass("nav-over");
    $(".sub-nav").stop().slideDown();
  }, function() {
    $(".sub-nav").stop().slideUp(function() {
      $("header").removeClass("nav-over");
    });
  });
  // HEADER MENU MOBILE-VER
  $(".btn-menu-open").on("click", function(){
    $(".dim-layer").addClass("show");
    $("nav.mobile-ver").addClass("open");

    $(window).on("resize orientationchange", function() {
      window_w = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
      if (window_w > 768) {
        $('body').removeClass('scroll-disable');
        $("nav.mobile-ver").removeClass("open");
        $(".dim-layer").removeClass("show");
      }
    });
  });
  $(".btn-menu-close").on("click", function () {
    $('body').removeClass('scroll-disable');
    $("nav.mobile-ver").removeClass("open");
    $(".dim-layer").removeClass("show");
  });
  $(".tabs .tab").on("click", function(){
    let ord = $(this).index();
    $(".tabs .tab").removeClass("selected");
    $(this).addClass("selected");
    $(".panel").removeClass("on").eq(ord).addClass("on");
  });











  // FOOTER FAMILY SITE 
  $(".btn-dropdown").on("click", function(){
    if($(".fam-site").hasClass("active")) {
      $(".fam-site").removeClass("active");
    } else {
      $(".fam-site").addClass("active");
    }
  });

  // goTop Button  
	$(window).scroll(function() {
    let sTop = $(window).scrollTop();

	if(sTop > 0) {
      $(".goTop").fadeIn();
      $(".goTop").removeClass("stop");
    } else {
      $(".goTop").fadeOut();
    }
    
    if(sTop > $("footer").offset().top - window.innerHeight) {
      $(".goTop").addClass("stop");
		}
	});
	$(".goTop").on("click", function() {
    $("html, body").animate({scrollTop:0}, 400);
	});


});










// 페이지 리프레쉬
function pageReload() {
    location.reload();
}



// 필수 입력 값 포커스 이동하여 Background 변경
function setFocus(obj){
    obj.focus();
    obj.css('background', '#ff0'); // will change the background to yellow
    obj.css('background', '#FFAAAA'); // will change the background to yellow
}

// 필수 입력 값.. 다시 입력 시 Background 초기화
$(document).on('keyup change', '.form-control', function(){
    if ($(this).val().length > 0) {
        $(this).css('background', 'initial');
    }
});



//숫자만 입력하는 입력박스..
//keyup 시 숫자 이외의 문자 제거..
$(document).on("keyup", ".numeric", function() {
    $(this).val( $(this).val().replace(/[^0-9]/gi,"") );
    //$(this).val( $(this).val().replace(/[^\-0-9]/gi,"") );   // '-', '0~9' 까지를 제외한 나머지는 "" 처리
});
/*//blur 시 콤마찍기..
$(document).on("blur", ".numeric", function() {
    $(this).val( comma($(this).val()) );
});
//focus 시 꼼마풀기..
$(document).on("focus", ".numeric", function() {
    $(this).val( uncomma($(this).val()) );
});*/

//첨부파일 표시
$(document).on("click", "#btn_add_file", function() {
    $('#add_file').change(function() {
        var filename = $('#add_file').val();
        var dd = filename.split("\\");
        filename = dd[dd.length-1];

        //console.log(filename);
        $('#add_url').val(filename);
    });
});


//콤마찍기
function comma(str) {
    str = String(str);
    return str.replace(/(\d)(?=(?:\d{3})+(?!\d))/g, '$1,');
}

//콤마풀기
function uncomma(str) {
    str = String(str);
    //return str.replace(/[^\d]+/g, '');
    return str.replace(/[^-^\d]+/g, '');   // '-' 허용
}

//값 입력시 콤마찍기
function inputNumberFormat(obj) {
    obj.value = comma(uncomma(obj.value));
}



/*
 * 날짜 계산 - 년
 * 예) calYear('2018-05-21', 5);
 * return {yyyy:년, mm:월, dd:일}
 */
function calYear(date, val) {
    var dt = new Date(date);
    dt.setYear(dt.getFullYear() + val);
    var year = dt.getFullYear();
    var month = dt.getMonth() + 1;
    var day = dt.getDate();

    var yyyy = year;
    var mm = ("0"+month).substr(-2);
    var dd = ("0"+day).substr(-2);
    var result = {
        yyyy : yyyy,
        mm : mm,
        dd : dd
    };
    
    return result;
}

/*
 * 날짜 계산 - 월
 * 예) calMonth('2018-05-21', 5);
 * return {yyyy:년, mm:월, dd:일}
 */
function calMonth(date, val) {
    var dt = new Date(date);
    dt.setMonth(dt.getMonth() + val);
    var year = dt.getFullYear();
    var month = dt.getMonth() + 1;
    var day = dt.getDate();

    var yyyy = year;
    var mm = ("0"+month).substr(-2);
    var dd = ("0"+day).substr(-2);
    var result = {
        yyyy : yyyy,
        mm : mm,
        dd : dd
    };
    
    return result;
}

/*
 * 날짜 계산 - 일
 * 예) calDay('2018-05-21', 5);
 * return {yyyy:년, mm:월, dd:일}
 */
function calDay(date, val) {
    var dt = new Date(date);
    dt.setDate(dt.getDate() + val);
    var year = dt.getFullYear();
    var month = dt.getMonth() + 1;
    var day = dt.getDate();

    var yyyy = year;
    var mm = ("0"+month).substr(-2);
    var dd = ("0"+day).substr(-2);
    var result = {
        yyyy : yyyy,
        mm : mm,
        dd : dd
    };
    
    return result;
}



// jQuery Ajax - 예) jQueryAjax("/member/info")
function jQueryAjax(url, func) {
    $.get(url,function(data,status){
        if (status == "success") {
            eval(func);
        } else {
            alert("Error occured!");
        }
    });
}

// jQuery Ajax - 예) jQueryAjaxView("/member/info", $('#member-info'))
function jQueryAjaxView(url, obj) {
    $.get(url,function(data,status){
        if (status == "success") {
            obj.html(data);
        } else {
            alert("Error occured!");
        }
    });
}

//jQuery Ajax Form Send - 예) jQueryAjaxForm(jQuery Form 객체, success 후 실행 함수 스크립트 작성)
function jQueryAjaxForm(form, func) {
 $.ajax({
     url : form.attr('action'),
     type : 'post',
     cache : false,
     data : form.serialize(),
     //dataType : 'json',
     success: function(data) {
         //data.replace(/(\s*)/g, "");
         data.replace(/ /gi, '');
         if (data) {
             eval(data);
         } else {
             if (func != null)
                 eval(func);
         }
     },
     error : function(result) {
         alert("Error occured!");
     }
 });
}

//jQuery Ajax Form Send View - 예) jQueryAjaxFormView(jQuery Form 객체, $('#member-info'))
function jQueryAjaxFormView(form, obj) {
 $.ajax({
     url : form.attr('action'),
     type : 'post',
     cache : false,
     data : form.serialize(),
     //dataType : 'json',
     success: function(data) {
    	 obj.html(data);
     },
     error : function(result) {
         alert("Error occured!");
     }
 });
}



//쿠키정보 가져오기
function get_cookie(cookie_name) {
    var results = document.cookie.match ( '(^|;) ?' + cookie_name + '=([^;]*)(;|$)' );
    
    if (results)
        return (unescape(results[2]));
    else
        return null;
}



//이메일 정규표현식 체크
function getEmailCheck(email) {
	var result = false;
	
	var regExp = /^[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*.[a-zA-Z]{2,3}$/i;
	// 검증에 사용할 정규식 변수 regExp에 저장

	if (email.match(regExp) != null) {
		result = true;
	} else {
		result = false;
	}
	
	return result;
}


