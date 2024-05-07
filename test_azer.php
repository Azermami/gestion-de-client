
<?php

function loedRoutes($filename){
	$routes=yaml_parse_file($filename);
	return $routes;
}

function routeRequest($routes,$url)
{
	$parts=explode('/',$url);
	if(isset($routes[$url])){
		$controllerName=$routes[$url]['Controller'];
		$actionName=$routes[$url]['Action'];
		$controllerFile="../Controllers/".$controllerName.'.php';
		if(!file_exists($controllerFile)){
			throw new Exception("le fichier du controleur n'exsiste pas.");
		}
		require_once $controllerFile;
		
	}
}