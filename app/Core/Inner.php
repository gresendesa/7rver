<?php 

	namespace App\Core;

	abstract class Inner {

		protected $app;

		function __construct(Application $app){
			
			$this->app = $app;	
		
		}

		public function module_name() {

			return $this->app->request->urn()->module;

		}

	}
