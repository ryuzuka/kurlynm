    <div class="visual service">
        <div class="text">
            <h2>시스템 소개</h2>
            <p>고객의 Needs에 부합하는 서비스를 제공하기 위해,<br>
                파트너사 TOMS 시스템 운영</p>
        </div>
    </div>

    <!--: Start #contents -->
    <div class="contents service__info">
        <div class="service_headline nobottom">
            <h1>고객사별 개별 아이디를 이용하여,<br>
                <b>편리하고 손쉬운<br>
                    TOMS 시스템을 제공</b>합니다.</h1>
        </div>

        
        <div class="system">
            <div class="box">
                <h2>
                    <b class="color">01</b>
                    한눈에 배송 위탁 현황 확인
                </h2>
                <p>접수된 주문에 대해 한눈에 확인할 수 있도록<br>
                    TC 주문 목록 제공</p>
                <img src="/mo/image/convenient/system01.png">
            </div>
            <div class="box">
                <h2>
                    <b class="color">02</b>
                    한번에 배송 위탁 리스트 업로드
                </h2>
                <p>다량의 주문 접수도 편리하게, 엑셀 업로드 기능
                    제공</p>
                <img src="/mo/image/convenient/system02.png">
            </div>
            <div class="box">
                <h2>
                    <b class="color">03</b>
                    주문처리, 배송현황 실시간 조회
                </h2>
                <p>진행중인 주문건의 처리 및 배송현황을 실시간으로 확인 가능</p>
                <img src="/mo/image/convenient/system03.png">
            </div>
            <div class="box">
                <h2>
                    <b class="color">04</b>
                    컬리넥스트마일 송장 프린트 가능
                </h2>
                <p>배송이 시작된 주문의 송장번호 확인, 프린트도
                    손쉽게 진행</p>
                <img src="/mo/image/convenient/system04.png">
            </div>
            <div class="box">
                <h2>
                    <b class="color">05</b>
                    배송완료 메세지 확인 가능
                </h2>
                <p>안전하게 배송 완료 후 메세지까지 전달되었는지 섬세하게 확인 가능</p>
                <img src="/mo/image/convenient/system05.png">
            </div>
        </div>


    <div class="convenient">
        <h1>컬리넥스트마일만의<br>
            시스템을 제공합니다.</h1>

        <div class="imgbox start">
            <img src="/mo/image/convenient/img03.png">
            <p>
                배차 및 배송관리 시스템
            </p>
        </div>
        <div class="imgbox end">
            <img src="/mo/image/convenient/img04.png">
            <p>
                배송완료 시 사진 및 MMS 발송
            </p>
        </div>

    </div>
    </div>

    <div class="inquiry">
        <h2 class="nomargin">컬리넥스트마일만의<br>
            간편하고 새로운 물류 서비스,<br>
            지금 시작해보세요!</h2>
        <div class="btn_are">
            <?php if($this->session->userdata('MID')) { ?>
            <button class="btn btn-primary" onclick='javascript:location.href="/"'>회원가입</button>
            <?php } else { ?>
            <button class="btn btn-primary" onclick='javascript:location.href="/member/login"'>회원가입</button>
            <?php } ?>
            <button class="btn btn-primary" onclick='javascript:location.href="/information/estimate"'>견적문의</button>
        </div>
    </div>


    <!--: End #contents -->
    
  <script>
	  ;($ => {
		  $.depth1Index = 1
		  $.depth2Index = 2
		
		  $(function () {
			
		  })
	  })(window.jQuery)
  </script>    