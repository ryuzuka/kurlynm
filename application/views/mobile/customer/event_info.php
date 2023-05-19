<style>
    .text p img { width: 100% !important; height: auto !important; }
</style>

    <div class="visual customer">
        <div class="text">
            <h2>이벤트</h2>
            <p>다양한 혜택을 드리는<br>
              이벤트에 참여해보세요.</p>
        </div>
    </div>    
<!-- s : contents -->
    <div class="">

      <div class="customer_section inner">

        <div class="event_detail">
          <div class="title">
              <h2>
                <?=$event->title?>
                  <span class="date"><?=date('Y.m.d', strtotime($event->start_date))?> ~ <?=date('Y.m.d', strtotime($event->end_date))?></span>
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

    </div>
    <!-- e : contents -->