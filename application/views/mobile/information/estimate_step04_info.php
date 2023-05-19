    <!--: Start #contents -->
    <div class="contents information information-detail">

        <div class="step6">
            <div class="step">
                <span class="atv ok"></span>
                <span class="atv ok"></span>
                <span class="atv ok"></span>
                <span class="atv"></span>
                <span></span>
            </div>
        </div>

        <form id="frmEstimate" name="frmEstimate" method="post" action="/information/estimate_step04_update">
            <input type="hidden" id="estimate_seq" name="estimate_seq" value="<?=$estimate_seq?>">
            <input type="hidden" id="current_step" name="current_step" value="<?=$current_step?>">
        <div class="form">
            <h2>물품정보를 입력해주세요. </h2>

            <div class="input-area js-input">
              <div class="input">
                <label>취급상품</label>
                <input type="text" id="goods_title" name="goods_title" placeholder="Ex) 반찬, 샐러드, 육류, 의류 등" value="<?=$estimate->goods_title?>">
                <button type="button" class="btn-clear"><span><span class="blind">입력 텍스트 삭제</span></span></button>
              </div>
          </div>

          <div class="input-area js-input number">
            <div class="input mbtn10">
              <label>규격(cm) / 무게 (kg)</label>
              <input type="text" id="goods_length" name="goods_length" placeholder="가로 x 세로 x 높이 (세변의 합)" value="<?=$estimate->goods_length?>" maxlength="5">
              <button type="button" class="btn-clear"><span><span class="blind">입력 텍스트 삭제</span></span></button>
            </div>
            <div class="input">
              <input type="text" id="goods_weight" name="goods_weight" placeholder="무게" value="<?=$estimate->goods_weight?>" maxlength="4">
              <button type="button" class="btn-clear"><span><span class="blind">입력 텍스트 삭제</span></span></button>
            </div>
        </div>

        <?php
            $arrType = explode(",", $estimate->goods_type);
        ?>
            
        <div class="form-cell">
          <div class="form-head">
            <label for="orderDate">유형</label>
            <input type="hidden" id="goods_type" name="goods_type" value="<?=$estimate->goods_type?>">
          </div>
          <div class="input-group mbtn10">
            <div class="chk-box">
              <input type="checkbox" id="goods_types_1" name="goods_types" value="F" class="goods_type" <?php if(in_array("F", $arrType)) { echo "checked"; } ?>><label for="goods_types_1">냉장</label>
            </div>
            <div class="chk-box">
              <input type="checkbox" id="goods_types_2" name="goods_types" value="C" class="goods_type" <?php if(in_array("C", $arrType)) { echo "checked"; } ?>><label for="goods_types_2">냉동</label>
            </div>
            <div class="chk-box">
              <input type="checkbox" id="goods_types_3" name="goods_types" value="R" class="goods_type" <?php if(in_array("R", $arrType)) { echo "checked"; } ?>><label for="goods_types_3">상온</label>
            </div>
          </div>

          <div class="input">
            <input type="text" id="goods_etc" name="goods_etc" title="기타 유형 입력" placeholder="기타 : 유형을 입력해주세요." value="<?=$estimate->goods_etc?>">
            <button type="button" class="btn-clear"><span><span class="blind">입력 텍스트 삭제</span></span></button>
          </div>

        </div>

        </div>
        </form>
        <div class="form_btn">
            <button class="btn btn-primary btn-w100 btn-next">다음</button>
            <button class="btn btn-secondary btn-w100 btn-prev">이전</button>
        </div>
    </div>

<script>
    $(function() {
        $('.btn-next').on('click',function(e) {
            $('#frmEstimate').submit();
        });
        
        $('.btn-prev').on('click',function(e) {
            var estimate_seq = "<?=$estimate_seq?>";
            var current_step = "<?=$current_step?>";
            location.href = "/information/estimate_step03_info?estimate_seq="+estimate_seq+"&current_step="+current_step;
        });
        
        // 물품정보 - 유형
        $('.goods_type').on('click',function(e) {
            var goods_type = "";
            $("input:checkbox[name='goods_types']").each(function() {
                if($(this).is(":checked")) {
                    goods_type += $(this).val() + ",";
                }
            });
            
            $("#goods_type").val(goods_type);
        });
        // 물품정보 - 유형
    });
    
	  ;($ => {
		  $.depth1Index = 2
		  $.depth2Index = 1
		
		  $(function () {
			  /** 물품정보 - 유형 */
			  $('.input-group.status').on('change-input', e => {
				  console.log(e)
			  })
		  })
	  })(window.jQuery)    
  </script>
    <!--: End #contents -->