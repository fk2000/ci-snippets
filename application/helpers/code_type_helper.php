<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if( ! function_exists("code_name"))
{
	function code_name($type)
	{
		if(!is_string($type))
		{
			return NULL;
		}
		// CodeIgniterオブジェクト取得
		$CI =& get_instance();
		// 設定ファイル読込
		$CI->config->load("form_data");

		// 設定ファイルからcode_typeの配列取得
		$type_list = $CI->config->item("code_type_options");

		return $type_list[$type];
	}
}
