    <!-- s : contents -->
    <div class="contents information">
      <div class="visual information">
        <h2>송장조회</h2>
        <p class="text">고객님이 신청하신 물류의 배송현황을 직접 확인해보세요.</p>
      </div>
      <div class="inner-section if-transport" id="search_from">
        <div class="round-box transport-list">
          <h3 class="kurly-text-06">운송장번호</h3>
          <div class="field-box">
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
        </div>
        <div class="btn-wrap">
          <a href="#" id="bt-delivery" class="btn btn-primary">조회하기</a>
        </div>
      </div>

       <div class="inner-section if-result del_chk_form" style="display: none;">
                <h3 class="kurly-text-03">조회 결과</h3>
                <div class="round-box">
                  <div class="info-number">
                    <h4 class="kurly-text-07">운송장번호</h4>
                    <span id="invoice-no" class="kurly-text-06">250-01-123412341234</span>
                  </div>
                  <div class="tbl-box">
                    <table class="tbl-list">
                      <caption class="blind">배송처리 정보</caption>
                      <colgroup>
                        <col style="width:33.3%">
                        <col style="width:33.3%">
                        <col style="width:33.4%">
                      </colgroup>
                      <thead>
                      <tr>
                        <th scope="col">발송지</th>
                        <th scope="col">도착지</th>
                        <th scope="col">배송결과</th>
                      </tr>
                      </thead>
                      <tbody id="delivery-status-body">
                      <!-- ################################# -->
                      </tbody>
                    </table>
                  </div>
                  <div class="details">
                    <ul class="list-inquiry del_step">
                      <li class="active">
                        <em class="kurly-text-06">집화</em>
                      </li>
                      <li>
                        <em class="kurly-text-06">TC도착</em>
                      </li>
                      <li>
                        <em class="kurly-text-06">배송출발</em>
                      </li>
                      <li>
                        <em class="kurly-text-06">배송완료</em>
                      </li>
                    </ul>
                    <h4 class="kurly-text-07">배송현황</h4>
                    <div class="tbl-box">
                      <table class="tbl-list">
                        <caption class="blind">배송현황 정보</caption>
                        <colgroup>
                          <col style="width:33.3%">
                          <col style="width:33.3%">
                          <col style="width:33.4%">
                        </colgroup>
                        <thead>
                        <tr>
                          <th scope="col">처리일시</th>
                          <th scope="col">현재위치</th>
                          <th scope="col">처리현황</th>
                        </tr>
                        </thead>
                        <tbody id="trace-info-body">
                        <!-- ############################### -->
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <button type="button" class="more-view">
                    <span class="blind">배송현황 더보기</span>
                  </button>
                </div>
      </div>

      <div class="inner-section if-result del_chk_form2" style="display: none;">
        <h3 class="kurly-text-03">조회 결과</h3>
        <div class="round-box">
          <div class="info-number">
            <h4 class="kurly-text-07">운송장번호</h4>
            <span id="invoice-no1" class="kurly-text-06"></span>
          </div>
          <div class="tbl-box">
            <table class="tbl-list">
              <caption class="blind">배송처리 정보</caption>
              <colgroup>
                <col style="width:33.3%">
                <col style="width:33.3%">
                <col style="width:33.4%">
              </colgroup>
              <thead>
              <tr>
                <th scope="col">발송지</th>
                <th scope="col">도착지</th>
                <th scope="col">배송결과</th>
              </tr>
              </thead>
              <tbody id="delivery-status-body1">
              <!--tr class="emp">
                <td>마켓컬리</td>
                <td>컬리넥스트마일</td>
                <td>집화</td>
              </tr-->
              </tbody>
            </table>
          </div>
          <div class="details">
            <ul class="list-inquiry del_step1">
              <li class="active">
                <em class="kurly-text-06">집화</em>
              </li>
              <li>
                <em class="kurly-text-06">TC도착</em>
              </li>
              <li>
                <em class="kurly-text-06">배송출발</em>
              </li>
              <li>
                <em class="kurly-text-06">배송완료</em>
              </li>
            </ul>
            <h4 class="kurly-text-07">배송현황</h4>
            <div class="tbl-box">
              <table class="tbl-list">
                <caption class="blind">배송현황 정보</caption>
                <colgroup>
                  <col style="width:33.3%">
                  <col style="width:33.3%">
                  <col style="width:33.4%">
                </colgroup>
                <thead>
                <tr>
                  <th scope="col">처리일시</th>
                  <th scope="col">현재위치</th>
                  <th scope="col">처리현황</th>
                </tr>
                </thead>
                <tbody id="trace-info-body1">
                <tr>
                  <td>2022-10-01 15:30</td>
                  <td>삼형제 고기</td>
                  <td class="emp">집화</td>
                </tr>
                <tr>
                  <td>2022-10-01 08:30</td>
                  <td>배송기사 (FC홍길동)</td>
                  <td class="emp">TC 도착</td>
                </tr>
                <tr>
                  <td>2022-09-30 15:30</td>
                  <td>컬리넥스트마일</td>
                  <td class="emp">배송출발</td>
                </tr>
                </tbody>
              </table>
            </div>
          </div>
          <button type="button" class="more-view">
            <span class="blind">배송현황 더보기</span>
          </button>
        </div>

        <div class="round-box">
          <div class="info-number">
            <h4 class="kurly-text-07">운송장번호</h4>
            <span id="invoice-no2" class="kurly-text-06"></span>
          </div>
          <div class="tbl-box">
            <table class="tbl-list">
              <caption class="blind">배송처리 정보</caption>
              <colgroup>
                <col style="width:33.3%">
                <col style="width:33.3%">
                <col style="width:33.4%">
              </colgroup>
              <thead>
              <tr>
                <th scope="col">발송지</th>
                <th scope="col">도착지</th>
                <th scope="col">배송결과</th>
              </tr>
              </thead>
              <tbody id="delivery-status-body2">
              <!--tr class="emp">
                <td>마켓컬리</td>
                <td>컬리넥스트마일</td>
                <td>집화</td>
              </tr-->
              </tbody>
            </table>
          </div>
          <div class="details">
            <ul class="list-inquiry del_step2">
              <li class="active">
                <em class="kurly-text-06">집화</em>
              </li>
              <li>
                <em class="kurly-text-06">TC도착</em>
              </li>
              <li>
                <em class="kurly-text-06">배송출발</em>
              </li>
              <li>
                <em class="kurly-text-06">배송완료</em>
              </li>
            </ul>
            <h4 class="kurly-text-07">배송현황</h4>
            <div class="tbl-box">
              <table class="tbl-list">
                <caption class="blind">배송현황 정보</caption>
                <colgroup>
                  <col style="width:33.3%">
                  <col style="width:33.3%">
                  <col style="width:33.4%">
                </colgroup>
                <thead>
                <tr>
                  <th scope="col">처리일시</th>
                  <th scope="col">현재위치</th>
                  <th scope="col">처리현황</th>
                </tr>
                </thead>
                <tbody id="trace-info-body2">
                <tr>
                  <td>2022-10-01 15:30</td>
                  <td>삼형제 고기</td>
                  <td class="emp">집화</td>
                </tr>
                <tr>
                  <td>2022-10-01 08:30</td>
                  <td>배송기사 (FC홍길동)</td>
                  <td class="emp">TC 도착</td>
                </tr>
                <tr>
                  <td>2022-09-30 15:30</td>
                  <td>컬리넥스트마일</td>
                  <td class="emp">배송출발</td>
                </tr>
                </tbody>
              </table>
            </div>
          </div>
          <button type="button" class="more-view">
            <span class="blind">배송현황 더보기</span>
          </button>
        </div>
      </div>

    </div>
    <!-- e : contents -->

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
		const url = 'https://tms.api.kurly.com/tms/v1/delivery/invoices/'+invoiceNo;
		$.getJSON( url )
		.done( ( json ) => {
			const data = json.data;

			if(data == null) {
                $('#pop-alert').modal({
                    text: '입력하신 송장번호가 잘못되었습니다.<br>확인 후, 다시 시도해주세요',
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

            if(idx > 0) {
                $('.del_chk_form2').show();
            } else {
                $('.del_chk_form').show();
            }
			$('#search_from').hide();

			$('.del_step'+ idx +' li').removeClass('active');
			$($('.del_step'+ idx +' li')[data.level-1]).addClass('active');

			$('#invoice-no'+idx).text(data.invoice_no);

			if (!data.trace_infos) return

			const deliveryStatus = {
				invoiceNo 	: data.invoice_no,
				location 	: data.trace_infos[0].location,
				officeName 	: data.office_name == null ? '-' : data.office_name,
				status 		: data.trace_infos[data.trace_infos.length-1].status
			}
			const deliveryStatusHtml =
				`<tr class="emp">`
				+`	<td>${deliveryStatus.location}</td>`
				+`	<td>${deliveryStatus.officeName}</td>`
				+`	<td>${deliveryStatus.status}</td>`
				+`</tr>`;

			$('#delivery-status-body' + idx).html(deliveryStatusHtml);

			let traceHistoryBody = '';
			data.trace_infos.forEach(traceInfo => {
				const tableData = {
					status 	 : traceInfo.status    == null? '-' : traceInfo.status,
					dateTime : traceInfo.date_time == null? '-' : traceInfo.date_time.replace('T', ' '),
					location : traceInfo.location  == null? '-' : traceInfo.location,
					remark	 : traceInfo.remark    == null? '-' : traceInfo.remark
				};

				const tableRowHtml =
					`<tr>`
					+`	<td>${tableData.dateTime}</td>`
					+`	<td>${tableData.location}</td>`
					+`	<td>${tableData.status}</td>`
					+`</tr>`;

				traceHistoryBody += tableRowHtml;
			});
			$('#trace-info-body' + idx).html(traceHistoryBody);
		})
		.fail(( jqxhr, textStatus, error ) => {
			const err = textStatus + ", " + error;
            $('#pop-alert').modal({
                text: '입력하신 송장번호가 잘못되었습니다.<br>확인 후, 다시 시도해주세요',
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

		  $(function () {
			  /** 조회 결과 toggle */
			  $('.contents.information').on('click', '.more-view', e => {
				  let $moreBtn = $(e.target)
				  let $result = $moreBtn.closest('.round-box')
				  let isOpen = $moreBtn.hasClass('active')

				  $moreBtn[!isOpen ? 'addClass' : 'removeClass']('active')
				  $result[!isOpen ? 'addClass' : 'removeClass']('active')
			  })
		  })
	  })(window.jQuery)
</script>
