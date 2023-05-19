/***************************************
 * http://deseloper.org/
 * 사용방법
	modalWindow.windowId = "layerPopup";
	modalWindow.width = 400;
	modalWindow.height = 250;
	//modalWindow.content = "<iframe width='"+w+"' height='"+h+"' frameborder='0' scrolling='no' allowtransparency='true' src='" + url + "'></iframe>";
	modalWindow.content = data;
	modalWindow.open();
 **************************************/
var modalWindow = {
	parent:"body",
	windowId:null,
	content:null,
	width:null,
	height:null,
	close:function()
	{
		$(".modal-window").fadeOut("fast", function(){
                    $(".modal-window").remove();
                });
		$(".modal-overlay").fadeOut("fast", function(){		
                    $(".modal-overlay").remove();
                });
	},
	open:function()
	{
		// modal 클래스가 존재하면 레이어를 제거
		$(".modal-window").remove();
		$(".modal-overlay").remove();

		// modal popup - html 생성
		var modal = "";
		modal += "<div class=\"modal-overlay\"></div>";
		modal += "<div id=\"" + this.windowId + "\" class=\"modal-window\" style=\"width:" + this.width + "px; height:" + this.height + "px; margin-top:-" + (this.height / 2) + "px; margin-left:-" + (this.width / 2) + "px;\">";
		modal += this.content;
		modal += "</div>";	

		// modal open
		$(this.parent).append(modal);

		// 고정으로 close 버튼 넣을시
		//$(".modal-window").append("<a class=\"close-window\"></a>");
		//$(".close-window").click(function(){modalWindow.close();});

		$(".modal-overlay").click(function(){modalWindow.close();});
		$(".modal-close").click(function(){modalWindow.close();});
	}
};