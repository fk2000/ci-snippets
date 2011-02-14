<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * ci-snippets  Add helper
 * 追加ヘルパー
 *
 * @package		ci-snippets
 * @author		Yuya Terajima/e2esound.com
 * @copyright	Copyright (c) 2011 Yuya Terajima/e2esound.com
 * @license		MTI License?
 * @link		http://www.e2esound.com/
 * @since		Version 0.1β
 */

/**
 * code_name method
 * 表示用code_type取得関数
 *
 * config/form_data.phpに設定した
 * code_typeの配列に基づき、表示用のコード名を取得
 *
 * @package		ci-snippets
 * @category	helper
 * @author	  Yuya Terajima/e2esound.com
 */
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

/* End of file code_type_helper.php */
/* Location: /application/helpers/code_type.php */
