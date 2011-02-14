<?php
$CI =& get_instance();
$CI->load->model("snippets_model");
		// page
$config["base_url"]   = base_url() . "/display/index";
$config["total_rows"] = (int)$CI->snippets_model->get_num_rows();
$config["per_page"]   = 10;

