  <header class="header ">
  	
    <h1 class="logo">
      <a href="/"><span class="blind">Kurly Nextmile</span></a>
    </h1>
  	
    <div class="gnb">
      <a href="#" class="open">
        <span class="blind">
          menu
        </span>
      </a>
    </div>
      
    <div class="navopen">
        
        <?php if($this->session->userdata('MID')) { ?>
        <div class="navtop login_user">
          <a href="#" class="login"><?php if($this->member->member_name) { echo $this->member->member_name; } else { echo "회원"; } ?><span>님</span></a>
          <a href="#" class="close">
            <span class="blind">
              close
            </span>
          </a>
          <div class="mybtn">
            <a href="/member/estimate">견적문의내역</a>
            <a href="/member/info">회원정보수정</a>
            <a href="/member/logout">로그아웃</a>
          </div>
        </div>
        <?php } else { ?>
        <div class="navtop">
          <a href="/member/login" class="login">Login</a>
          <a href="#" class="close">
            <span class="blind">
              close
            </span>
          </a>
        </div>
        <?php } ?>

      <div class="toggle_menu">
        <ul>
          <li>
            <a href="#">회사소개 <span class="nav_drop"></span></a>
            <ul>
                <li><a href="/company/aboutus">회사개요</a></li>
                <li><a href="/company/contact">오시는길</a></li>
                <li><a href="/company/finance">공시정보</a></li>
            </ul>
          </li>
          <li>
            <a href="#">서비스 <span class="nav_drop"></span></a>
            <ul>
                <li><a href="/service/delivery">새벽배송</a></li>
                <li><a href="/service/coldchain">풀콜드체인</a></li>
                <li><a href="/service/system">시스템 소개</a></li>
            </ul>
          </li>
          <li>
            <a href="#">요금안내 <span class="nav_drop"></span></a>
            <ul>
                <li><a href="/information/fee">요금안내</a></li>
                <li><a href="/information/estimate">견적문의</a></li>
                <li><a href="/information/invoice">송장조회</a></li>
            </ul>
          </li>
          <li class="recruit">
            <a href="/recruit">채용</a>
          </li>
          <li>
            <a href="#">고객지원 <span class="nav_drop"></span></a>
            <ul>
                <li><a href="/customer/event">이벤트</a></li>
                <li><a href="/customer/guide">이용가이드</a></li>
                <li><a href="/customer/inquiry_write">1:1문의</a></li>
                <li><a href="/customer/notice">공지사항</a></li>
            </ul>
          </li>
        </ul>
      </div>

      <div class="navbanner">
        <h2>새벽배송 서비스<br>지금바로 경험해보세요</h2>
        <a href="/information/estimate">
  	      견적문의 바로가기<span></span>
        </a>
        <div class="navbg"></div>
      </div>
    </div>
  </header>
