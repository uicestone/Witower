<?php
class WT_Pagination extends CI_Pagination{
	function __construct($params = array()) {
		$params=array_merge($params,array(
			'first_link'=>'&laquo;',
			'last_link'=>'&raquo;',
			'prev_link'=>'&lsaquo;',
			'next_link'=>'&rsaquo;',
			'first_tag_open'=>'<li>',
			'first_tag_close'=>'</li>',
			'last_tag_open'=>'<li>',
			'last_tag_close'=>'</li>',
			'cur_tag_open'=>'<li class="active"><a>',
			'cur_tag_close'=>'</li></a>',
			'next_tag_open'=>'<li>',
			'next_tag_close'=>'</li>',
			'prev_tag_open'=>'<li>',
			'prev_tag_close'=>'</li>',
			'num_tag_open'=>'<li>',
			'num_tag_close'=>'</li>',
			'full_tag_open'=>'<div class="pagination"><ul>',
			'full_tag_close'=>'</ul></div>',
			'page_query_string'=>true,
			'query_string_segment'=>'page',
			'base_url'=>'/'.uri_string(),
			'use_page_numbers'=>true
		));
		parent::__construct($params);
	}
}
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
