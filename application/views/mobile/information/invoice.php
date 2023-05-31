    <div class="visual information">
        <div class="text">
            <h2>송장조회</h2>
            <p>고객님이 신청하신 물류의 배송현황을 직접 확인해보세요.</p>
        </div>
    </div>

    <!--: Start #contents -->
    <div class="inner-section if-transport" id="search_from">
      <h3>운송장번호</h3>
      <div class="field-box transport-list">
        <div class="area">
          <div class="input-area js-input">
            <div class="input">
              <input type="text" title="운송장 번호 입력" id="it-invoice1" name="it-invoice1" placeholder="‘-’를 제외한 운송장번호를 입력해주세요.">
              <button type="button" class="btn-clear"><span><span class="blind">입력 텍스트 삭제</span></span></button>
            </div>
          </div>
          <div class="info-box">
            <button type="button" class="btn-add">
              <span class="blind">입력 필드 추가</span>
            </button>
            <div class="inner-layer">
              <span>여러개의 운송장번호를 한번에!</span>
            </div>
          </div>
        </div>
        <div class="area" style="display: none">
          <div class="input-area js-input">
            <div class="input">
              <input type="text" title="운송장 번호 입력" id="it-invoice2" name="it-invoice2" placeholder="‘-’를 제외한 운송장번호를 입력해주세요.">
              <button type="button" class="btn-clear"><span><span class="blind">입력 텍스트 삭제</span></span></button>
            </div>
          </div>
          <button type="button" class="btn-add delete">
            <span class="blind">입력 필드 삭제</span>
          </button>
        </div>
      </div>
      <ul class="list-info">
        <li>3개월 이내의 정보만 조회 가능합니다.</li>
        <li>배송중일경우 실시간 현황이 반영되지 않을 수 있습니다.</li>
        <li>최대 2개의 운송장번호로 동시 조회가 가능합니다.</li>
      </ul>
	    <div class="btn-wrap">
	      <a href="#" id="bt-delivery" class="btn btn-primary">조회하기</a>
	    </div>
    </div>

    <div class="inner-section if-transport del_chk_form" style="display: none;">

          <h3>조회결과</h3>

        <div class="box active">
          <div class="info-number">
            <h4>운송장번호</h4>
            <span id="invoice-no">250-01-123412341234</span>

          </div>
          <div class="info-list">
            <ul id="delivery-status-body">
              <li>마켓컬리<i class="next"></i></li>
              <li>컬리넥스트마일</li>
              <li>배송출발</li>
            </ul>
          </div>

          <div class="atv_box">
            <div class="icon4">
              <ul class="del_step">
                <li>
                  <img src="/mo/image/information/de01.png" class="icon">
                  <p>집화</p>
                </li>
                <li>
                  <img src="/mo/image/information/de02.png" class="icon">
                  <p>TC도착</p>
                </li>
                <li class="on">
                  <img src="/mo/image/information/de03.png" class="icon">
                  <p>배송출발</p>
                </li>
                <li>
                  <img src="/mo/image/information/de04.png" class="icon">
                  <p>배송완료</p>
                </li>
              </ul>
            </div>
            <div class="info_dev">
              <h2></h2>
              <ul id="trace-info-body">
                <li>
                  <p>2022-10-01 15:30</p>
                  <h3>삼형제 고기 <b>집화</b></h3>
                </li>
                <li>
                  <p>2022-10-01 15:30</p>
                  <h3>배송기사 (FC홍길동) <b>TC도착</b></h3>
                </li>
                <li class="on">
                  <p>2022-10-01 15:30</p>
                  <h3>컬러넥스트마일 <b>배송출발</b></h3>
                </li>
              </ul>
            </div>
          </div>

        </div>

      </div>


    <div class="inner-section if-transport result del_chk_form2"  style="display: none;">

        <h3>조회결과</h3>

        <div class="box">
          <div class="info-number">
            <h4>운송장번호</h4>
            <span id="invoice-no1">250-01-123412341234</span>
            <button type="button" class="more-view">
              <span class="blind">배송현황 더보기</span>
            </button>
          </div>
          <div class="info-list">
            <ul id="delivery-status-body1">
              <li>마켓컬리<i class="next"></i></li>
              <li>컬리넥스트마일</li>
              <li>배송출발</li>
            </ul>
          </div>


          <div class="atv_box">
            <div class="icon4">
              <ul class="del_step1">
                <li>
                  <img src="/mo/image/information/de01.png" class="icon">
                  <p>집화</p>
                </li>
                <li>
                  <img src="/mo/image/information/de02.png" class="icon">
                  <p>TC도착</p>
                </li>
                <li class="on">
                  <img src="/mo/image/information/de03.png" class="icon">
                  <p>배송출발</p>
                </li>
                <li>
                  <img src="/mo/image/information/de04.png" class="icon">
                  <p>배송완료</p>
                </li>
              </ul>
            </div>
            <div class="info_dev">
              <h2></h2>
              <ul id="trace-info-body1">
              </ul>
            </div>
          </div>

        </div>


        <div class="box">
          <div class="info-number">
            <h4>운송장번호</h4>
            <span id="invoice-no2"></span>
            <button type="button" class="more-view">
              <span class="blind">배송현황 더보기</span>
            </button>
          </div>
          <div class="info-list">
            <ul id="delivery-status-body2">

            </ul>
          </div>


          <div class="atv_box">
            <div class="icon4">
              <ul class="del_step2">
                <li>
                  <img src="/mo/image/information/de01.png" class="icon">
                  <p>집화</p>
                </li>
                <li>
                  <img src="/mo/image/information/de02.png" class="icon">
                  <p>TC도착</p>
                </li>
                <li>
                  <img src="/mo/image/information/de03.png" class="icon">
                  <p>배송출발</p>
                </li>
                <li>
                  <img src="/mo/image/information/de04.png" class="icon">
                  <p>배송완료</p>
                </li>
              </ul>
            </div>
            <div class="info_dev">
              <h2></h2>
              <ul id="trace-info-body2">
              </ul>
            </div>
          </div>

        </div>

      </div>


      <!--div class="inquiry">
        <p>편하신 경로로 문의주시면 신속하게 답변드리겠습니다.</p>
        <h2>배송과정에 문제가 있으신가요?</h2>
        <h3>1833-3165</h3>
        <div class="btn_are">
            <button class="btn btn-primary" onclick="javascript:location.href='/customer/inquiry_write';">1:1 문의하기</button>
            <button class="btn btn-primary">카카오톡 문의</button>
        </div-->
    </div>

    <!--: End #contents -->

    <div id="pop-alert" class="layer" role="dialog" aria-modal="true">
        <div class="layer-wrap">
            <div class="layer-content"></div>
            <div class="button-wrap">
                <button class="btn"></button>
            </div>
        </div>
    </div>

  <script>

    $(document).ready(() => {
		const invoiceNo = getParam('invoice_no');
		if(!invoiceNo) {
			return;
		}

		searchDeliveryState(invoiceNo, "");
	});

	$('#bt-delivery').click((e) => {
		$('.del_chk_form').hide();

		const invoiceNo1 = $('#it-invoice1').val();
        const invoiceNo2 = $('#it-invoice2').val();

		if(!invoiceNo1 && !invoiceNo2) {
            $('#pop-alert').modal({
                text: '운송장 번호를 입력해주세요.',
                buttonText: '확인',
                closedFocus: '.mypage_adit .modify'
            }, e => {
                if (e.type === 'before-close') {
                    // modal before-close
                } else if (e.type === 'close') {
                    return;
                }
            });
		} else if(invoiceNo1 && !invoiceNo2) {
            searchDeliveryState(invoiceNo1, "");
        } else if(!invoiceNo1 && invoiceNo2) {
            searchDeliveryState(invoiceNo2, "");
        } else if(invoiceNo1 && invoiceNo2) {
            searchDeliveryState(invoiceNo1, 1);
            searchDeliveryState(invoiceNo2, 2);
        }

	});

	const searchDeliveryState = (invoiceNo, idx) => {
		$('.info_dev').show()

		const url = 'https://tms.api.kurly.com/tms/v1/delivery/invoices/'+invoiceNo;
		$.getJSON( url )
		.done( ( json ) => {
			const data = json.data;

			if(data == null) {
                $('#pop-alert').modal({
                    text: '입력하신 송장번호가 잘못되었습니다.<br>확인 후 다시 시도해주세요',
                    buttonText: '확인',
                    closedFocus: '.mypage_adit .modify'
                }, e => {
                    if (e.type === 'before-close') {
                        // modal before-close
                    } else if (e.type === 'close') {
                        return;
                    }
                });
			}

			let $chkForm = null
			if(idx > 0) {
				$chkForm = $('.del_chk_form2').show();
			} else {
				$chkForm = $('.del_chk_form').show();
			}

			if (!data.trace_infos) {
				$chkForm.find('.info_dev').hide()
			}

			$('#search_from').hide();

			$('.del_step'+ idx +' li').removeClass('on');
			$($('.del_step'+ idx +' li')[data.level-1]).addClass('on');

			$('#invoice-no'+idx).text(data.invoice_no);

			if (!data.trace_infos) return

			const deliveryStatus = {
				invoiceNo 	: data.invoice_no,
				location 	: data.trace_infos[0].location,
				officeName 	: data.office_name == null ? '-' : data.office_name,
				status 		: data.trace_infos[data.trace_infos.length-1].status
			}
			const deliveryStatusHtml =
				`<li>${deliveryStatus.location}</li>`
				+`<li>${deliveryStatus.officeName}</li>`
				+`<li>${deliveryStatus.status}</li>`;

			$('#delivery-status-body' + idx).html(deliveryStatusHtml);

			let traceHistoryBody = '';
            let cnt_info = 1;
            let last_info = "";

			data.trace_infos.forEach(traceInfo => {
                if(data.trace_infos.length == cnt_info) last_info = "on";
				const tableData = {
					status 	 : traceInfo.status    == null? '-' : traceInfo.status,
					dateTime : traceInfo.date_time == null? '-' : traceInfo.date_time.replace('T', ' '),
					location : traceInfo.location  == null? '-' : traceInfo.location,
					remark	 : traceInfo.remark    == null? '-' : traceInfo.remark
				};

				const tableRowHtml =
					`<li class="`+last_info+`"><p>${tableData.dateTime}</p>`
					+`<h3>${tableData.location}`
					+`<b>${tableData.status}</b></h3></li>`;

				traceHistoryBody += tableRowHtml;
                cnt_info++;
			});
			$('#trace-info-body' + idx).html(traceHistoryBody);
		})
		.fail(( jqxhr, textStatus, error ) => {
			const err = textStatus + ", " + error;
            $('#pop-alert').modal({
                text: '입력하신 송장번호가 잘못되었습니다.<br>확인 후 다시 시도해주세요',
                buttonText: '확인',
                closedFocus: '.mypage_adit .modify'
            }, e => {
                if (e.type === 'before-close') {
                    // modal before-close
                } else if (e.type === 'close') {
                    return;
                }
            });
		});
	}


	const getParam = (sname) => {
		const paramStr = location.search.substr(location.search.indexOf("?") + 1);

		const params = paramStr.split("&");
		for (var i = 0; i < params.length; i++) {
			temp = params[i].split("=");
			if ([temp[0]] == sname) {
				return temp[1];
			}
		}
		return null;
	}

	  ;($ => {
		  $.depth1Index = 2
		  $.depth2Index = 2

		  $(function(){
			  /** 조회 결과 toggle */
			  $('.inner-section.result').on('click', '.more-view', e => {
				  let $moreBtn = $(e.target)
				  let $result = $moreBtn.closest('.box')
				  let isOpen = $moreBtn.hasClass('active')

				  $moreBtn[!isOpen ? 'addClass' : 'removeClass']('active')
				  $result[!isOpen ? 'addClass' : 'removeClass']('active')
			  })
		  })
	  })(window.jQuery)
  </script>
