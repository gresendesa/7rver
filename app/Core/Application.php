<?php 

	namespace App\Core;

	class Application {

		public $request;

		function __construct(\App\Core\Request $request){

			$this->request = $request;

		}

		private function route() {
			
			$code = 404;

			$content = "Invalid route";

			if ($this->request->is_ok()) {

				$content = $this->resolve($this->request);

				$code = 200;
			}

			$result = new Response($content, $code);
			
			return $result;

		}

		public function output() {

			$result = $this->route($this->request);

			$response = new Response($result->get_content(), $result->get_http_code());

			return $response->get_content();
		
		}

		private function resolve(){

			$controller = $this->controller($this->request->urn()->controller);

			$action_name = $this->request->urn()->action;

			if ($controller !== null){

				if (is_callable([$controller, $action_name])){

					$content = $controller->$action_name();

				} else {
					$content = "Action not found";
				}

			} else {
				$content = "Controller not found";
			}

			return $content;
		}

		private function instantiate_component($mvc, $name) {

			$class = "\App\Modules\\" . ucfirst($this->request->urn()->module) . "\\" . ucfirst($mvc) . "\\" . ucfirst($name);

			if (class_exists($class)){
				
				return (new $class($this));

			} else {

				return null;

			}

		}

		public function controller($name) {

			return $this->instantiate_component("Controllers", $name);

		}

		public function model($name) {

			return $this->instantiate_component("Models", $name);;

		}

		public function view($name) {

			return $this->instantiate_component("Views", $name);

		}

	}