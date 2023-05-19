<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * alert 
 * 
 * @param  string $msg 
 * @param  string $url 
 * @return void      
 */
if ( ! function_exists('alert'))
{
	function alert($msg = '', $url = '') {
		if (!$msg)
			$msg = '올바른 방법으로 이용해 주십시오.';

        echo "<meta charset='utf-8'>";
		echo "<script type='text/javascript'>alert('" . $msg . "');";
		if ($url)
			echo "location.replace('" . $url . "');";
		else
			echo "history.go(-1);";
		echo "</script>";
		exit;
	}
}

// ------------------------------------------------------------------------

/**
 * alert_close
 * 
 * @param  string $msg 
 * @return void      
 */
if ( ! function_exists('alert_close'))
{
	function alert_close($msg = '') {
        echo "<meta charset='utf-8'>";
		echo "<script type='text/javascript'> alert('" . $msg . "'); window.close(); </script>";
		exit;
	}
}

// ------------------------------------------------------------------------

/**
 * alert_only
 * 
 * @param  string $msg
 * @return void     
 */
if ( ! function_exists('alert_only'))
{
	function alert_only($msg = '') {
        echo "<meta charset='utf-8'>";
		echo "<script type='text/javascript'> alert('" . $msg . "'); </script>";
		exit;
	}
}
// ------------------------------------------------------------------------

/**
 * alert_opener_close
 * 
 * @param  string $msg
 * @return void     
 */
if ( ! function_exists('alert_opener_close'))
{
	function alert_opener_close($msg = '') {
        echo "<meta charset='utf-8'>";
		echo "<script type='text/javascript'> alert('" . $msg . "'); opener.location.reload(); window.close();</script>";
		exit;
	}
}