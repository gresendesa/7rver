<?php 

	namespace App\Core;

	class Response {

		function __construct($content, $http_code) {

			$this->content = $content;

			$this->http_code = $http_code;

		}

		private $content;

		private $http_code;

		private $wrapped = false;

		public function wrap() {

			$this->wrapped = true;

		}

		public function get_content() {

			return $this->content;
		
		}

		public function get_json_content() {

			return $this->content;
		
		}

		public function get_http_code() {

			return (int) $this->http_code;
		
		}

	}