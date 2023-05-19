    <!-- s : contents -->
    <div class="contents estimate">
      <div class="visual ect">
        <h2>견적문의내역</h2>
        <p class="text">문의하신 내역을 확인해보세요.</p>
      </div>

      <div class="estimate_detail">
        <h2>기업정보</h2>
        <div class="box">
            <ul>
                <li>
                    <p class="title">사업체명</p>
                    <p class="info"><?=$estimate->company_name?></p>
                </li>
                <li>
                    <p class="title">대표자</p>
                    <p class="info"><?=$estimate->company_ceo?></p>
                </li>
                <li>
                    <p class="title">사업자등록번호</p>
                    <p class="info"><?=$estimate->company_no?></p>
                </li>
                <li>
                    <p class="title">본사주소</p>
                    <p class="info"><?=$estimate->company_address?></p>
                </li>
                <li>
                    <p class="title">판매 사이트</p>
                    <p class="info"><?=$estimate->company_site?></p>
                </li>
                <li>
                    <p class="title">대표 이메일</p>
                    <p class="info"><?=$estimate->dec_company_email?></p>
                </li>
                <li>
                    <p class="title">브랜드명</p>
                    <p class="info"><?=$estimate->company_brand?></p>
                </li>
                <li>
                    <p class="title">고객센터 연락처</p>
                    <p class="info"><?=$estimate->dec_company_tel?></p>
                </li>
            </ul>

        </div>

        <?php
            $arrPickup = explode(",", $estimate->pickup_type);
            $arrRTime = explode(":", $estimate->release_time);
            $arrPTime = explode(":", $estimate->pickup_time);
        ?>
        <h2>배송정보</h2>
        <div class="box">
            <ul>
                <li>
                    <p class="title">희망 출고 시작일</p>
                    <p class="info"><?=$estimate->release_date?></p>
                </li>
                <li>
                    <p class="title">희망 출고요일</p>
                    <p class="info"><?=substr($estimate->release_week,0,-1)?></p>
                </li>
                <li>
                    <p class="title">주문 접수시간</p>
                    <p class="info"><?=$arrRTime[0]?>시 <?=$arrRTime[1]?>분</p>
                </li>
                <li>
                    <p class="title">픽업 상차유형</p>
                    <p class="info"><?php if($estimate->release_method == "P") { echo "픽업요청"; } else { echo "자체입고"; } ?></p>
                </li>
                <li>
                    <p class="title">픽업 요청시간</p>
                    <p class="info"><?=$arrPTime[0]?>시 <?=$arrPTime[1]?>분</p>
                </li>
                <li>
                    <p class="title">픽업 상차유형</p>
                    <p class="info">
                        <?php if(in_array("B", $arrPickup)) { echo "박스 "; } if(in_array("P", $arrPickup)) { echo "파레트 "; } if(in_array("R", $arrPickup)) { echo "롤테이너 "; } ?>
                        <?php if($estimate->pickup_etc) { echo " ,".$estimate->pickup_etc; } ?>
                    </p>
                </li>
                <li>
                    <p class="title">픽업지 주소</p>
                    <p class="info"><?=$estimate->pickup_address1?> <?=$estimate->pickup_address2?></p>
                </li>
                <li>
                    <p class="title">특이사항</p>
                    <p class="info"><?=$estimate->release_content?></p>
                </li>
            </ul>

        </div>

        <h2>새벽배송 평균 물량</h2>
        <div class="box">

            <div class="box_flex">
                <p class="title">요일별</p>
                <div class="in_content">
                    <p class="info">
                        <b>월</b>
                        <span><?=number_format($estimate->early_day1_cnt)?></span>
                        건
                    </p>
                    <p class="info">
                        <b>화</b>
                        <span><?=number_format($estimate->early_day2_cnt)?></span>
                        건
                    </p>
                    <p class="info">
                        <b>수</b>
                        <span><?=number_format($estimate->early_day3_cnt)?></span>
                        건
                    </p>
                    <p class="info">
                        <b>목</b>
                        <span><?=number_format($estimate->early_day4_cnt)?></span>
                        건
                    </p>
                    <p class="info">
                        <b>금</b>
                        <span><?=number_format($estimate->early_day5_cnt)?></span>
                        건
                    </p>
                    <p class="info">
                        <b>토</b>
                        <span><?=number_format($estimate->early_day6_cnt)?></span>
                        건
                    </p>
                    <p class="info end">
                        <b>일</b>
                        <span><?=number_format($estimate->early_day7_cnt)?></span>
                        건
                    </p>
                </div>

            </div>
            <div class="box_flex">
                <p class="title">월별</p>
                <div class="in_content">
                    <p class="info">
                        <b><?=$estimate->early_month1?>월</b>
                        <span><?=number_format($estimate->early_month1_cnt)?></span>
                        건
                    </p>
                    <p class="info">
                        <b><?=$estimate->early_month2?>월</b>
                        <span><?=number_format($estimate->early_month2_cnt)?></span>
                        건
                    </p>
                    <p class="info">
                        <b><?=$estimate->early_month3?>월</b>
                        <span><?=number_format($estimate->early_month3_cnt)?></span>
                        건
                    </p>

                </div>
            </div>
        </div>

        <h2>택배배송 평균 물량</h2>
        <div class="box">

            <div class="box_flex">
                <p class="title">월별</p>
                <div class="in_content">
                    <p class="info">
                        <b><?=$estimate->delivery_month1?>월</b>
                        <span><?=number_format($estimate->delivery_month1_cnt)?></span>
                        건
                    </p>
                    <p class="info">
                        <b><?=$estimate->delivery_month2?>월</b>
                        <span><?=number_format($estimate->delivery_month2_cnt)?></span>
                        건
                    </p>
                    <p class="info">
                        <b><?=$estimate->delivery_month3?>월</b>
                        <span><?=number_format($estimate->delivery_month3_cnt)?></span>
                        건
                    </p>

                </div>
            </div>
        </div>


        <?php
            $arrType = explode(",", $estimate->goods_type);
        ?>
        <h2>물품정보</h2>
        <div class="box">
            <ul>
                <li>
                    <p class="title">취급상품</p>
                    <p class="info"><?=$estimate->goods_title?></p>
                </li>
                <li>
                    <p class="title">유형</p>
                    <p class="info"><?php if(in_array("F", $arrType)) { echo "냉동 "; } if(in_array("C", $arrType)) { echo "냉장 "; } if(in_array("R", $arrType)) { echo "상온 "; } ?> <?php if($estimate->goods_etc) { echo " ,".$estimate->goods_etc; } ?></p>
                </li>
                <li>
                    <p class="title">규격 (cm) / 무게 (kg)</p>
                    <p class="info">가로*세로*높이 <?=$estimate->goods_length?>  무게 <?=$estimate->goods_weight?></p>
                </li>
            </ul>

        </div>

        <h2>담당자</h2>
        <div class="box">
            <ul>
                <li>
                    <p class="title">성함</p>
                    <p class="info"><?=$estimate->manager_name?></p>
                </li>
                <li>
                    <p class="title">연락처</p>
                    <p class="info"><?=$estimate->dec_manager_tel?></p>
                </li>
                <li>
                    <p class="title">연락처</p>
                    <p class="info"><?=$estimate->dec_manager_email?></p>
                </li>
            </ul>

        </div>

        <h2>특이사항</h2>
        <div class="box">
            <div class="box_flex">
                <p><?=nl2br($estimate->estimate_content)?></p>
            </div>
        </div>

        
        <div class="btn-wrap">
            <a href="/member/estimate?<?=$params?>" class="btn btn-primary">목록</a>
        </div>


      </div>
    </div>
    <!-- e : contents -->