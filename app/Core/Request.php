<?php 

	namespace App\Core;

	class Request {

		private $parsed_url;

		function __construct() {

			$raw_url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

			$this->parsed_url = parse_url($raw_url);

		}

		public function uri() {

			return explode("/", trim($this->parsed_url["path"], '/'));

		}

		public function uri_element($pos) {

			return $this->uri()[$pos];

		}

		public function get_controller() {

			return explode("/", trim($this->parsed_url["path"], '/'))[0];

		}

		public function get_action() {
			
			return explode("/", trim($this->parsed_url["path"], '/'))[1];

		}

		public function urn() {

			return (object) ['module' => $this->urn_length() > 2 ? $this->uri_element(0) : '/',
					'controller' => $this->urn_length() > 2 ? $this->uri_element(1) : $this->uri_element(0),
					'action' => $this->urn_length() > 2 ? $this->uri_element(2) : $this->uri_element(1)
					];
					
		}

		public function urn_length() {

			return count($this->uri());

		}

		public function is_ok(){

			return ($this->urn_length() >= 2);
		
		}

	}