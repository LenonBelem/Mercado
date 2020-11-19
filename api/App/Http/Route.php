<?php
	namespace App\Http;

	class Route{
		private $request;

		private $class;
		private $method;
		private $params = array();

		public function __construct($req) {
			$this->request = $req;
			$this->load();
		}

		public function load()
		{
			
			$newUrl = explode('/', $this->request['url']);			

			if (isset($newUrl[0])) {
				$this->class = ucfirst($newUrl[0]).'Controller';
				array_shift($newUrl);

				if (isset($newUrl[0])) {
					if (strpos( $newUrl[0], '?' )) {
					 $newUrl[0] = str_replace('?', '/', $newUrl[0]);
					 $newUrl = explode('/', $newUrl[0]);
					} 
					$this->method = $newUrl[0];
					/*array_shift($newUrl);

					if (isset($newUrl[0])) {
						$this->params = $newUrl;
					}*/
				}
			}
		}

		public function run()
		{
			if (class_exists('\App\Controller\\'.$this->class) && method_exists('\App\Controller\\'.$this->class, $this->method)) {

				try {
					$controll = "\App\Controller\\".$this->class;
					$response = call_user_func_array(array(new $controll, $this->method), $this->params);
					return json_encode(array('data' => $response, 'status' => 'sucess'));
				} catch (\Exception $e) {
					return json_encode(array('data' => $e->getMessage(), 'status' => 'error'));
				}
				
			} else {

				return json_encode(array('data' => 'Operação Inválida !'.$this->class.'--'.$this->method.'', 'status' => 'error'));

			}
		} 
	}