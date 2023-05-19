<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * getPagingBasic
 *
 * 배열을 구분자로 구분해서 하나의 문자열 생성
 *
 * @access	public
 * @param	array
 * @param	$block_size : 노출되는 페이지 수
 * @param	$cur_page : 현재 페이지
 * @param	$total_page : 전체 페이지
 * @param	$url : 이동할 페이지 URL
 * @return	string
 */
if ( ! function_exists('getPagingBasic') || ! function_exists('getPagingBasicApps'))
{
	function getPagingBasic($block_size, $cur_page, $total_page, $url)
	{
		$start_page = ((int)(($cur_page - 1) / $block_size)) * $block_size + 1;
		$end_page = $start_page + $block_size - 1;
		
		if ($end_page >= $total_page) $end_page = $total_page;

		$html = "<ul class=\"pagination\">";
/*
		// 이전 블럭
		if ($start_page > 1) {
			$html .= "<li class=\"prev\"><a href=\"". $url . ($start_page-1) ."\"><i class=\"fa fa-arrow-left\"></i> 이전</a></li>";
		} else {
			$html .= "<li class=\"prev disabled\"><a href=\"#\"><i class=\"fa fa-arrow-left\"></i> 이전</a></li>";
		}
*/		
		// 이전 페이지
		if ($cur_page > 1) {
			$html .= "<li class=\"prev\"><a href=\"". $url . ($cur_page-1) ."\"><i class=\"fa fa-arrow-left\"></i> Prev</a></li>";
		} else {
			$html .= "<li class=\"prev disabled\"><a href=\"#\"><i class=\"fa fa-arrow-left\"></i> Prev</a></li>";
		}
		
		// 페이지
		if ($total_page > 1) {
			for ($k=$start_page; $k<=$end_page; $k++) {
				if ($cur_page != $k)
					$html .= "<li><a href=\"" . $url . $k . "\">" . $k . "</a></li>";
				else
					$html .= "<li class=\"active\"><a href=\"#\">" . $k . "</a></li>";
			}
		} else {
			$html .= "<li class=\"active\"><a href=\"#\">1</a></li>";
		}
		
		// 다음 페이지
		if ($total_page > $cur_page) {
			$html .= "<li class=\"next\"><a href=\"" . $url . ($cur_page+1) . "\">Next <i class=\"fa fa-arrow-right\"></i> </a></li>";
		} else {
			$html .= "<li class=\"next disabled\"><a href=\"#\">Next <i class=\"fa fa-arrow-right\"></i> </a></li>";
		}
/*
		// 다음 블럭
		if ($total_page > $end_page) {
			$html .= "<li class=\"next\"><a href=\"" . $url . ($end_page+1) . "\">다음 <i class=\"fa fa-arrow-right\"></i> </a></li>";
		} else {
			$html .= "<li class=\"next disabled\"><a href=\"#\">다음 <i class=\"fa fa-arrow-right\"></i> </a></li>";
		}
*/
		$html .= "</ul>";

		return $html;
	}

    function getPagingBasicFront($block_size, $cur_page, $total_page, $url)
	{
		$start_page = ((int)(($cur_page - 1) / $block_size)) * $block_size + 1;
		$end_page = $start_page + $block_size - 1;
		
		if ($end_page >= $total_page) $end_page = $total_page;

		$html = "";
        
		// 이전 페이지
		if ($cur_page > 1) {
			//$html .= "<button type=\"button\" class=\"prev\"><a href=\"". $url . ($cur_page-1) ."\">이전</a></button>";
            $html .= "<button type='button' class='paging-first' onclick=\"javascript:location.href='". $url ."';\"><span class='blind'><a href=\"". $url ."\">처음</a></span></button>";
            $html .= "<button type='button' class='paging-prev' onclick=\"javascript:location.href='". $url . ($cur_page-1) ."';\"><span class='blind'><a href=\"". $url . ($cur_page-1) ."\">이전</a></span></button>";
		} else {
            $html .= "<button type='button' class='paging-first' disabled><span class='blind'>처음</span></button>";
			$html .= "<button type='button' class='paging-prev' disabled><span class='blind'>이전</span></button>";
		}
		
		// 페이지
		if ($total_page > 1) {
            $html .= "<div class='paging-list'>";
			for ($k=$start_page; $k<=$end_page; $k++) {
				if ($cur_page != $k)
                    $html .= "<a href=\"" . $url . $k . "\">" . $k . "</a>";
				else
					$html .= "<a aria-current='page' href=\"#\">" . $k . "</a>";
			}
            $html .= "</div>";
		} else {
			$html .= "<div class='paging-list'><a class=\"page active\" href=\"#\">1</a></div>";
		}
		
		// 다음 페이지
        //<button type="button" class="paging-next"><span class="blind">다음</span></button>
        //<button type="button" class="paging-last"><span class="blind">마지막</span></button>
		if ($total_page > $cur_page) {
            $html .= "<button type='button' class='paging-next' onclick=\"javascript:location.href='". $url . ($cur_page+1) ."';\"><span class='blind'><a href=\"". $url . ($cur_page+1) ."\">다음</a></span></button>";
            $html .= "<button type='button' class='paging-last' onclick=\"javascript:location.href='". $url . ($total_page) ."';\"><span class='blind'><a href=\"". $url . ($total_page) ."\">마지막</a></span></button>";
		} else {
			$html .= "<button type='button' class='paging-next' disabled><span class='blind'>다음</span></button>";
			$html .= "<button type='button' class='paging-last' disabled><span class='blind'>마지막</span></button>";
		}

		return $html;
	}
}