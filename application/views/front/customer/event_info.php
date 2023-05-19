    <!-- s : contents -->
    <div class="contents">
      <div class="visual customer">
        <h2>이벤트</h2>
        <p class="text">다양한 혜택을 드리는 이벤트에 참여해보세요.</p>
      </div>
        
      <div class="customer_section inner">
        <div class="event_detail">
          <div class="title">
              <h2>
                <?=$event->title?>
                  <div class="state_are">
                    <span class="date"><?=date('Y.m.d', strtotime($event->start_date))?> ~ <?=date('Y.m.d', strtotime($event->end_date))?></span>
                  </div>
              </h2>          
          </div>

          <div class="text">
              <p>
                  <?=$event->content?>
              </p>
          </div>

          <div class="btn-wrap">
              <button type="button" class="btn btn-primary w100" onclick="javascript:history.back(-1);">목록</button>
         </div>

      </div>
      </div>
    <!-- e : contents -->