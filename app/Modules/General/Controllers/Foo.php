<?php 


	namespace App\Modules\General\Controllers;
	
	use App\Core\Controller as Controller;

	/**
	* 
	*/
	class Foo extends Controller {
	
		public function baz() {
			

			$a = ["method" => ["post", "otherwise" => "error"]];

			

			return $this->app->controller('Foo')->bar();

		}


		public function bar() {

			return "hi";

		}
	}