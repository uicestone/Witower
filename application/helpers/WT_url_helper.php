<?php
if ( ! function_exists('uri_segment'))
{
	function uri_segment($n)
	{
		$CI =& get_instance();
		return $CI->uri->segment($n);
	}
}
?>
