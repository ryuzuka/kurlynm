      <!-- SUB CONT -->
      <div class="sub-cont-wrap">

        <div class="sub-kv">
          <img class="responsive-image" src="/images/sub/sub_kv_05_2_1920.jpg"
            data-media-pc="/images/sub/sub_kv_05_2_1920.jpg" 
            data-media-mobile="/images/sub/sub_kv_05_2_768.jpg" alt="">
          <dl>
            <dt>1:1 문의</dt>
            <dd>주식 마스터에 대해 궁금한 모든 사항을 알려드립니다.</dd>
          </dl>
        </div>

        <div class="sub-cont">
          <div class="breadcrumb">
            <a class="section">
              <img src="/images/sub/icon_home.png" alt="">
            </a>
            <div class="divider"> \ </div>
            <a class="section">지원센터</a>
            <div class="divider"> \ </div>
            <div class="active section">1:1 문의</div>
          </div>

          <div class="sub-menu">
            <a href="/support/notice"><span>공지사항</span></a>
            <a href="/support/inquiry" class="active"><span>1:1 문의</span></a>
          </div> 


          <div class="cont-area inquiry_3">
            <div class="cont-top">
              <p class="tit">주식 마스터에 대해 궁금하신 사항을 묻고 답변을 확인하는 곳입니다.</p>
              <a href="/support/inquiry_write" class="btn blue">1:1 문의하기</a>
            </div>
            <div class="cont-bottom">
              <table class="table-05">
                <tbody>
                    <?php
                        if ($inquiryList) {
                            foreach($inquiryList as $i => $list){
                                $no = $total_count - ($page_rows * ($page - 1)) - $i;
                                
                                if($list->status == "Y") {
                                    $status = "답변완료";
                                    $status_class = "done";
                                } else {
                                    $status = "답변대기";
                                    $status_class = "ready";
                                }
                    ?>
                  <tr>
                    <td>
                      <ul>
                        <li class="cate"><?=$list->question_name?></li>
                        <li class="step"><span class="icon-inquiry <?=$status_class?>"><?=$status?></span></li>
                        <li class="inquiry">
                          <dl>
                            <dt><a href="/support/inquiry_view?seq=<?=$list->seq?>" class="title"><?=$list->question_title?></a></dt>
                            <dd>                              
                              <span class="date"><?=date('Y-m-d', strtotime($list->regist_date))?></span>
                            </dd>
                          </dl>
                        </li>
                      </ul>
                    </td>
                  </tr>
                  <?php
                            }
                        } else {
                  ?>
                  <tr>
                    <td>
                      <div class="no-result-box">
                        <p>‘<?=$this->member->member_id?>’님께서 남기신 문의는 없습니다.</p>
                      </div>
                    </td>
                  </tr>
                  <?php
                        }
                  ?>
                </tbody>
              </table>
                
                <div class="table-bottom">
                <div class="table-pagination">
                  <?=$pagination?>
                </div>
              </div>
            </div>

          </div>
        </div>

      </div>