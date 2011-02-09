<?php
class Snippets_model_tests extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('unit_test');
		$this->unit->use_strict(TRUE);

		$this->load->model("snippets_model");

		// sample data
		$this->data = array("id" => 10, "title" => "sample code from tests", "code_type" => "php", "code" => "// test");
	}

	function index()
	{
		echo "test file";
	}
	function insert()
	{
		$desc1 = "通常";
		$test1 = $this->snippets_model->insert($this->data["title"], $this->data["code_type"], $this->data["code"]);
		$this->unit->run($test1, TRUE, "INSERT", $desc1);

		$desc2 = "titleなし";
		$test2 = $this->snippets_model->insert("", $this->data["code_type"], $this->data["code"]);
		$this->unit->run($test2, FALSE, "Insert Test::titleBrank", $desc2);

		$desc3 = "codeなし";
		$test3 = $this->snippets_model->insert($this->data["title"], $this->data["code_type"], "");
		$this->unit->run($test3, FALSE, "Insert Test::codeBrank", $desc3);

		$desc4 = "code_typeなし";
		$test4 = $this->snippets_model->insert($this->data["title"], "", $this->data["code"]);
		$this->unit->run($test4, FALSE, "Insert Test::title_codeBrank", $desc4);

		echo $this->unit->report();
	}

	function update()
	{
		$desc1 = "通常のupdateを実行";
		$test1 = $this->snippets_model->update(20, "change", "php", "// testしてみました。update実行");
		$this->unit->run($test1, TRUE, "update", $desc1);

		$desc2 = "codeに空白を設定";
		$test2 = $this->snippets_model->update(10, "change2", "php", "");
		$this->unit->run($test2, FALSE, "codebrank", $desc2);

		$desc3 = "titleに空白を設定";
		$test3 = $this->snippets_model->update(15, "", "php", "hogehoge");
		$this->unit->run($test3, FALSE, "titlebrank", $desc3);

		$desc4 = "code_typeに空白を設定";
		$test4 = $this->snippets_model->update(18, "title", "", "// hogehoge");
		$this->unit->run($test4, FALSE, "titlecodebrank", $desc4);

		$desc5 = "idに不正な値を指定";
		$test5 = $this->snippets_model->update("hoge", "title", "php", "// hogehgoe");
		$this->unit->run($test5, FALSE, "idIsString", $desc5);

		$desc6 = "存在しないidを設定::存在しないidをupdateしても害はないのでこのままで";
		$test6 = $this->snippets_model->update(1000, "title", "php", "// hogehoge");
		$this->unit->run($test6, TRUE, "idNotExsists", $desc6);

		echo $this->unit->report();

	}

	function delete()
	{
		$desc1 = "通常::id = 10を指定";
		$test1 = $this->snippets_model->delete(10);
		$this->unit->run($test1, TRUE, "delete", $desc1);

		$desc2 = "idに不正な値(string)を指定";
		$test2 = $this->snippets_model->delete("hoge");
		$this->unit->run($test2, FALSE, "id is not int", $desc2);

		$desc3 = "idに存在しない値を指定::存在しないものが消えて困ることもないので、このままで";
		$test3 = $this->snippets_model->delete(3000);
		$this->unit->run($test3, TRUE, "id# is not exist", $desc3);

		echo $this->unit->report();
	}

	function select()
	{
		$desc1 = "通常の利用";
		$test1 = $this->snippets_model->select();
		$this->unit->run($test1, "is_array", "SELECT", $desc1);

		$desc2 = "論理削除されているものを表示";
		$test2 = $this->snippets_model->select(10, 1);
		$this->unit->run($test2, "is_array", "SELECT", $desc2);

		$desc3 = "invalidに存在しない値を指定";
		$test3 = $this->snippets_model->select(5, 3);
		$this->unit->run($test3, "is_null", "SELCT", $desc3);

		$desc4 = "引数に不適切な値(string)を設定";
		$test4 = $this->snippets_model->select("hoge", "fuga");
		$this->unit->run($test4, "is_null", "SELECT", $desc4);

		echo $this->unit->report();

		var_dump($test2);
	}

	function select_one()
	{
		$desc1 = "id=14の場合::通常";
		$test1 = $this->snippets_model->select_one(14);
		$this->unit->run($test1, "is_array", "SELECT_ONE::TEST1", $desc1);

		$desc2 = "idに存在しない値を設定した場合";
		$test2 = $this->snippets_model->select_one(2000);
		$this->unit->run($test2, "is_null", "SELECT_ONE::TEST2",$desc2);

		$desc3 = "idに予期しない値を設定した場合";
		$test3 = $this->snippets_model->select_one("hoge");
		$this->unit->run($test3, "is_null", "SELECT_ONE::TEST3", $desc3);

		echo $this->unit->report();
	}
}

