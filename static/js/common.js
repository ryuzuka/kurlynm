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
    //$(this).val( $(this).val().replace(/[^0-9]/gi,"") );
    $(this).val( $(this).val().replace(/[^\-0-9]/gi,"") );   // '-', '0~9' 까지를 제외한 나머지는 "" 처리
});
//blur 시 콤마찍기..
$(document).on("blur", ".numeric", function() {
    $(this).val( comma($(this).val()) );
});
//focus 시 꼼마풀기..
$(document).on("focus", ".numeric", function() {
    $(this).val( uncomma($(this).val()) );
});

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
    $.get(url + "?" + Math.random(),function(data,status){
        if (status == "success") {
            obj.html(data);
        } else {
            alert("Error occured!");
        }
    });
}

// jQuery Ajax Form Send - 예) jQueryAjaxForm(jQuery Form 객체, success 후 실행 함수 스크립트 작성)
function jQueryAjaxForm(form, func) {
    $.ajax({
        url : form.attr('action'),
        type : 'post',
        cache : false,
        data : form.serialize(),
        //dataType : 'json',
        success: function(data) {
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