<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * make_directory 
 * 
 * @param  string $uri -> root path 부터 시작되는 uri 경로
 * @return 
 */
if ( ! function_exists('make_directory'))
{
	function make_directory($uri) {
		$CI =& get_instance();
        $now_path = $CI->global_root_path;
		$arrayDir = explode("/", $uri);

        foreach ($arrayDir as $key => $val) {
			if ($key > 0) {
				$now_path .= "/".$val;

				if (!is_dir($now_path)) {
					mkdir($now_path, 0755);
					exec("chmod 777 ". $now_path);
				}
			}
		}
	}
}

// ------------------------------------------------------------------------
