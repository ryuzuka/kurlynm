<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * arraytostring
 *
 * 배열을 구분자로 구분해서 하나의 문자열 생성
 *
 * @access	public
 * @param	array
 * @param	string (delimiter)
 * @return	string
 */
if ( ! function_exists('arraytostring'))
{
	function arraytostring($array, $delimiter = '|')
	{
		$string = "";
		if (is_array($array)) {
			for ($i=0; $i<count($array); $i++) {
				$string .= $array[$i] . $delimiter;
			}
		}
		if ($string != "") $string = $delimiter . $string;
		return $string;
	}
}

// ------------------------------------------------------------------------

/**
 * stringtoarray
 *
 * 구분자로 구분된 문자열을 배열로 생성
 *
 * @access	public
 * @param	string
 * @param	string (delimiter)
 * @return	array
 */
if ( ! function_exists('stringtoarray'))
{
	function stringtoarray($string, $delimiter = '|')
	{
        if ($string) {
            $string = substr($string, 1, strlen($string)-2);
            $array = explode($delimiter, $string);
            if (is_array($array) == false) {
                $array = null;
            }
        } else {
            $array = null;
        }
		return $array;
	}
}


