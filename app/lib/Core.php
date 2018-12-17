<?php 


class Core {

	protected $currentController = "Pages";
	protected $currentMethod = "index";
	protected $params = [];

	public function __construct() {
		$url = $this->getUrl();

		if(file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) {

			// if a page exists it will set it to the current controller to the current page
			$this->currentController = ucwords($url[0]);

			// unset index of 0
			unset($url[0]);
		}

		// Require back the current controller
		require_once '../app/controllers/' . $this->currentController . '.php';

		// Instanciate the controller
		$this->currentController = new $this->currentController;

		// check for second part of url
		if(isset($url[1])) {
		if(method_exists($this->currentController, $url[1])) {
			$this->currentMethod = $url[1];

			// unset 1 inex 
			unset($url[1]);
		}
	 }

	 //get params 
	 $this->params = $url ? array_values($url) : [];

	 // call a callback with an array of params
	 call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
	}
	
	public function getUrl() {
		if(isset($_GET['url'])) {
			$stripped_url = rtrim($_GET['url'], '/');
			$stripped_url = filter_var($stripped_url, FILTER_SANITIZE_URL);
			$stripped_url = explode("/", $stripped_url);
			return $stripped_url;
		}
	}

}