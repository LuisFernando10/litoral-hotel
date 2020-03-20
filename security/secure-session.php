
    <?php

        /**
         * @Description: Documento que valida y protege el envío de peticiones si no se está logueado
         * @User: luis.chamorro
         * @Date: 13/feb/2020
         */

        //Importamos el archivo que contiene la configuración global
        require_once(dirname(__FILE__).'/../config-import.php');

        //Se inicializa la sesion
        if(session_status() == PHP_SESSION_NONE)
            session_start();

        //Se hacen las verificaciones de seguridad
        if (
            isset($_SESSION['session_status']) &&
            $_SESSION['session_status'] != null &&
            $_SESSION['session_status'] == 1 &&
            isset($_SESSION['session_role']) &&
            $_SESSION['session_role'] != null &&
            ($_SESSION['session_role'] == 'admin' ||
                $_SESSION['session_role'] == 'user')
        ){
            /* Esta toodo OK */
        }
        else{

            //Se cierran y eliminan las sesiones
            Security::sessionClose();

            //Se carga la vista de login
            include_once (dirname(__FILE__).'/../controllers/user/index.php');
        }