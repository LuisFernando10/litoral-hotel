
	<?php

	//We obtain the data that correspond to the general structure of the platform (Class-Method-Id)
	$class = filter_input(INPUT_GET, 'class', FILTER_SANITIZE_STRING, array("options" => array("default" => "home")));
	$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING, array("options" => array("default" => "Index")));
	$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT, array("options" => array("default" => "")));

	echo $class.'<br>'.$action.'<br>'.$id.'<br>';

	//A classe é avaliada para abordar as respectivas visualizações
	switch ($class) {
		case 'home':
		case 'about':
		case 'booking':
		case 'contact':
		case 'location':
		case 'accommodation':
			# code...
			break;
			//Importamos la clase del controlador
            require_once (dirname(__FILE__).'/'.$class.'.php');
            
            //Guardamos el nombre de la clase
            $class = $class.'Controller';

            //Instanciamos la clase
            $class = new $class;

            //Ejecutamos el método que corresponde a la clase (default: Index) 
            call_user_func(array($class, $action));
            break;
		
		default:
			//Importamos la clase del controlador
            require_once (dirname(__FILE__).'/'.$class.'.php');
            
            //Guardamos el nombre de la clase
            $class = $class.'Controller';

            //Instanciamos la clase
            $class = new $class;

            //Ejecutamos el método que corresponde a la clase (default: Index) 
            call_user_func(array($class, $action));
			break;
	}