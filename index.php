	
	<?php 
		/**
		* @Description: Documento que carregara as vistas iniciais do projeto
		* @User: luis.chamorro
		* @Date: 26-ene-2020
		*/

        //Cofiguraciòn de seguridad para el acceso a la plataforma
//		if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === "off") {
//            $location = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
//            header('HTTP/1.1 301 Moved Permanently');
//            header('Location: ' . $location);
//            exit;
//        }

        //Importamos el archivo que contiene la configuración global
        require_once(dirname(__FILE__).'/config-import.php');

        //Se incluye el archivo de seguridad que no permite hacer nada si no estan las sesiones habilitadas y correctamente iniciadas
        require_once(dirname(__FILE__).'/security/secure-session.php');

        //Inicializamos las sesiones
        if(session_status() == PHP_SESSION_NONE)
            @session_start();


        //Definimos el 'rol' del usuario
        if(isset($_SESSION['session_role']) && $_SESSION['session_role'] != null && $_SESSION['session_role'] != '')
            $user_role = $_SESSION['session_role'];
        else
            $user_role = "N/A";


        //Validamos los roles establecidos por la sesión, y direccionamos al respectivo controlador
        switch ($user_role){

            case 'admin':
                include_once (dirname(__FILE__).'/controllers/admin/index.php');
                break;

            case 'user':
                include_once (dirname(__FILE__).'/controllers/user/index.php');
                break;

            default:
                include_once (dirname(__FILE__).'/controllers/user/index.php');
                break;
        }