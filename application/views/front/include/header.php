    <!-- s : header -->
    <div class="notice-section" style="display:none;">
      notice
    </div>
    <header class="header">
      <h1 class="logo"><a href="/"><span class="blind">Kurly Nextmile</span></a></h1>
      <div class="gnb">
        <ul>
          <li>
            <a href="#">회사소개</a>
          </li>
          <li>
            <a href="#none">서비스</a>
          </li>
          <li>
            <a href="#none">요금안내</a>
          </li>
          <li>
            <a href="/recruit">채용</a>
          </li>
          <li>
            <a href="#none">고객지원</a>
          </li>
        </ul>
      </div>
      <div class="gnb_hover">
        <ul>
          <li>
            <a href="/company/aboutus">회사개요</a>
            <a href="/company/contact">오시는길</a>
            <a href="/company/finance">공시정보</a>
          </li>
          <li>
            <a href="/service/delivery">새벽배송</a>
            <a href="/service/coldchain">풀콜드체인</a>
            <a href="/service/system">시스템 소개</a>
          </li>
          <li>
            <a href="/information/fee">요금안내</a>
            <a href="/information/estimate">견적문의</a>
            <a href="/information/invoice">송장조회</a>
          </li>
          <li>

          </li>
          <li>
            <a href="/customer/event">이벤트</a>
            <a href="/customer/guide">이용가이드</a>
            <a href="/customer/inquiry_write">1:1 문의</a>
            <a href="/customer/notice">공지사항</a>
          </li>
        </ul>
      </div>
      <div class="util">
        <div class="login-group">
          <!-- 로그인/비로그인 상태일때 아이콘 동일, 로그인시: active -->
          <?php if($this->session->userdata('MID')) { ?>
          <a href="#" class="login active"><span class="blind">로그인</span></a>
          <div class="login-menu">
            <em class="user-info">
                <span><?php if($this->member->member_name) { echo $this->member->member_name; } else { echo "회원"; }  ?></span> 님
            </em>
            <ul class="list-menu">
              <li><a href="/member/estimate">견적문의내역</a></li>
              <li><a href="/member/info">회원정보수정</a></li>
              <li><a href="/member/logout">로그아웃</a></li>
            </ul>
          </div>
          <?php } else { ?>
          <a href="/member/login" class="login"><span class="blind">로그인</span></a>
          <?php } ?>          
        </div>
        <a href="/information/estimate" class="inquiry">견적문의</a>
        <a href="/information/invoice" class="invoice">송장조회</a>
      </div>
    </header>